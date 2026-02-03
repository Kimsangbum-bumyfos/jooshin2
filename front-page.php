<?php get_header(); ?>

<!-- 히어로 슬라이드 -->
<!-- 히어로 슬라이드 -->
<section class="hero-slider">
    <div class="swiper hero-swiper">
        <div class="swiper-wrapper">


            <!-- 슬라이드 1 -->
            <div class="swiper-slide">
                <div class="slide-inner">
                    <div class="slide-image">
                        <img src="<?php echo get_stylesheet_directory_uri(); ?>/assets/images/hero1.png" alt="KFGS-NE">
                    </div>
                    <div class="slide-text">
                        <span class="badge-new">신제품</span>
                        <p class="slide-desc">응력 집중 부위에 초밀착하여 측정 가능<br>코너형 스트레인 게이지</p>
                        <h2 class="slide-model">KFGS-NE</h2>
                        <a href="<?php echo home_url('/products/KFGS'); ?>" class="hero-btn">제품보기</a>
                    </div>
                </div>
            </div>

            <!-- 슬라이드 2 -->
            <div class="swiper-slide">
                <div class="slide-inner">
                    <div class="slide-image">
                        <img src="<?php echo get_stylesheet_directory_uri(); ?>/assets/images/hero2.png" alt="KFGS-NE">
                    </div>
                    <div class="slide-text">
                        <span class="badge-new">신제품</span>
                        <p class="slide-desc">터치 패널을 적용한 직관적인 인터페이스<br>채널 간 합산 연산 처리 기능 탑재<br>2채널 계측용 앰프</p>
                        <h2 class="slide-model">WGC-220 시리즈</h2>
                        <a href="<?php echo home_url('/products/wgc-220-시리즈'); ?>" class="hero-btn">제품보기</a>
                    </div>
                </div>
            </div>

            <!-- 슬라이드 4 -->
            <div class="swiper-slide">
                <div class="slide-inner">
                    <div class="slide-image">
                        <img src="<?php echo get_stylesheet_directory_uri(); ?>/assets/images/hero4.png" alt="KFGS-NE">
                    </div>
                    <div class="slide-text">
                        <span class="badge-new">신제품</span>
                        <p class="slide-desc">응력 집중 부위에 초밀착하여 측정 가능<br>코너형 스트레인 게이지</p>
                        <h2 class="slide-model">KFGS-NE</h2>
                        <a href="<?php echo home_url('/products/KFGS-NE'); ?>" class="hero-btn">제품보기</a>
                    </div>
                </div>
            </div>

             <!-- 슬라이드 3 -->
           <div class="swiper-slide">
                <div class="slide-inner">
                    <div class="slide-image">
                        <img src="<?php echo get_stylesheet_directory_uri(); ?>/assets/images/hero3.png" alt="KFGS-NE">
                    </div>
                    <div class="slide-text">
                        <span class="badge-new">신제품</span>
                        <p class="slide-desc">보상온도 195℃<br>고온용 소형 인장/압축 로드셀</p>
                        <h2 class="slide-model">LUXT-A</h2>
                        <a href="<?php echo home_url('/products/LUXT-A'); ?>" class="hero-btn">제품보기</a>
                    </div>
                </div>
            </div>


        </div>
        <div class="swiper-pagination"></div>
        <div class="swiper-button-prev"></div>
        <div class="swiper-button-next"></div>
    </div>
</section>

