<?php
/**
 * Twenty Twenty-Four Child
 * Custom Login (Reference Style)
 */

/* 부모 테마 */
add_action('wp_enqueue_scripts', function () {
  wp_enqueue_style(
    'parent-style',
    get_template_directory_uri() . '/style.css'
  );
  wp_enqueue_style(
    'child-style',
    get_stylesheet_uri(),
    ['parent-style'],
    time()
  );
}, 20);

/* 로그인 CSS */
add_action('login_enqueue_scripts', function () {
  wp_enqueue_style(
    'custom-login-style',
    get_stylesheet_directory_uri() . '/assets/css/login.css',
    [],
    '2.0'
  );
});


// kadence_blocks_form_send_email 삭제
add_filter('kadence_blocks_form_send_email', '__return_false', 9999);
add_filter('kadence_blocks_form_email_body', '__return_empty_string', 9999);
add_filter('kadence_blocks_form_email_subject', '__return_empty_string', 9999);


/* 로그인 레이아웃 DOM 재구성 */
add_action('login_footer', function () {
  ?>
  <script>
    document.addEventListener("DOMContentLoaded", function () {
      const login = document.getElementById("login");
      const form = document.getElementById("loginform");
      const h1 = login.querySelector("h1");
      const nav = login.querySelector("#nav");

      if (!login || !form || !h1) return;

      // 카드 wrapper 생성
      const card = document.createElement("div");
      card.className = "login-card";

      // 로고 이동
      card.appendChild(h1);

      // 옵션 영역 생성
      const options = document.createElement("div");
      options.className = "login-options";

      const remember = form.querySelector(".forgetmenot");
      if (remember) options.appendChild(remember);

      if (nav) {
        const lost = nav.querySelector("a");
        if (lost) {
          lost.textContent = "비밀번호 찾기";
          options.appendChild(lost);
        }
        nav.remove();
      }

      // form 재구성
      form.insertBefore(options, form.querySelector(".submit"));
      card.appendChild(form);

      // 기존 login 비우고 카드 삽입
      login.innerHTML = "";
      login.appendChild(card);

      // back link 제거
      const back = document.getElementById("backtoblog");
      if (back) back.remove();
    });
  </script>
  <?php
});


/* 로고 링크 */
add_filter('login_headerurl', fn() => home_url());
add_filter('login_headertext', fn() => get_bloginfo('name'));

/* 언어 선택 제거 */
add_filter('login_display_language_dropdown', '__return_false');


// 관리자 대시보드 제거
add_action('wp_dashboard_setup', function () {
  remove_meta_box('dashboard_site_health', 'dashboard', 'normal');
  remove_meta_box('dashboard_right_now', 'dashboard', 'normal');
  remove_meta_box('dashboard_activity', 'dashboard', 'normal');
  remove_meta_box('dashboard_quick_press', 'dashboard', 'side');
  remove_meta_box('dashboard_primary', 'dashboard', 'side');
});

// ===== 관리자 메뉴 순서 변경 =====
add_filter('custom_menu_order', '__return_true');
add_filter('menu_order', function($menu_order) {
    return [
        'edit.php?post_type=notice',    // 공지사항
        'edit.php?post_type=js_product', // 제품소개
        'edit.php?post_type=service',   // 시험 및 용역
        'edit.php?post_type=customer_inquiry',   // 시험 및 용역
        'upload.php',                   // 미디어
        'users.php',                    // 사용자
        
    ];
});



/* =========================================
 * 관리자 메뉴 정리 (워프 흔적 제거)
 * ========================================= */
add_action('admin_menu', function () {

    if (current_user_can('administrator')) return; // 관리자는 다 보임


    remove_menu_page('edit.php');              // 글
    remove_menu_page('edit-comments.php');     // 댓글
    remove_menu_page('themes.php');            // 모양
    remove_menu_page('plugins.php');           // 플러그인
    remove_menu_page('tools.php');             // 도구
    remove_menu_page('update-core.php');       // 업데이트
    remove_menu_page('options-general.php');   // 설정 (필요 시)
    // 페이지
     remove_menu_page('edit.php?post_type=page');
   // WPForms
    remove_menu_page('wpforms-overview');

    // WP Mail SMTP
    remove_menu_page('wp-mail-smtp');

    // Site Assist
    remove_menu_page('suspended-starter-plugin-setup');

    // All Import
    remove_menu_page('pmxi-admin-home');

    // Kadence
    remove_menu_page('kadence');
    remove_menu_page('starter-plugin-starter');
    remove_menu_page('kadence-starter');
    remove_menu_page('kadence-blocks-home');

}, 999);

// ===== 상단 툴바에서 WPForms 제거 =====
add_action('admin_bar_menu', function($wp_admin_bar) {
    $wp_admin_bar->remove_node('wpforms-menu');
}, 999);

