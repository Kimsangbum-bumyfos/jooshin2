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
                        <img src="<?php echo get_stylesheet_directory_uri(); ?>/assets/images/hero1_1.png" alt="KFGS-NE">
                    </div>
                    <div class="slide-text">
                        <!-- <span class="badge-new">신제품</span> -->
                        <p class="slide-desc">세계 최고 수준의 품질의 스트레인 게이지<br> 다양한 용도에 대응할 수 있는 폭넓은 길이와 패턴<br>탁월한 내습성 특징으로 실내 계측은 물론 현장 계측에서도 우수한 성능을 발휘</p>
                        
                        <h2 class="slide-model">STRAIN GAGES </h2>
                        <a href="<?php echo home_url('/products/SW-A-100'); ?>" class="hero-btn">제품보기</a>
                    </div>
                </div>
            </div>

            <!-- 슬라이드 2 -->
            <div class="swiper-slide">
                <div class="slide-inner">
                    <div class="slide-image">
                        <img src="<?php echo get_stylesheet_directory_uri(); ?>/assets/images/hero2_1.png" alt="KFGS-NE">
                    </div>
                    <div class="slide-text">
                        <!-- <span class="badge-new">신제품</span> -->
                        <p class="slide-desc">고정밀, 다채널 정적 데이터로거<br>터치스크린을 이용한 간편한 조작성<br>채널 수 : 30채널/대 (최대 1000채널)</p>
                        <h2 class="slide-model">UCAM-80A</h2>
                        <a href="<?php echo home_url('/products/wgc-220-시리즈'); ?>" class="hero-btn">제품보기</a>
                    </div>
                </div>
            </div>

            <!-- 슬라이드 4 -->
            <div class="swiper-slide">
                <div class="slide-inner">
                    <div class="slide-image">
                        <img src="<?php echo get_stylesheet_directory_uri(); ?>/assets/images/hero3_1.png" alt="KFGS-NE">
                    </div>
                    <div class="slide-text">
                        <!-- <span class="badge-new">신제품</span> -->
                        <p class="slide-desc">컴팩트한 하이엔드 동적 데이터로거<br>최대 측정 속도 : 100kHz<br>채널 수 : 32채널/대 (최대 256채널)</p>
                        <h2 class="slide-model">EDX-200A</h2>
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
                        <!-- <span class="badge-new">신제품</span> -->
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
                <h2>고성능 장비 및 계측 센서</h2>
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

        $terms = get_the_terms(get_the_ID(), 'product_category');
        
        $term_link = '#';

        if (!empty($terms) && !is_wp_error($terms)) {
            $term_link = get_term_link($terms[0]);
        }

    ?>
        <div class="product-card">
            <a href="<?php echo esc_url($term_link); ?>">
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
                <p>주신산업은 신뢰할 수 있는 품질과 경쟁력 있는솔루션을 KYOWA와 함께 고객님들께 전달하고자 합니다.</p>
                <ul class="about-list">
                    <li>정확하고 정밀한 계측</li>
                    <li>글로벌 수준의 품질 보증</li>
                    <li>높은 내구성과 신뢰성</li>
                </ul>
                <a href="<?php echo home_url('/about'); ?>" class="btn-more">자세히 보기</a>
            </div>
        </div>
    </div>
</section>

<!-- 계측엔지니어링 (Service 슬라이드) -->
<section class="section-service">
    <div class="container">

        <div class="section-header">
            <div>
                <span class="section-sub">SERVICE</span>
                <h2>계측엔지니어링</h2>
            </div>
            <a href="<?php echo home_url('/service'); ?>" class="view-all">전체보기 →</a>
        </div>

        <div class="swiper service-swiper">
            <div class="swiper-wrapper">

            <?php
            $services = new WP_Query([
                'post_type'      => 'service',
                'posts_per_page' => 6,
                'orderby'        => 'date',
                'order'          => 'DESC',
            ]);

            while ($services->have_posts()) : $services->the_post();
            ?>
                <div class="swiper-slide">
                    <a href="<?php the_permalink(); ?>" class="service-card">

                        <div class="service-image">
                            <?php if (has_post_thumbnail()) : ?>
                                <?php the_post_thumbnail('large'); ?>
                            <?php endif; ?>
                        </div>

                        <div class="service-title">
                            <?php the_title(); ?>
                        </div>

                    </a>
                </div>
            <?php endwhile; wp_reset_postdata(); ?>

            </div>

            <div class="swiper-pagination"></div>
        </div>

    </div>
</section>


<!-- 문의하기 배너 -->
<section class="section-contact-banner">
    <div class="contact-overlay">
        <h2>제품 및 서비스에 대해 궁금하신 점이 있으신가요?</h2>
        <p>전문 상담원이 친절하게 답변해 드립니다.</p>
        <a href="<?php echo home_url('/faq'); ?>" class="btn-contact">문의하기</a>
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

<script>
document.addEventListener('DOMContentLoaded', function(){

    new Swiper('.service-swiper', {
        slidesPerView: 3,
        spaceBetween: 30,
        loop: true,
        autoplay:{
            delay:4000
        },
        pagination:{
            el: '.service-swiper .swiper-pagination',
            clickable:true
        },
        breakpoints:{
            0:{slidesPerView:1},
            768:{slidesPerView:2},
            1024:{slidesPerView:3}
        }
    });

});
</script>

<?php get_footer(); ?>