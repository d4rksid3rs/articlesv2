<?php
/*
  Template Name: Recent Post
 */
get_header();
?>

<?php
/**
 * determine main column size from actived sidebar
 */
$main_column_size = 9;
?>
<?php if (!wp_is_mobile()) : ?>
    <?php get_sidebar('left'); ?> 
    <div class="col-md-<?php echo $main_column_size; ?> content-area" id="main-column">
        <main id="main" class="site-main" role="main">
            <?php get_header(); ?>
            <?php
            $paged = ( get_query_var('paged') ) ? get_query_var('paged') : 1;

            $args = array(
                'posts_per_page' => 8,
                'paged' => $paged,
                'post_type' => 'pasticco',
                'post_status' => 'publish',
            );
            $i = 0;
            $custom_query = new WP_Query($args);
            ?>
            <div class="row">
                <?php if ($custom_query->have_posts()) : ?>
                    <?php while ($custom_query->have_posts()) : $custom_query->the_post(); ?>
                        <div class="col-md-3">
                            <a class="title" href="<?php the_permalink() ?>"> <h4 class="uppercase"><?php the_title() ?></h4></a>
                            <span class="author"><b>Tác giả: <a href="<?php the_permalink(get_post_meta($post->ID, 'tac_gia', true)) ?>">
                                        <?php
                                        $tac_gia_id = get_post_meta($post->ID, 'tac_gia', true);
                                        $nguoi_viet_id = get_post_meta($post->ID, 'nguoi_viet', true);
                                        if ($tac_gia_id):
                                            echo get_the_title($tac_gia_id);
                                        elseif ($nguoi_viet_id) :
                                            echo $nguoi_viet_id;
                                        else:
                                            echo 'Không có tác giả';
                                            ?>
                                        <?php endif; ?>  <br />
                                </b></span>
                            <p><small><i>Bài viết được đăng bởi:</i><b>
                                        <?php
                                        $a_id = $post->post_author;
                                        $a_name = get_the_author_meta('display_name', $a_id);
                                        echo $a_name;
                                        ?></b></small></p>
                            <div class="pt-cv-content">
                                <?php
                                $i ++;
                                $excerpt = get_the_excerpt();
                                echo string_limit_words($excerpt, 20);
                                ?>                      
                            </div>
                            <a class="btn btn-success" href="<?php the_permalink() ?>">Xem chi tiết <span class="glyphicon glyphicon-arrow-right"></span></a>
                        </div>
                        <?php if ($i % 4 == 0) : ?>
                            <div class="clearfix"></div>
                        <?php endif; ?>
                    <?php endwhile; ?> 
                <?php endif; ?>     
            </div>
            <?php
            if (function_exists("wp_bs_pagination")) {
                wp_bs_pagination($custom_query->max_num_pages);
            }
            ?>
        </main>
    </div>
    <?php get_sidebar('right'); ?>
<?php else : ?>
    <div class="col-md-<?php echo $main_column_size; ?> content-area" id="main-column">
        <main id="main" class="site-main" role="main">
            <?php get_header(); ?>
            <?php
            $paged = ( get_query_var('paged') ) ? get_query_var('paged') : 1;

            $args = array(
                'posts_per_page' => 8,
                'paged' => $paged,
                'post_type' => 'pasticco',
                'post_status' => 'publish',
            );
            $i = 0;
            $custom_query = new WP_Query($args);
            ?>
            <div class="row">
                <?php if ($custom_query->have_posts()) : ?>
                    <?php while ($custom_query->have_posts()) : $custom_query->the_post(); ?>
                        <div class="col-md-3">
                            <a class="title" href="<?php the_permalink() ?>"> <h4 class="uppercase"><?php the_title() ?></h4></a>
                            <span class="author"><b>Tác giả: <a href="<?php the_permalink(get_post_meta($post->ID, 'tac_gia', true)) ?>">
                                        <?php
                                        $nguoi_viet_id = get_post_meta($post->ID, 'nguoi_viet', true);
                                        if ($tac_gia_id):
                                            echo get_the_title($tac_gia_id);
                                        elseif ($nguoi_viet_id) :
                                            echo $nguoi_viet_id;
                                        else:
                                            echo 'Không có tác giả';
                                            ?>
                                        <?php endif; ?>  <br />
                                </b></span>
                            <p><small><i>Bài viết được đăng bởi:</i><b>
                                        <?php
                                        $a_id = $post->post_author;
                                        $a_name = get_the_author_meta('display_name', $a_id);
                                        echo $a_name;
                                        ?></b></small></p>
                            <div class="pt-cv-content">
                                <?php
                                $i ++;
                                $excerpt = get_the_excerpt();
                                echo string_limit_words($excerpt, 20);
                                ?>                      
                            </div>
                            <a class="btn btn-success" href="<?php the_permalink() ?>">Xem chi tiết <span class="glyphicon glyphicon-arrow-right"></span></a>
                        </div>
                        <?php if ($i % 4 == 0) : ?>
                            <div class="clearfix"></div>
                        <?php endif; ?>
                    <?php endwhile; ?> 
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
    <?php get_sidebar('right'); ?>
<?php endif; ?>
<?php get_footer(); ?>