// ===== 상단 도움말 탭 숨기기 =====
add_action('admin_head', function() {
    echo '<style>
        #contextual-help-link-wrap,
        #contextual-help-link { display: none !important; }
    </style>';
});



// ===== 관리자 메뉴 숨기기 =====
add_action('admin_head', function() {
    ?>
    <style>
        /* Kadence */
        #toplevel_page_kadence-blocks { display: none !important; }
        
        /* Site Assist */
        #toplevel_page_suspended-starter-plugin-setup,
        #toplevel_page_starter-plugin,
        li[class*="starter"] { display: none !important; }
        
        /* 상단 WPForms */
        #wp-admin-bar-wpforms-menu { display: none !important; }
        
        /* 도움말 탭 */
        #contextual-help-link-wrap { display: none !important; }
    </style>
    <?php
});

// ===== 하단 푸터 텍스트 숨기기 =====
// "워드프레스로 만들어주셔서 감사합니다" 제거
add_filter('admin_footer_text', '__return_empty_string');

// 버전 정보 제거
add_filter('update_footer', '__return_empty_string', 11);


remove_action('welcome_panel', 'wp_welcome_panel');

// 🔥 워드프레스 웰컴 패널 완전 제거
remove_action('welcome_panel', 'wp_welcome_panel');

// 혹시 남아있을 경우를 대비한 2중 제거
add_action('admin_init', function () {
  remove_action('welcome_panel', 'wp_welcome_panel');
});

add_action('admin_bar_menu', function ($wp_admin_bar) {
  $wp_admin_bar->remove_node('wp-logo');
}, 999);



add_action('init', function () {

    if (isset($_POST['inq_email_send'])) {

        // $to = 'help@joosh.co.kr';
        $to = 'bumy@thefrom.kr';

        // 선택값
        $name    = !empty($_POST['kb_field_0']) ? sanitize_text_field($_POST['kb_field_0']) : '미입력';
        $company = !empty($_POST['kb_field_3']) ? sanitize_text_field($_POST['kb_field_3']) : '미입력';
        $phone   = !empty($_POST['kb_field_4']) ? sanitize_text_field($_POST['kb_field_4']) : '미입력';

        // 필수값
        $email   = !empty($_POST['kb_field_1']) ? sanitize_email($_POST['kb_field_1']) : '';
        $message = !empty($_POST['kb_field_2']) ? sanitize_textarea_field($_POST['kb_field_2']) : '';

        if (!$email || !$message) {
            return;
        }

        /* 1️⃣ 메일 발송 */
        $subject = '[주신산업] 고객문의 접수';
        $body =
            "이름: {$name}\n" .
            "회사명: {$company}\n" .
            "연락처: {$phone}\n" .
            "이메일: {$email}\n\n" .
            "문의내용:\n{$message}";

        $headers = ['Content-Type: text/plain; charset=UTF-8'];
        wp_mail($to, $subject, $body, $headers);

        /* 2️⃣ 관리자(customer_inquiry) 글 생성 */
        $post_id = wp_insert_post([
            'post_type'   => 'customer_inquiry',
            'post_title'  => wp_trim_words($message, 6, '…'),
            'post_content'=> $message,
            'post_status' => 'publish',
        ]);

        if ($post_id) {
            update_post_meta($post_id, '_inq_name', $name);
            update_post_meta($post_id, '_inq_company', $company);
            update_post_meta($post_id, '_inq_phone', $phone);
            update_post_meta($post_id, '_inq_email', $email);
            update_post_meta($post_id, '_inq_type', '웹문의');
            update_post_meta($post_id, '_inq_status', '접수');
        }
    }
});






// 공지사항 Custom Post Type
function register_notice_cpt() {

    $labels = array(
        'name'               => '공지사항',
        'singular_name'      => '공지사항',
        'menu_name'          => '공지사항',
        'name_admin_bar'     => '공지사항',
        'add_new'            => '새 공지',
        'add_new_item'       => '새 공지 추가',
        'new_item'           => '새 공지',
        'edit_item'          => '공지 수정',
        'view_item'          => '공지 보기',
        'all_items'          => '공지사항 목록',
        'search_items'       => '공지 검색',
    );

    $args = array(
        'labels'             => $labels,
        'public'             => true,
        'menu_position'      => 5,
        'menu_icon'          => 'dashicons-megaphone',
        'supports'           => array('title', 'editor', 'excerpt','thumbnail'),
        'has_archive'        => true,
        'rewrite'            => array('slug' => 'notice'),
        'show_in_rest'       => true, // Gutenberg 사용
    );

    register_post_type('notice', $args);
}
add_action('init', 'register_notice_cpt');


// 공지사항 상세 - 목록으로 버튼
add_action('kadence_single_after_content', function() {
    if (is_singular('notice')) {
        echo '<div class="notice-back-btn">';
        echo '<a href="' . get_post_type_archive_link('notice') . '">← 목록으로</a>';
        echo '</div>';
    }
});



