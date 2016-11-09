<?php
/*
  Template Name: Home Page
 */

get_header();
?>
<?php
/**
 * determine main column size from actived sidebar
 */
$main_column_size = 12;
global $post;
?> 
<?php // get_sidebar('left');                                         ?> 
<div class="col-md-<?php echo $main_column_size; ?> content-area" id="main-column">
    <main id="main" class="site-main" role="main">  
        <?php
//        $paged = ( get_query_var('paged') ) ? get_query_var('paged') : 1;
//        $args = array(
//            'posts_per_page' => 8,
//            'paged' => $paged
//        );
//        $custom_query = new WP_Query($args);
        ?>
        <?php
        $args = array(
            'posts_per_page' => 4,
            'paged' => $paged,
            'post_type' => 'pasticco',
            'post_status' => 'publish',
        );
        $i = 0;
        $custom_query = new WP_Query($args);
        ?>
        <div class="row">
            <div class="category section recent">
                <h3 class="uppercase">Bài mới nhất</h3>
                <?php if ($custom_query->have_posts()) : ?>
                    <?php while ($custom_query->have_posts()) : $custom_query->the_post(); ?>
                        <div class="col-md-3">
                            <a class="title" href="<?php the_permalink() ?>"> <h4 class="uppercase"><?php the_title() ?></h4></a>
                            <span class="author"><b> <a href="<?php the_permalink(get_post_meta($post->ID, 'tac_gia', true)) ?>"><?php $tac_gia_id = get_post_meta($post->ID, 'tac_gia', true); ?>
                                        <?php
                                        $nguoi_viet_id = get_post_meta($post->ID, 'nguoi_viet', true);
                                        if ($tac_gia_id):
                                            echo get_the_title($tac_gia_id);
                                        elseif ($nguoi_viet_id) :
                                            echo $nguoi_viet_id;
                                        else:
                                            echo 'Không có tác giả';
                                            ?>
                                        <?php endif; ?>                                       
                                    </a></b></span>
                            <p><small><i>Bài viết được đăng bởi:</i><b>
                                        <?php
                                        $a_id = $post->post_author;
                                        $a_name = get_the_author_meta('display_name', $a_id);
                                        echo $a_name;
                                        ?></b></small></p>
                            <div class="pt-cv-content">
                                <?php if (has_post_thumbnail()) : ?>
                                    <a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>">
                                        <img src="<?php the_post_thumbnail_url(); ?>"/>
                                    </a>
                                <?php endif; ?>
                                <br />
                                <?php
                                $i ++;
                                $excerpt = get_the_excerpt();
                                echo string_limit_words($excerpt, 20);
                                ?>
                                <a class="btn btn-success" href="<?php the_permalink() ?>"><span class="glyphicon glyphicon-arrow-right"></span></a>
                            </div>
                        </div>
                        <?php if ($i % 4 == 0) : ?>
                            <div class="clearfix"></div>
                        <?php endif; ?>
                    <?php endwhile; ?> 
                <?php endif; ?>
            </div>
        </div>
        <?php
//get all categories then display all posts in each term
        $taxonomy = 'category';
        $param_type = 'category__in';
        $term_args = array(
            'orderby' => 'name',
            'order' => 'ASC'
        );
        $terms = get_terms($taxonomy, $term_args);
        if ($terms) {
            foreach ($terms as $term) {
                $cat = get_category_link($term->term_id);

                $args = array(
                    "$param_type" => array($term->term_id),
                    'post_type' => 'pasticco',
                    'post_status' => 'publish',
                    'posts_per_page' => -1,
                    'caller_get_posts' => 1,
                    'showposts' => 4
                );
                $my_query = null;
                $my_query = new WP_Query($args);
                if ($my_query->have_posts()) {
                    ?>
                    <div class="row">
                        <div class="category section">
                            <h3 ><a class="uppercase" href="<?php echo $cat; ?>"><?php echo '' . $term->name; ?></a></h3>
                            <?php while ($my_query->have_posts()) : $my_query->the_post(); ?>
                                                                                                                                                                                                            <!--        <li><a href="<?php the_permalink() ?>" rel="bookmark" title="Permanent Link to <?php the_title_attribute(); ?>"><?php the_title(); ?></a></li> -->
                                <div class="col-md-3">
                                    <a class="title" href="<?php the_permalink() ?>"> <h4><?php the_title() ?></h4></a>
                                    <span class="author"><b><a href="<?php the_permalink(get_post_meta($post->ID, 'tac_gia', true)) ?>">
                                                <?php
                                                $tac_gia_id = get_post_meta($post->ID, 'tac_gia', true);
                                                $nguoi_viet_id = get_post_meta($post->ID, 'nguoi_viet', true);
                                                if ($tac_gia_id):
                                                    echo get_the_title($tac_gia_id);
                                                elseif ($nguoi_viet_id):
                                                    echo $nguoi_viet_id;
                                                else :
                                                    echo 'Không có tác giả';
                                                endif;
                                                ?>
                                            </a></b></span>
                                    <p><small><i>Bài viết được đẳng bởi:</i><b>
                                                <?php
                                                $a_id = $post->post_author;
                                                $a_name = get_the_author_meta('display_name', $a_id);
                                                echo $a_name;
                                                ?></b></small></p>
                                    <div class="pt-cv-content">
                                        <?php if (has_post_thumbnail()) : ?>
                                            <a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>">
                                                <img src="<?php the_post_thumbnail_url(); ?>"/>
                                            </a>
                                        <?php endif; ?>
                                        <br />
                                        <?php
                                        $i ++;
                                        $excerpt = get_the_excerpt();
                                        echo string_limit_words($excerpt, 20);
                                        ?>
                                        </p>
                                        <a class="btn btn-success" href="<?php the_permalink() ?>"><span class="glyphicon glyphicon-arrow-right"></span></a>
                                    </div>
                                </div>
                                <?php
                            endwhile;
                            ?>
                        </div>
                    </div>
                    <?php
                }
            }
        }
        wp_reset_query();  // Restore global post data stomped by the_post().
        ?>    
        <?php
//        if (function_exists("wp_bs_pagination")) {
//            wp_bs_pagination($custom_query->max_num_pages);
//        }
        ?>
    </main>
</div>
<?php // get_sidebar('right');       ?> 
<?php get_footer(); ?> 