<!-- 제품소개 -->
<section class="section-products">
    <div class="container">
        <div class="section-header">
            <div>
                <span class="section-sub">PRODUCTS</span>
                <h2>산업 현장을 위한 정밀 계측 솔루션</h2>
            </div>
            <a href="/products" class="view-all">전체보기 →</a>
        </div>
       <div class="product-grid">
    <?php
    // 1) 메인노출 체크된 제품 먼저
    $main_products = new WP_Query([
        'post_type'      => 'js_product',
        'posts_per_page' => 6,
        'meta_key'       => '_js_main_display',
        'meta_value'     => '1',
        'orderby'        => 'date',
        'order'          => 'DESC',
    ]);

    $displayed_ids = [];
    $count = 0;

    while ($main_products->have_posts() && $count < 6) : $main_products->the_post();
        $displayed_ids[] = get_the_ID();
        $count++;
    ?>
        <div class="product-card">
            <a href="<?php the_permalink(); ?>">
                <div class="product-image">
                    <?php if (has_post_thumbnail()) : ?>
                        <?php the_post_thumbnail('medium'); ?>
                    <?php else : ?>
                        <div class="no-image">No Image</div>
                    <?php endif; ?>
                </div>
                <div class="product-info">
                    <h3><?php the_title(); ?></h3>
                    <p><?php echo esc_html(get_post_meta(get_the_ID(), '_product_usage', true)); ?></p>
                </div>
            </a>
        </div>
    <?php endwhile; wp_reset_postdata();

    // 2) 6개 미만이면 나머지 최신순으로 채움
    if ($count < 6) :
        $fill_products = new WP_Query([
            'post_type'      => 'js_product',
            'posts_per_page' => 6 - $count,
            'post__not_in'   => $displayed_ids,
            'orderby'        => 'date',
            'order'          => 'DESC',
        ]);

        while ($fill_products->have_posts()) : $fill_products->the_post();
    ?>
        <div class="product-card">
            <a href="<?php the_permalink(); ?>">
                <div class="product-image">
                    <?php if (has_post_thumbnail()) : ?>
                        <?php the_post_thumbnail('medium'); ?>
                    <?php else : ?>
                        <div class="no-image">No Image</div>
                    <?php endif; ?>
                </div>
                <div class="product-info">
                    <h3><?php the_title(); ?></h3>
                    <p><?php echo get_the_excerpt(); ?></p>
                </div>
            </a>
        </div>
    <?php endwhile; wp_reset_postdata();
    endif; ?>
</div>
    </div>
</section>

<!-- 회사소개 -->
<section class="section-about">
    <div class="container">
        <div class="about-wrap">
            <div class="about-image">
                <img src="<?php echo get_stylesheet_directory_uri(); ?>/assets/images/about.jpg" alt="회사소개">
            </div>
            <div class="about-content">
                <span class="section-sub">ABOUT US</span>
                <h2>정밀 계측으로 산업 현장의<br>신뢰를 쌓아 왔습니다</h2>
                <p>주신 엔지니어링은 오랜 현장 경험과 기술 노하우를 바탕으로 산업용 센서 및 계측 솔루션을 제공해 왔습니다.</p>
                <ul class="about-list">
                    <li>산업용 센서 및 계측 장비 공급</li>
                    <li>현장 환경에 맞춘 기술 상담 및 제안</li>
                    <li>신뢰성 중심의 제품 선정과 지원</li>
                </ul>
                <a href="/about" class="btn-more">자세히 보기</a>
            </div>
        </div>
    </div>
</section>

<!-- 문의하기 배너 -->
<section class="section-contact-banner">
    <div class="contact-overlay">
        <h2>제품 및 서비스에 대해 궁금하신 점이 있으신가요?</h2>
        <p>전문 상담원이 친절하게 답변해 드립니다.</p>
        <a href="/contact" class="btn-contact">문의하기</a>
    </div>
</section>

<!-- 공지사항 -->
<section class="section-notice">
    <div class="container">
        <div class="section-header">
            <h2>공지사항</h2>
            <a href="/notice" class="view-all">전체보기 →</a>
        </div>
        <div class="notice-list">
            <?php
            $notices = new WP_Query([
                'post_type' => 'notice',
                'posts_per_page' => 5,
            ]);
            while ($notices->have_posts()) : $notices->the_post();
            ?>
            <a href="<?php the_permalink(); ?>" class="notice-item">
                <span class="notice-date"><?php echo get_the_date('Y.m.d'); ?></span>
                <span class="notice-name"><?php the_title(); ?></span>
                <span class="notice-arrow">→</span>
            </a>
            <?php endwhile; wp_reset_postdata(); ?>
        </div>
    </div>
</section>

<?php get_footer(); ?>