/* =========================================
 * 제품소개 CPT
 * ========================================= */
function register_product_cpt() {

  $labels = array(
    'name'               => '제품소개',
    'singular_name'      => '제품',
    'menu_name'          => '제품소개',
    'add_new'            => '제품 추가',
    'add_new_item'       => '새 제품 추가',
    'edit_item'          => '제품 수정',
    'new_item'           => '새 제품',
    'view_item'          => '제품 보기',
    'all_items'          => '제품 목록',
    'search_items'       => '제품 검색',
  );

  $args = array(
    'labels'             => $labels,
    'public'             => true,
    'menu_position'      => 6,
    'menu_icon'          => 'dashicons-products',
    'show_in_rest'       => true,
    'supports'           => array('title', 'editor', 'thumbnail', 'excerpt'),
    'taxonomies'         => array('product_category'),
    'has_archive'        => true,
    'rewrite'            => array('slug' => 'products'),
  );

  register_post_type('js_product', $args);
}
add_action('init', 'register_product_cpt');




/* =========================================
 * 제품 카테고리 (대/소분류)
 * ========================================= */
function register_product_category_taxonomy() {

  $labels = array(
    'name'              => '제품 카테고리',
    'singular_name'     => '제품 카테고리',
    'search_items'      => '카테고리 검색',
    'all_items'         => '전체 카테고리',
    'parent_item'       => '상위 카테고리',
    'parent_item_colon' => '상위 카테고리:',
    'edit_item'         => '카테고리 수정',
    'update_item'       => '카테고리 업데이트',
    'add_new_item'      => '새 카테고리 추가',
    'new_item_name'     => '새 카테고리 이름',
    'menu_name'         => '제품 카테고리',
  );

  register_taxonomy('product_category', array('js_product'), array(
    'hierarchical'          => true,
    'labels'                => $labels,

    'show_ui'               => true,
    'show_admin_column'     => true,

    'show_in_rest'          => true,

    'rewrite'               => array(
      'slug'         => 'product-category',
      'with_front'   => false,
      'hierarchical' => true,
    ),
  ));
}
add_action('init', 'register_product_category_taxonomy');



/* =========================================
 * 제품 메타박스 (용도 한 줄 설명)
 * ========================================= */
add_action('add_meta_boxes', function () {
  add_meta_box(
    'product_meta_box',
    '제품 정보',
    'render_product_meta_box',
    'js_product',
    'normal',
    'high'
  );
});

function render_product_meta_box($post) {
  $usage = get_post_meta($post->ID, '_product_usage', true);
  ?>

  <p>
    <label><strong>용도 (한 줄 설명)</strong></label><br>
    <input
      type="text"
      name="product_usage"
      value="<?php echo esc_attr($usage); ?>"
      style="width:100%;"
    >
  </p>

  <?php
}

add_action('save_post', function ($post_id) {

  if (isset($_POST['product_usage'])) {
    update_post_meta(
      $post_id,
      '_product_usage',
      sanitize_text_field($_POST['product_usage'])
    );
  }

});

// 제품 상세 - 카테고리 경로 표시
// 제품 상세 - 카테고리 경로 표시
add_action('kadence_single_before_entry_title', function() {
    if (is_singular('js_product')) {
        $terms = get_the_terms(get_the_ID(), 'product_category');
        if ($terms && !is_wp_error($terms)) {
            // 자식 카테고리만 필터링 (부모가 있는 것만)
            $child_terms = array_filter($terms, function($term) {
                return $term->parent > 0;
            });
            
            // 자식이 없으면 전체 사용
            if (empty($child_terms)) {
                $child_terms = $terms;
            }
            
            echo '<div class="product-category-path">';
            $paths = array();
            foreach ($child_terms as $term) {
                if ($term->parent) {
                    $parent = get_term($term->parent, 'product_category');
                    $paths[] = '<a href="' . get_term_link($parent) . '">' . esc_html($parent->name) . '</a> &gt; <a href="' . get_term_link($term) . '">' . esc_html($term->name) . '</a>';
                } else {
                    $paths[] = '<a href="' . get_term_link($term) . '">' . esc_html($term->name) . '</a>';
                }
            }
            echo implode(' / ', $paths);
            echo '</div>';
        }
    }
});

// 제품 상세 - 목록 버튼
add_action('kadence_single_after_entry_content', function() {
    if (is_singular('js_product')) {
        echo '<div class="product-back-btn">';
        echo '<a href="' . get_post_type_archive_link('js_product') . '">← 목록으로</a>';
        echo '</div>';
    }
});

/* =========================================
 * 고객문의관리 CPT
 * ========================================= */

