<?php get_header(); ?>

<div class="service-archive">
    <div class="service-header">
        <h1>시험 및 용역</h1>        
    </div>

    <!-- 카테고리 탭 -->
    <div class="service-tabs">
        <a href="<?php echo get_post_type_archive_link('service'); ?>" class="tab <?php echo !is_tax() ? 'active' : ''; ?>">전체</a>
        <?php
        $terms = get_terms(['taxonomy' => 'service_cat', 'hide_empty' => false]);
        foreach ($terms as $term) :
        ?>
            <a href="<?php echo get_term_link($term); ?>" class="tab <?php echo is_tax('service_cat', $term->slug) ? 'active' : ''; ?>">
                <?php echo $term->name; ?>
            </a>
        <?php endforeach; ?>
    </div>

    <!-- 그리드 -->
    <div class="service-grid">
        <?php if (have_posts()) : while (have_posts()) : the_post(); ?>
            <div class="service-item">
                <a href="<?php the_permalink(); ?>">
                    <?php if (has_post_thumbnail()) : ?>
                        <?php the_post_thumbnail('medium'); ?>
                    <?php else : ?>
                        <div class="no-image">이미지 없음</div>
                    <?php endif; ?>
                    <h3><?php the_title(); ?></h3>
                </a>
            </div>
        <?php endwhile; endif; ?>
    </div>

    <!-- 페이징 -->
    <div class="service-pagination">
        <?php
        echo paginate_links([
            'prev_text' => '&lt;',
            'next_text' => '&gt;',
        ]);
        ?>
    </div>
</div>

<?php get_footer(); ?>