<?php
/**
 * The main template file
 * 
 * @package bootstrap-basic
 */
get_header();

/**
 * determine main column size from actived sidebar
 */
$main_column_size = 9;
?>
<?php if (!wp_is_mobile()) : ?>
    <?php get_sidebar('left'); ?> 
    <div class="col-md-<?php echo $main_column_size; ?> content-area" id="main-column">
        <main id="main" class="site-main" role="main">
            <?php
            $cat_name = get_category(get_query_var('cat'))->name;
            $category_id = get_cat_ID($cat_name);
            $paged = ( get_query_var('paged') ) ? get_query_var('paged') : 1;
            $args = array(
                'posts_per_page' => 8,
                'paged' => $paged,
                'post_type' => 'pasticco',
                'post_status' => 'publish',
                'cat' => $category_id
            );
            $custom_query = null;
            $custom_query = new WP_Query($args);
            ?>
            <div class="row">
                <?php if ($custom_query->have_posts()) : ?>
                    <?php while ($custom_query->have_posts()) : $custom_query->the_post(); ?>
                        <div class="col-md-3">
                            <a class="title" href="<?php the_permalink() ?>"> <h4><?php the_title() ?></h4></a>
                            <span class="author"><b><a href="<?php the_permalink(get_post_meta($post->ID, 'tac_gia', true)) ?>">
                                        <?php
                                        $tac_gia_id = get_post_meta($post->ID, 'tac_gia', true);
                                        echo get_the_title($tac_gia_id);
                                        ?>
                                        <?php if (has_post_thumbnail()) : ?>
                                            <img src="<?php the_post_thumbnail_url(); ?>" title="<?php the_title_attribute(); ?>"/>
                                        <?php endif; ?>
                                    </a></b></span>
                            <p><small><i>Bài viết được đẳng bởi:</i><b>
                                    <?php
                                    $a_id = $post->post_author;
                                    $a_name = get_the_author_meta('display_name', $a_id);
                                    echo $a_name;
                                    ?></b></small></p>
                            <div class="pt-cv-content">
                                <?php
                                $excerpt = get_the_excerpt();
                                echo string_limit_words($excerpt, 25);
                                ?>                      
                            </div>
                            <a class="btn btn-success" href="<?php the_permalink() ?>">Xem chi tiết <span class="glyphicon glyphicon-arrow-right"></span></a>
                        </div>

                    <?php endwhile; ?> 
                <?php else: ?>
                    <h3>Không có bài trong danh mục này</h3>
                <?php endif; ?>     
            </div>
            <?php
            if (function_exists("wp_bs_pagination")) {
                wp_bs_pagination($custom_query->max_num_pages);
            }
            ?>
        </main>
    </div>
<?php else: ?>
    <div class="col-md-<?php echo $main_column_size; ?> content-area" id="main-column">
        <main id="main" class="site-main" role="main">
            <?php
            $cat_name = get_category(get_query_var('cat'))->name;
            $category_id = get_cat_ID($cat_name);
            $paged = ( get_query_var('paged') ) ? get_query_var('paged') : 1;
            $args = array(
                'posts_per_page' => 8,
                'paged' => $paged,
                'post_type' => 'pasticco',
                'post_status' => 'publish',
                'cat' => $category_id
            );
            $custom_query = null;
            $custom_query = new WP_Query($args);
            ?>
            <div class="row">
                <?php if ($custom_query->have_posts()) : ?>
                    <?php while ($custom_query->have_posts()) : $custom_query->the_post(); ?>
                        <div class="col-md-3">
                            <a class="title" href="<?php the_permalink() ?>"> <h4><?php the_title() ?></h4></a>
                            <span class="author"><b><a href="<?php the_permalink(get_post_meta($post->ID, 'tac_gia', true)) ?>">
                                        <?php
                                        $tac_gia_id = get_post_meta($post->ID, 'tac_gia', true);
                                        echo get_the_title($tac_gia_id);
                                        ?>
                                        <?php if (has_post_thumbnail()) : ?>
                                            <img src="<?php the_post_thumbnail_url(); ?>" title="<?php the_title_attribute(); ?>"/>
                                        <?php endif; ?>
                                    </a></b></span>
                            <p><small><i>Bài viết được đẳng bởi:</i><b>
                                    <?php
                                    $a_id = $post->post_author;
                                    $a_name = get_the_author_meta('display_name', $a_id);
                                    echo $a_name;
                                    ?></b></small></p>
                            <div class="pt-cv-content">
                                <?php
                                $excerpt = get_the_excerpt();
                                echo string_limit_words($excerpt, 25);
                                ?>                      
                            </div>
                            <a class="btn btn-success" href="<?php the_permalink() ?>">Xem chi tiết <span class="glyphicon glyphicon-arrow-right"></span></a>
                        </div>

                    <?php endwhile; ?> 
                <?php else: ?>
                    <h3>Không có bài trong danh mục này</h3>
                <?php endif; ?>     
            </div>
            <?php
            if (function_exists("wp_bs_pagination")) {
                wp_bs_pagination($custom_query->max_num_pages);
            }
            ?>
        </main>
    </div>
    <?php get_sidebar('left'); ?>
<?php endif; ?>
<?php get_footer(); ?> 