function register_customer_inquiry_cpt() {

  $labels = array(
    'name'               => '고객문의관리',
    'singular_name'      => '고객문의',
    'menu_name'          => '고객문의관리',
    'add_new'            => '문의 추가',
    'add_new_item'       => '새 문의',
    'edit_item'          => '문의 보기',
    'new_item'           => '새 문의',
    'view_item'          => '문의 상세',
    'all_items'          => '문의 목록',
    'search_items'       => '문의 검색',
  );

  $args = array(
    'labels'             => $labels,
    'public'             => false,       // 🔥 프론트 접근 차단
    'show_ui'            => true,        // 관리자만
    'menu_position'      => 7,
    'menu_icon'          => 'dashicons-email',
    'supports'           => array(
      'title',        // 문의 제목 (자동 생성)
      'editor'        // 문의 내용
    ),
    'show_in_rest'       => true,
  );

  register_post_type('customer_inquiry', $args);
}
add_action('init', 'register_customer_inquiry_cpt');


/* =========================================
 * 문의 메타박스
 * ========================================= */
add_action('add_meta_boxes', function () {
  add_meta_box(
    'customer_inquiry_info',
    '고객 문의 정보',
    'render_customer_inquiry_meta',
    'customer_inquiry',
    'normal',
    'high'
  );
});

function render_customer_inquiry_meta($post) {
  
    $content = $post->post_content;

    // Gutenberg 블록 주석 제거
    $content = preg_replace('/<!--(.|\s)*?-->/', '', $content);

    // 태그 제거 + 줄바꿈 정리
    $content = wp_strip_all_tags($content);
    $content = preg_replace("/\n{2,}/", "\n", trim($content));

    $name   = get_post_meta($post->ID, '_inq_name', true);
    $phone  = get_post_meta($post->ID, '_inq_phone', true);
    $email  = get_post_meta($post->ID, '_inq_email', true);
    $type   = get_post_meta($post->ID, '_inq_type', true);
    $status = get_post_meta($post->ID, '_inq_status', true);
  ?>

  <table class="widefat striped">
    <tbody>
         <!-- 문의 내용 -->
      <tr>
        <th style="width:120px;">문의 내용</th>
        <td>
          <div style="
            background:#f9f9f9;
            padding:12px;
            border:1px solid #ddd;
            white-space:pre-line;
            line-height:1.6;
          ">
            <?= esc_html($content) ?>
          </div>
        </td>
      </tr>
      <tr>
        <th style="width:120px;">이름</th>
        <td><?= esc_html($name) ?></td>
      </tr>
      <tr>
        <th>연락처</th>
        <td><?= esc_html($phone) ?></td>
      </tr>
      <tr>
        <th>이메일</th>
        <td><?= esc_html($email) ?></td>
      </tr>
      <tr>
        <th>문의 유형</th>
        <td><?= esc_html($type) ?></td>
      </tr>
      <tr>
        <th>처리 상태</th>
        <td>
          <select name="inq_status">
            <option value="접수" <?= selected($status,'접수',false) ?>>접수</option>
            <option value="처리중" <?= selected($status,'처리중',false) ?>>처리중</option>
            <option value="완료" <?= selected($status,'완료',false) ?>>완료</option>
          </select>
        </td>
      </tr>
    </tbody>
  </table>
  <?php
}

add_action('save_post_customer_inquiry', function ($post_id) {
  if (isset($_POST['inq_status'])) {
    update_post_meta(
      $post_id,
      '_inq_status',
      sanitize_text_field($_POST['inq_status'])
    );
  }
});

add_action('admin_head', function () {
  $screen = get_current_screen();
  if ($screen && $screen->post_type === 'customer_inquiry') {
    echo '<style>
      /* 블록 수정 차단 */
      .block-editor__container {
        pointer-events: none;
        opacity: 0.95;
      }

      /* 블록 추가 버튼 제거 */
      .block-editor-inserter,
      .block-editor-writing-flow__click-redirect {
        display: none !important;
      }
    </style>';
  }
});

add_filter('get_user_option_closedpostboxes_customer_inquiry', '__return_empty_array');


add_filter('enter_title_here', function ($title, $post) {
  if ($post->post_type === 'customer_inquiry') {
    return '문의 제목';
  }
  return $title;
}, 10, 2);

add_action('admin_menu', function () {
  remove_submenu_page(
    'edit.php?post_type=customer_inquiry',
    'post-new.php?post_type=customer_inquiry'
  );
});

add_action('init', function () {
  remove_post_type_support('customer_inquiry', 'editor');
});





/////////////////////////////////////////////////////////////////////////////////





// 로그인 후 관리자 첫 화면을 제품 목록으로
add_filter('login_redirect', function ($redirect_to, $request, $user) {

    if (isset($user->roles) && is_array($user->roles)) {
        return admin_url('edit.php?post_type=js_product');
    }

    return $redirect_to;
}, 10, 3);

