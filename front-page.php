<?php get_header(); ?>

<!-- 히어로 슬라이드 -->
<section class="hero-slider">
    <div class="swiper hero-swiper">
        <div class="swiper-wrapper">
            <div class="swiper-slide">
                <div class="slide-bg" style="background-image: url('<?php echo get_stylesheet_directory_uri(); ?>/assets/images/hero1.jpg');"></div>
                <div class="hero-content">
                    <h1>정밀한 측정으로<br>산업의 기준을 만듭니다</h1>
                    <p>주신 엔지니어링은 센서와 계측 기술을 통해<br>현장의 신뢰를 설계합니다.</p>
                    <a href="/product" class="hero-btn">제품보기</a>
                </div>
            </div>
            <div class="swiper-slide">
                <div class="slide-bg" style="background-image: url('<?php echo get_stylesheet_directory_uri(); ?>/assets/images/hero2.jpg');"></div>
                <div class="hero-content">
                    <h1>기술력으로 신뢰를<br>만들어갑니다</h1>
                    <p>다양한 산업 환경에 최적화된<br>계측 솔루션을 제공합니다.</p>
                    <a href="/about" class="hero-btn">회사소개</a>
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
            $products = new WP_Query([
                'post_type' => 'js_product',
                'posts_per_page' => 6,
            ]);
            while ($products->have_posts()) : $products->the_post();
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
            <?php endwhile; wp_reset_postdata(); ?>
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