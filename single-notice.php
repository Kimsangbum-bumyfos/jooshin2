<?php get_header(); ?>

<div class="notice-single">
    <div class="notice-header">
        <h1>공지사항</h1>
    </div>

    <div class="notice-content">
        <?php if (have_posts()) : while (have_posts()) : the_post(); ?>
            <div class="content-inner">
                <div class="notice-meta">
                    <h2 class="notice-title"><?php the_title(); ?></h2>
                    <span class="notice-date"><?php echo get_the_date('Y.m.d'); ?></span>
                </div>
                
                <div class="notice-text">
                    <?php the_content(); ?>
                </div>
            </div>

            <!-- 이전글/다음글 -->
            <div class="notice-nav-posts">
                <?php
                $prev = get_previous_post();
                $next = get_next_post();
                ?>
                <?php if ($prev) : ?>
                    <a href="<?php echo get_permalink($prev); ?>" class="nav-prev">
                        <span class="nav-label">이전글</span>
                        <span class="nav-title"><?php echo $prev->post_title; ?></span>
                    </a>
                <?php endif; ?>
                <?php if ($next) : ?>
                    <a href="<?php echo get_permalink($next); ?>" class="nav-next">
                        <span class="nav-label">다음글</span>
                        <span class="nav-title"><?php echo $next->post_title; ?></span>
                    </a>
                <?php endif; ?>
            </div>
        <?php endwhile; endif; ?>

        <div class="notice-nav">
            <a href="<?php echo get_post_type_archive_link('notice'); ?>" class="btn-list">목록</a>
        </div>
    </div>
</div>

<?php get_footer(); ?>