// 관리자 메뉴에서 알림판 제거
add_action('admin_menu', function () {
    remove_menu_page('index.php'); // Dashboard
}, 999);

// 알림판 직접 접근 시 제품 목록으로 강제 이동
add_action('load-index.php', function () {
    wp_safe_redirect(admin_url('edit.php?post_type=js_product'));
    exit;
});



// AJAX: 자식 카테고리 가져오기
add_action('wp_ajax_get_child_cats', 'get_child_cats_callback');
add_action('wp_ajax_nopriv_get_child_cats', 'get_child_cats_callback');
function get_child_cats_callback() {
    $parent_id = intval($_POST['parent_id']);
    $type = isset($_POST['type']) ? $_POST['type'] : 'option';
    
    $child_cats = get_terms([
        'taxonomy' => 'product_category',
        'hide_empty' => false,
        'parent' => $parent_id,
        'orderby'    => 'term_order',
        'order'      => 'ASC',
    ]);
    
    $output = '';
    foreach ($child_cats as $cat) {
        if ($type === 'div') {
            $output .= '<div data-value="' . $cat->term_id . '">' . $cat->name . '</div>';
        } else {
            $output .= '<option value="' . $cat->term_id . '">' . $cat->name . '</option>';
        }
    }
    
    echo $output;
    wp_die();
}

// 필터 쿼리 적용
add_action('pre_get_posts', function($query) {
    if (!is_admin() && $query->is_main_query() && is_post_type_archive('js_product')) {
        
        // 카테고리 필터
        $tax_query = [];
        
        if (!empty($_GET['cat2'])) {
            $tax_query[] = [
                'taxonomy' => 'product_category',
                'field' => 'term_id',
                'terms' => intval($_GET['cat2'])
            ];
        } elseif (!empty($_GET['cat1'])) {
            $tax_query[] = [
                'taxonomy' => 'product_category',
                'field' => 'term_id',
                'terms' => intval($_GET['cat1'])
            ];
        }
        
        if ($tax_query) {
            $query->set('tax_query', $tax_query);
        }
        
        // 검색어 필터
        if (!empty($_GET['keyword'])) {
            $query->set('s', sanitize_text_field($_GET['keyword']));
        }
    }
});

// ========== 헤더 검색 기능 (PC + 모바일) ==========

// PC 메뉴에 검색 아이콘 추가
add_filter('wp_nav_menu_items', function($items, $args) {
    if ($args->theme_location == 'primary' || $args->theme_location == 'main') {
        $items .= '<li class="menu-item menu-item-search"><a href="#" class="header-search-trigger"><svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="11" cy="11" r="8"></circle><line x1="21" y1="21" x2="16.65" y2="16.65"></line></svg></a></li>';
    }
    return $items;
}, 10, 2);

