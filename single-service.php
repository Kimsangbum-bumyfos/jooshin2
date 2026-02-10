<?php get_header(); ?>

<div class="service-single">
    <div class="service-header">
        <h1>계측엔지니어링</h1>
    </div>

    <div class="service-content">
        <?php if (have_posts()) : while (have_posts()) : the_post(); ?>
            <div class="content-inner">
                <h2 class="service-title"><?php the_title(); ?></h2>
                
                <?php if (has_post_thumbnail()) : ?>
                    <div class="service-thumbnail">
                        <?php the_post_thumbnail('large'); ?>
                    </div>
                <?php endif; ?>
                
                <div class="service-text">
                    <?php the_content(); ?>
                </div>
            </div>
        <?php endwhile; endif; ?>

        <div class="service-nav">
            <a href="<?php echo get_post_type_archive_link('service'); ?>" class="btn-list">목록</a>
        </div>
    </div>
</div>

<?php get_footer(); ?>