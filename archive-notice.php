<?php get_header(); ?>

<div class="notice-archive">
    <div class="notice-header">
        <h1>공지사항</h1>
    </div>

    <div class="notice-content">
        <!-- 검색 -->
        <div class="notice-search">
            <form method="get" action="<?php echo get_post_type_archive_link('notice'); ?>">
                <input type="text" name="s" placeholder="검색어 입력" value="<?php echo get_search_query(); ?>">
                <input type="hidden" name="post_type" value="notice">
                <button type="submit">검색</button>
            </form>
        </div>

        <!-- 테이블 -->
        <div class="notice-table">
            <div class="notice-table-header">
                <span class="col-num">번호</span>
                <span class="col-title">제목</span>
                <span class="col-date">등록일</span>
            </div>

            <?php 
            $paged = get_query_var('paged') ? get_query_var('paged') : 1;
            $total = $wp_query->found_posts;
            $per_page = get_query_var('posts_per_page');
            $num = $total - (($paged - 1) * $per_page);
            
            if (have_posts()) : while (have_posts()) : the_post(); 
            ?>
                <a href="<?php the_permalink(); ?>" class="notice-row">
                    <span class="col-num"><?php echo $num--; ?></span>
                    <span class="col-title"><?php the_title(); ?></span>
                    <span class="col-date"><?php echo get_the_date('Y.m.d'); ?></span>
                </a>
            <?php endwhile; else : ?>
                <div class="no-posts">등록된 공지사항이 없습니다.</div>
            <?php endif; ?>
        </div>

        <!-- 페이징 -->
        <div class="notice-pagination">
            <?php
            echo paginate_links([
                'prev_text' => '&lt;',
                'next_text' => '&gt;',
            ]);
            ?>
        </div>
    </div>
</div>

<?php get_footer(); ?>