// 검색 기능 출력
add_action('wp_footer', function() {
    ?>
    <!-- PC용 검색 오버레이 -->
    <div id="header-search-overlay" class="header-search-overlay">
        <div class="header-search-inner">
            <form action="<?php echo get_post_type_archive_link('js_product'); ?>" method="get">
                <input type="text" name="keyword" placeholder="제품 검색어를 입력하세요">
                <button type="submit"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="11" cy="11" r="8"></circle><path d="m21 21-4.35-4.35"></path></svg></button>
            </form>
            <button class="search-close">&times;</button>
        </div>
    </div>
    
    <style>
    /* ===== PC 검색 오버레이 ===== */
    .header-search-overlay {
        position: fixed;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background: rgba(0,0,0,0.8);
        display: none;
        justify-content: center;
        align-items: flex-start;
        padding-top: 100px;
        z-index: 99999;
    }
    .header-search-overlay.active { display: flex; }
    .header-search-inner {
        position: relative;
        width: 90%;
        max-width: 600px;
    }
    .header-search-inner form {
        display: flex;
        background: #fff;
        border-radius: 50px;
        overflow: hidden;
    }
    .header-search-inner input {
        flex: 1;
        padding: 15px 25px;
        border: none;
        font-size: 16px;
        outline: none;
    }
    .header-search-inner button[type="submit"] {
        padding: 15px 20px;
        background: #0066cc;
        border: none;
        cursor: pointer;
    }
    .header-search-inner button[type="submit"] svg { stroke: #fff; }
    .search-close {
        position: absolute;
        right: -75px;
        top: 50%;
        transform: translateY(-50%);
        background: none;
        border: none;
        color: #fff;
        font-size: 36px;
        cursor: pointer;
    }
    
    /* ===== 모바일 인라인 검색 ===== */
    .mobile-search-inline {
    display: none;
}
@media (max-width: 1024px) {
    /* 햄버거 부모 가로 정렬 */
    #mobile-toggle {
        display: inline-flex !important;
    }
    .mobile-toggle-open-container,
    #mobile-toggle.menu-toggle {
        display: inline-flex !important;
        vertical-align: middle;
    }
    
    .mobile-search-inline {
        display: inline-flex;
        align-items: center;
        vertical-align: middle;
        margin-right: 5px;
    }
    .mobile-search-inline .search-input-wrap {
        display: flex;
        align-items: center;
        overflow: hidden;
        max-width: 0;
        opacity: 0;
        transition: max-width 0.3s ease, opacity 0.3s ease;
        background: #fff;
        border: 1px solid #ddd;
        border-radius: 20px;
        margin-right: 5px;
    }
    .mobile-search-inline.active .search-input-wrap {
        max-width: 200px;
        opacity: 1;
    }
    .mobile-search-inline .search-input-wrap input {
        width: 130px;
        padding: 8px 12px;
        border: none;
        font-size: 14px;
        outline: none;
        background: transparent;
    }
    .mobile-search-inline .search-input-wrap button {
        padding: 8px 10px;
        background: none;
        border: none;
        cursor: pointer;
        display: flex;
        align-items: center;
    }
    .mobile-search-inline .search-input-wrap button svg {
        stroke: #666;
        width: 18px;
        height: 18px;
    }
    .mobile-search-icon {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        width: 40px;
        height: 40px;
        cursor: pointer;
        background: none !important;
        border: none;
        padding: 0;
        outline: none !important;
        -webkit-tap-highlight-color: transparent;
    }
    .mobile-search-icon:focus,
    .mobile-search-icon:active {
        background: none !important;
        outline: none !important;
        box-shadow: none !important;
    }
    .mobile-search-icon svg {
        stroke: #333;
        width: 24px;
        height: 24px;
    }
    
    /* 모바일 메뉴 내 검색 숨김 */
    .mobile-navigation .menu-item-search { display: none !important; }
    /* PC 오버레이 숨김 */
    .header-search-overlay { display: none !important; }
}
    </style>
    
    <script>
    document.addEventListener('DOMContentLoaded', function() {
        
        // 모바일: 인라인 검색 추가
        var mobileToggle = document.querySelector('#mobile-toggle');
        if (mobileToggle && !document.querySelector('.mobile-search-inline')) {
            
            var searchWrap = document.createElement('div');
            searchWrap.className = 'mobile-search-inline';
            searchWrap.innerHTML = `
                <form class="search-input-wrap" action="<?php echo get_post_type_archive_link('js_product'); ?>" method="get">
                    <input type="text" name="keyword" placeholder="검색어 입력">
                    <button type="submit">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                            <circle cx="11" cy="11" r="8"></circle>
                            <path d="m21 21-4.35-4.35"></path>
                        </svg>
                    </button>
                </form>
                <button type="button" class="mobile-search-icon">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <circle cx="11" cy="11" r="8"></circle>
                        <path d="m21 21-4.35-4.35"></path>
                    </svg>
                </button>
            `;
            
            mobileToggle.parentElement.insertBefore(searchWrap, mobileToggle);
            
            // 검색 아이콘 클릭 토글
            var searchIcon = searchWrap.querySelector('.mobile-search-icon');
            searchIcon.addEventListener('click', function(e) {
                e.preventDefault();
                e.stopPropagation();
                searchWrap.classList.toggle('active');
                if (searchWrap.classList.contains('active')) {
                    searchWrap.querySelector('input').focus();
                }
            });
            
            // 외부 클릭 시 닫기
            document.addEventListener('click', function(e) {
                if (!searchWrap.contains(e.target)) {
                    searchWrap.classList.remove('active');
                }
            });
        }
        
        // PC: 검색 오버레이
        document.querySelectorAll('.header-search-trigger').forEach(function(btn) {
            if (btn.closest('.mobile-navigation')) return;
            btn.addEventListener('click', function(e) {
                e.preventDefault();
                document.getElementById('header-search-overlay').classList.add('active');
                document.querySelector('.header-search-inner input').focus();
            });
        });
        
        var searchClose = document.querySelector('.search-close');
        if (searchClose) {
            searchClose.addEventListener('click', function() {
                document.getElementById('header-search-overlay').classList.remove('active');
            });
        }
        
        var overlay = document.getElementById('header-search-overlay');
        if (overlay) {
            overlay.addEventListener('click', function(e) {
                if (e.target === this) this.classList.remove('active');
            });
        }
        
        document.addEventListener('keydown', function(e) {
            if (e.key === 'Escape') {
                document.getElementById('header-search-overlay').classList.remove('active');
                var mobileSearch = document.querySelector('.mobile-search-inline');
                if (mobileSearch) mobileSearch.classList.remove('active');
            }
        });
    });
    </script>
    <?php
});




