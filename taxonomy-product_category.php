<?php get_header(); ?>
<!-- AOS -->
<link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
<script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
<?php
// 현재 카테고리
$current_term = get_queried_object();
$current_cat_id = $current_term->term_id;
$current_parent_id = $current_term->parent ? $current_term->parent : $current_term->term_id;

// 상위 카테고리 목록
$parent_cats = get_terms([
    'taxonomy' => 'product_category',
    'hide_empty' => false,
    'parent' => 0,
    'orderby' => 'term_order',
    'order' => 'ASC'
]);

$search_keyword = isset($_GET['keyword']) ? sanitize_text_field($_GET['keyword']) : '';
?>

<style>
/* archive-js_product.php와 동일한 스타일 */
/* ===== 제품 페이지 레이아웃 ===== */
.product-archive {
    max-width: 1400px;
    margin: 0 auto;
    padding: 0 20px;
}
.product-header {
    background: #333;
    color: #fff;
    text-align: center;
    height: 300px;
    display: flex;
    align-items: center;
    justify-content: center;
    margin: 0 -20px;
}
.product-header h1 {
    color: #fff;
    font-size: 36px;
    margin: 0;
}
.product-layout {
    display: flex;
    gap: 40px;
    padding: 40px 0;
}
.product-sidebar {
    width: 250px;
    flex-shrink: 0;
}
.sidebar-title {
    font-size: 18px;
    font-weight: 700;
    padding-bottom: 15px;
    border-bottom: 2px solid #333;
    margin-bottom: 0;
}
.category-list {
    list-style: none;
    padding: 0;
    margin: 0;
}
.cat-item {
    border-bottom: 1px solid #eee;
}
.cat-item > a {
    display: flex;
    justify-content: space-between;
    align-items: center;
    padding: 15px 0;
    color: #333;
    text-decoration: none;
    font-size: 15px;
}
.cat-item > a:hover,
.cat-item.active > a {
    color: #1F4F80 ;
    font-weight:500;
}
.toggle-icon {
    font-size: 14px;
    color: #999;
    transition: transform 0.3s;
}
.cat-item.active .toggle-icon {
    transform: rotate(45deg);
}
.sub-category {
    list-style: none;
    padding: 0 0 10px 15px;
    margin: 0;
    display: none;
}
.sub-category.open {
    display: block;
}
.sub-category li a {
    display: block;
    padding: 8px 0;
    color: #666;
    text-decoration: none;
    font-size: 14px;
}
.sub-category li a:hover,
.sub-category li.active a {
    color: #1F4F80;
}
.product-main {
    flex: 1;
    min-width: 0;
}
.product-search-bar {
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-bottom: 30px;
    padding-bottom: 20px;
    border-bottom: 1px solid #eee;
}
.current-category {
    font-size: 18px;
}
.current-category a {
    color: #666;
    text-decoration: none;
}
.current-category strong {
    color: #333;
}
.product-search-bar form {
    display: flex;
    border: 1px solid #ddd;
    border-radius: 25px;
    overflow: hidden;
}
.product-search-bar input {
    border: none;
    padding: 10px 20px;
    font-size: 14px;
    outline: none;
    width: 200px;
}
.product-search-bar button {
    background: none;
    border: none;
    padding: 10px 15px;
    cursor: pointer;
}
.product-grid {
    display: grid;
    grid-template-columns: repeat(3, 1fr);
    gap: 30px;
}
.product-card {
    background: #fff;
    border: 1px solid #eee;
    border-radius: 10px;
    overflow: hidden;
    transition: box-shadow 0.3s;
}
.product-card:hover {
    box-shadow: 0 5px 20px rgba(0,0,0,0.1);
}
.product-card a {
    text-decoration: none;
    color: inherit;
}
.product-thumb {
    height: 200px;
    display: flex;
    align-items: center;
    justify-content: center;
    padding: 20px;
    background: #f9f9f9;
}
.product-thumb img {
    max-width: 100%;
    max-height: 100%;
    object-fit: contain;
}
.product-info {
    padding: 20px;
}
.product-info h3 {
    font-size: 18px;
    margin: 0 0 5px;
    font-weight: 600;
}
.product-info .usage {
    font-size: 14px;
    color: #666;
    margin-bottom: 15px;
}
.product-info .read-more {
    font-size: 13px;
    color: #333;
    font-weight: 500;
}
.product-pagination {
    margin-top: 40px;
    text-align: center;
}
.product-pagination .page-numbers {
    display: inline-block;
    padding: 10px 15px;
    margin: 0 3px;
    border: 1px solid #ddd;
    color: #333;
    text-decoration: none;
}
.product-pagination .page-numbers.current,
.product-pagination .page-numbers:hover {
    background: #333;
    color: #fff;
    border-color: #333;
}
.mobile-filter {
    display: none;
    margin-bottom: 20px;
}
.mobile-filter select,
.mobile-filter input {
    width: 100%;
    padding: 12px 15px;
    border: 1px solid #ddd;
    border-radius: 5px;
    font-size: 14px;
    margin-bottom: 10px;
}
.mobile-search-row {
    display: flex;
    gap: 10px;
}
.mobile-search-row input {
    flex: 1;
    margin-bottom: 0;
}
.mobile-search-row button {
    padding: 12px 20px;
    background: #333;
    border: none;
    border-radius: 5px;
    cursor: pointer;
}

