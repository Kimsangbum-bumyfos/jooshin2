<?php get_header(); ?>

<div class="product-single">
    <div class="product-header">
        <h1>제품소개</h1>
    </div>

    <div class="product-content">
        <?php if (have_posts()) : while (have_posts()) : the_post(); ?>
            <div class="content-inner">
                <h2 class="product-title"><?php the_title(); ?></h2>
                
                <?php if (has_post_thumbnail()) : ?>
                    <div class="product-thumbnail">
                        <?php the_post_thumbnail('large'); ?>
                    </div>
                <?php endif; ?>
                
                <div class="product-text">
                    <?php the_content(); ?>
                </div>
            </div>
        <?php endwhile; endif; ?>

        <div class="product-nav">
            <a href="<?php echo get_post_type_archive_link('js_product'); ?>" class="btn-list">목록</a>
        </div>
    </div>
</div>

<?php get_footer(); ?>