// 최신 제품 숏코드
add_shortcode('recent_products', function($atts) {
    $atts = shortcode_atts([
        'count' => 6
    ], $atts);
    
    $query = new WP_Query([
        'post_type' => 'js_product',
        'posts_per_page' => $atts['count'],
        'orderby' => 'date',
        'order' => 'DESC'
    ]);
    
    if (!$query->have_posts()) {
        return '<p>제품이 없습니다.</p>';
    }
    
    $output = '<div class="recent-products-wrap">';
    $output .= '<div class="products-header"><h3>제품소개</h3><a href="' . get_post_type_archive_link('js_product') . '">전체보기 →</a></div>';
    $output .= '<div class="products-grid">';
    
    while ($query->have_posts()) {
        $query->the_post();
        $thumb = get_the_post_thumbnail_url(get_the_ID(), 'medium');
        if (!$thumb) {
            $thumb = 'https://via.placeholder.com/300x200?text=No+Image';
        }
        
        $output .= '<div class="product-card">';
        $output .= '<a href="' . get_permalink() . '">';
        $output .= '<div class="product-thumb" style="background-image: url(\'' . $thumb . '\');"></div>';
        $output .= '<h4 class="product-name">' . get_the_title() . '</h4>';
        $output .= '</a>';
        $output .= '</div>';
    }
    
    $output .= '</div>';
    $output .= '</div>';
    
    wp_reset_postdata();
    
    return $output;
});


// 시험 및 용역 CPT
add_action('init', function() {
    register_post_type('service', [
        'labels' => [
            'name' => '계측엔지니어링',
            'singular_name' => '계측엔지니어링',
            'add_new' => '새로 추가',
            'add_new_item' => '새 항목 추가',
            'edit_item' => '항목 수정',
            'all_items' => '전체 보기',
        ],
        'public' => true,
        'show_in_rest' => true,
        'menu_icon' => 'dashicons-clipboard',
        'supports' => ['title', 'editor', 'thumbnail'],
        'has_archive' => true,
    ]);

    // 카테고리 (용역 분류)
    register_taxonomy('service_cat', 'service', [
        'labels' => [
            'name' => '용역 분류',
            'singular_name' => '용역 분류',
            'add_new_item' => '새 분류 추가',
        ],
        'public' => true,
        'show_in_rest' => true,
        'hierarchical' => true,
    ]);
});


// Swiper JS 로드 (메인만)
add_action('wp_enqueue_scripts', function() {
    if (is_front_page()) {
        wp_enqueue_style('swiper-css', 'https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css');
        wp_enqueue_script('swiper-js', 'https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js', [], null, true);
    }
});

// Swiper 초기화 (메인만)
add_action('wp_footer', function() {
    if (!is_front_page()) return;  // ← 메인만 실행
    ?>
    <script>
    document.addEventListener('DOMContentLoaded', function() {
        if (typeof Swiper !== 'undefined') {
            const heroSwiper = new Swiper('.hero-swiper', {
                loop: true,
                autoplay: {
                    delay: 5000,
                    disableOnInteraction: false,
                },
                pagination: {
                    el: '.swiper-pagination',
                    clickable: true,
                },
                navigation: {
                    nextEl: '.swiper-button-next',
                    prevEl: '.swiper-button-prev',
                },
            });
        }
    });
    </script>
    <?php
});
// AOS 라이브러리 CSS, JS 파일 불러오기
//function에만 적용하면 사이트 자동 적용됨
add_action('wp_enqueue_scripts', function() {
    // AOS 스타일시트
    wp_enqueue_style('aos', 'https://unpkg.com/aos@2.3.1/dist/aos.css');
    // AOS 자바스크립트 (footer에 로드)
    wp_enqueue_script('aos', 'https://unpkg.com/aos@2.3.1/dist/aos.js', array(), null, true);
});

// AOS 초기화 및 적용
add_action('wp_footer', function() {
    ?>
    <script>
    document.addEventListener('DOMContentLoaded', function() {
        // Kadence Row Layout
        document.querySelectorAll('.wp-block-kadence-rowlayout').forEach(function(el) {
            el.setAttribute('data-aos', 'fade-up');
        });
        
        // 제품 목록 아이템
        document.querySelectorAll('.entry-content-wrap, .loop-entry, .type-js_product').forEach(function(el, i) {
            el.setAttribute('data-aos', 'fade-up');
            el.setAttribute('data-aos-delay', (i % 3) * 100);
        });

        // 메인 섹션 AOS
        document.querySelectorAll('.section-products, .section-about, .section-notice').forEach(function(el) {
            el.setAttribute('data-aos', 'fade-up');
        });
        
        // AOS 초기화
        if (typeof AOS !== 'undefined') {
            AOS.init({ 
                duration: 800, 
                once: true 
            });
        }
        
        // Swiper 초기화
        if (typeof Swiper !== 'undefined' && document.querySelector('.hero-swiper')) {
            new Swiper('.hero-swiper', {
                loop: true,
                autoplay: {
                    delay: 5000,
                    disableOnInteraction: false,
                },
                pagination: {
                    el: '.swiper-pagination',
                    clickable: true,
                },
                navigation: {
                    nextEl: '.swiper-button-next',
                    prevEl: '.swiper-button-prev',
                },
                on: {
                    init: function() {
                        // 첫 로드 시 애니메이션 재실행
                        const activeSlide = document.querySelector('.swiper-slide-active');
                        if (activeSlide) {
                            activeSlide.classList.remove('swiper-slide-active');
                            setTimeout(() => {
                                activeSlide.classList.add('swiper-slide-active');
                            }, 50);
                        }
                    }
                }
            });
        }
    });
    </script>
    <?php
}, 99);