@media (max-width: 1024px) {
    .product-grid {
        grid-template-columns: repeat(2, 1fr);
    }
}
@media (max-width: 768px) {
    .product-header { height: 200px; }
    .product-header h1 { font-size: 28px; }
    .product-layout { flex-direction: column; gap: 0; }
    .product-sidebar { display: none; }
    .mobile-filter { display: block; }
    .product-search-bar { display: none; }
    .product-grid { grid-template-columns: 1fr; gap: 20px; }
}
</style>

<!-- 히어로 -->
<div class="product-header" style="background: #333 url('<?php echo get_stylesheet_directory_uri(); ?>/assets/images/product.png') center/cover;">
    <h1>제품소개</h1>
</div>

<div class="product-archive">
    <div class="product-layout">
        
        <!-- 사이드바 -->
        <aside class="product-sidebar">
            <h3 class="sidebar-title">제품 카테고리</h3>
            <ul class="category-list">
                <?php foreach ($parent_cats as $parent) : 
                    $child_cats = get_terms([
                        'taxonomy' => 'product_category',
                        'hide_empty' => false,
                        'parent' => $parent->term_id,
                        'orderby'    => 'term_order',
                        'order'      => 'ASC',
                    ]);
                    $has_children = !empty($child_cats);
                    $is_active = ($current_parent_id == $parent->term_id) || ($current_cat_id == $parent->term_id);
                ?>
                    <li class="cat-item <?php echo $has_children ? 'has-children' : ''; ?> <?php echo $is_active ? 'active' : ''; ?>">
                        <a href="<?php echo get_term_link($parent); ?>">
                            <?php echo $parent->name; ?>
                            <?php if ($has_children) : ?>
                                <span class="toggle-icon">+</span>
                            <?php endif; ?>
                        </a>
                        <?php if ($has_children) : ?>
                            <ul class="sub-category <?php echo $is_active ? 'open' : ''; ?>">
                                <?php foreach ($child_cats as $child) : 
                                    $is_child_active = ($current_cat_id == $child->term_id);
                                ?>
                                    <li class="<?php echo $is_child_active ? 'active' : ''; ?>">
                                        <a href="<?php echo get_term_link($child); ?>"><?php echo $child->name; ?></a>
                                    </li>
                                <?php endforeach; ?>
                            </ul>
                        <?php endif; ?>
                    </li>
                <?php endforeach; ?>
            </ul>
        </aside>
        
        <!-- 메인 -->
        <div class="product-main">
            
            <!-- 모바일 필터 -->
            <div class="mobile-filter">
                <form method="get" action="<?php echo get_post_type_archive_link('js_product'); ?>">
                    <select name="cat1" id="mobile-cat1">
                        <option value="">전체 카테고리</option>
                        <?php foreach ($parent_cats as $cat) : ?>
                            <option value="<?php echo $cat->term_id; ?>" <?php selected($current_parent_id, $cat->term_id); ?>><?php echo $cat->name; ?></option>
                        <?php endforeach; ?>
                    </select>
                    <select name="cat2" id="mobile-cat2">
                        <option value="">전체 하위카테고리</option>
                        <?php
                        if ($current_parent_id && $current_parent_id != $current_cat_id) {
                            $child_terms = get_terms(['taxonomy' => 'product_category', 'hide_empty' => false, 'parent' => $current_parent_id, 'orderby' => 'term_order', 'order' => 'ASC']);
                            foreach ($child_terms as $ct) {
                                $sel = ($current_cat_id == $ct->term_id) ? 'selected' : '';
                                echo "<option value='{$ct->term_id}' {$sel}>{$ct->name}</option>";
                            }
                        }
                        ?>
                    </select>
                    <div class="mobile-search-row">
                        <input type="text" name="keyword" value="<?php echo esc_attr($search_keyword); ?>" placeholder="검색어 입력">
                        <button type="submit">
                            <img src="<?php echo get_stylesheet_directory_uri(); ?>/assets/images/ico-search.png" alt="검색" width="18" height="18">
                        </button>
                    </div>
                </form>
            </div>
            
            <!-- 검색바 -->
            <div class="product-search-bar">
                <div class="current-category">
                    <?php
                    $ancestors = get_ancestors($current_term->term_id, 'product_category');
                    if (!empty($ancestors)) {
                        $parent = get_term(end($ancestors), 'product_category');
                        echo '<a href="' . get_term_link($parent) . '">' . $parent->name . '</a>';
                        echo ' <span style="color:#999;">></span> ';
                    }
                    echo '<strong>' . $current_term->name . '</strong>';
                    ?>
                </div>
                <form method="get" action="">
                    <input type="text" name="keyword" value="<?php echo esc_attr($search_keyword); ?>" placeholder="검색어 입력">
                    <button type="submit">
                        <img src="<?php echo get_stylesheet_directory_uri(); ?>/assets/images/ico-search.png" alt="검색" width="18" height="18">
                    </button>
                </form>
            </div>
            
            <!-- 제품 그리드 -->
            <div class="product-grid">
                <?php if (have_posts()) : while (have_posts()) : the_post(); 
                    $usage = get_post_meta(get_the_ID(), '_product_usage', true);
                ?>
                    <div class="product-card" data-aos="fade-up" data-aos-delay="<?php echo $delay; ?>">
                        <a href="<?php the_permalink(); ?>">
                            <div class="product-thumb">
                                <?php if (has_post_thumbnail()) : ?>
                                    <?php the_post_thumbnail('medium'); ?>
                                <?php else : ?>
                                    <span>No Image</span>
                                <?php endif; ?>
                            </div>
                            <div class="product-info">
                                <h3><?php the_title(); ?></h3>
                                <?php if ($usage) : ?>
                                    <p class="usage"><?php echo esc_html($usage); ?></p>
                                <?php endif; ?>
                                <!-- <span class="read-more">READ MORE →</span> -->
                            </div>
                        </a>
                    </div>
                <?php endwhile; else : ?>
                    <p>등록된 제품이 없습니다.</p>
                <?php endif; ?>
            </div>
            
            <!-- 페이징 -->
            <div class="product-pagination">
                <?php echo paginate_links(['prev_text' => '&lt;', 'next_text' => '&gt;']); ?>
            </div>
            
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    document.querySelectorAll('.cat-item.has-children > a').forEach(function(el) {
        el.addEventListener('click', function(e) {
            var parent = this.parentElement;
            var subMenu = parent.querySelector('.sub-category');
            if (subMenu) {
                e.preventDefault();
                parent.classList.toggle('active');
                subMenu.classList.toggle('open');
            }
        });
    });
    
    var mobileCat1 = document.getElementById('mobile-cat1');
    if (mobileCat1) {
        mobileCat1.addEventListener('change', function() {
            var parentId = this.value;
            var cat2Select = document.getElementById('mobile-cat2');
            if (!parentId) {
                cat2Select.innerHTML = '<option value="">전체 하위카테고리</option>';
                return;
            }
            fetch('<?php echo admin_url('admin-ajax.php'); ?>', {
                method: 'POST',
                headers: {'Content-Type': 'application/x-www-form-urlencoded'},
                body: 'action=get_child_cats&parent_id=' + parentId
            })
            .then(response => response.text())
            .then(data => {
                cat2Select.innerHTML = '<option value="">전체 하위카테고리</option>' + data;
            });
        });
    }
});
</script>
<script>
document.addEventListener('DOMContentLoaded', function() {
    // AOS 초기화
    AOS.init({
        duration: 600,
        once: true
    });
    
    // 아코디언 (기존 코드 유지)
    document.querySelectorAll('.cat-item.has-children > a').forEach(function(el) {
        // ...
    });
    
    // 모바일 카테고리2 연동 (기존 코드 유지)
    // ...
});
</script>
<?php get_footer(); ?>