// 카테고리내 검색
add_action('pre_get_posts', function($query) {
    if (!is_admin() && $query->is_main_query() && is_tax('product_category')) {
        $keyword = isset($_GET['keyword']) ? sanitize_text_field($_GET['keyword']) : '';
        if ($keyword) {
            $query->set('s', $keyword);
        }
    }
});



// 메인노출 메타박스 추가
function js_product_main_display_metabox() {
    add_meta_box(
        'js_main_display',
        '메인 노출 설정',
        'js_main_display_callback',
        'js_product',
        'side',
        'high'
    );
}
add_action('add_meta_boxes', 'js_product_main_display_metabox');

function js_main_display_callback($post) {
    wp_nonce_field('js_main_display_nonce', 'js_main_display_nonce');
    $checked = get_post_meta($post->ID, '_js_main_display', true);
    ?>
    <label>
        <input type="checkbox" name="js_main_display" value="1" <?php checked($checked, '1'); ?>>
        메인 페이지에 노출
    </label>
    <?php
}

function js_save_main_display($post_id) {
    if (!isset($_POST['js_main_display_nonce']) || 
        !wp_verify_nonce($_POST['js_main_display_nonce'], 'js_main_display_nonce')) return;
    if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) return;

    if (isset($_POST['js_main_display'])) {
        update_post_meta($post_id, '_js_main_display', '1');
    } else {
        delete_post_meta($post_id, '_js_main_display');
    }
}
add_action('save_post', 'js_save_main_display');

// 관리자 목록에 메인노출 컬럼 추가 (선택사항)
function js_product_custom_columns($columns) {
    $new = [];
    foreach ($columns as $key => $val) {
        $new[$key] = $val;
        if ($key === 'title') {
            $new['main_display'] = '메인노출';
        }
    }
    return $new;
}
add_filter('manage_js_product_posts_columns', 'js_product_custom_columns');

function js_product_custom_column_content($column, $post_id) {
    if ($column === 'main_display') {
        $val = get_post_meta($post_id, '_js_main_display', true);
        echo $val ? '✅' : '—';
    }
}
add_action('manage_js_product_posts_custom_column', 'js_product_custom_column_content', 10, 2);


// 워드프레스 업데이트 알림 숨기기
add_filter('pre_site_transient_update_core', '__return_null');
remove_action('admin_notices', 'update_nag', 3);

// 공유섬네일설정
add_action('wp_head', function() {
    $image = get_stylesheet_directory_uri() . '/assets/images/og_thumb.png';
    echo '<meta property="og:image" content="' . $image . '">';
    echo '<meta property="og:image:width" content="1200">';
    echo '<meta property="og:image:height" content="630">';
});

// 법인카드 연구비 플로팅
add_action('wp_footer', function() {
?>
<style>
.psys-floating {
    position: fixed;
    bottom: 80px;
    right: 20px;
    z-index: 9999;
    text-decoration: none;
    display: flex;
    flex-direction: column;
    align-items: center;
    justify-content: center;
    width: 100px;
    height: 110px;
    background: #fff;
    border-radius: 12px;
    box-shadow: 0 4px 16px rgba(0,0,0,0.15);
    border: 1px solid #e8e8e8;
    padding: 12px 10px;
    transition: box-shadow 0.2s, transform 0.2s;
    gap: 6px;
}
.psys-floating:hover {
    box-shadow: 0 8px 24px rgba(0,0,0,0.2);
    transform: translateY(-2px);
}
.psys-floating img {
    width: 62px;
    height: auto;
}
.psys-floating .psys-text {
    font-size: 11px;
    color: #333;
    text-align: center;
    line-height: 1.7;
    word-break: keep-all;
}
.psys-floating .psys-link {
    font-size: 11px;
    color: #1a5fb4;
    font-weight: 600;
    margin-top: 2px;
}
</style>
<a href="http://www.jbinst.com" target="_blank" rel="noopener" class="psys-floating">
    <img src="<?php echo get_stylesheet_directory_uri(); ?>/assets/images/psys_icon.jpg" alt="PSYS">
    <div class="psys-text">법인카드<br>연구비카드</div>
    <div class="psys-link">결제 바로가기 &gt;</div>
</a>
<?php
});