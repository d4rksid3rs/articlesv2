<?php
/**
 * Template for displaying pages
 * 
 * @package bootstrap-basic
 */
get_header();
?>

<?php
/**
 * determine main column size from actived sidebar
 */
$main_column_size = bootstrapBasicGetMainColumnSize();
?> </br>
<?php if (!wp_is_mobile()) : ?>
    <?php get_sidebar('left'); ?> 
    <div class="col-md-<?php echo $main_column_size; ?> content-area" id="main-column">        
        <header class="entry-header">
            <div class="title">
                <h1><?php the_title(); ?></h1>
                <?php $user_ID = get_current_user_id(); ?>
                <?php $edit_post = get_permalink(81) . '?gform_post_id=' . $post->ID; ?>
                <?php if (is_super_admin($user_ID)) : ?>
                                                                                                                                                                                                                <!--<a class = "btn btn-success" href="<?php echo esc_url(get_permalink(551)); ?>?&edit=<?php echo $post->ID; ?>">Sửa</a >-->
                    <a class = "btn btn-success" href="<?php echo $edit_post; ?>">Sửa</a >
                    <?php
                    if (get_post_status() == "pending") : {
                            echo '' . show_publish_button() . '';
                        }
                        ?>
                    <?php else: ?>
                    <?php endif; ?>
                </div>
                <div class="clearfix"></div>
                <h4> 
                    <?php $tac_gia_id = get_post_meta($post->ID, 'tac_gia', true); ?>
                    <?php if ($tac_gia_id) : ?>
                        <a href = "<?php the_permalink(get_post_meta($post->ID, 'tac_gia', true)) ?>"><?php echo get_the_title($tac_gia_id); ?></a> 

                        <?php
                    else :
                        $nguoi_viet_id = get_post_meta($post->ID, 'nguoi_viet', true);
                        echo $nguoi_viet_id;
                        ?>

                        <br />              
                        <?php if (has_post_thumbnail()) : ?>                                           
                            <img src="<?php the_post_thumbnail_url(); ?>"/>
                        <?php endif; ?> 
                    <?php
                    endif;
                endif;
                ?>
                <div class="clearfix"></div>
                <p><small><i>Bài viết được đẳng bởi:</i><b>
                            <?php
                            $a_id = $post->post_author;
                            $a_name = get_the_author_meta('display_name', $a_id);
                            echo $a_name;
                            ?></b></small></p>
                <i>&nbsp;<?php // echo do_shortcode('[post-views]');                                  ?></i>
                <?php // echo do_shortcode('[post-views]');             ?>
            </h4>
        </header><!--.entry-header -->
        <?php
        while (have_posts()) {

            the_post();
            get_template_part('content', get_post_format());
            echo "\n\n";

            // If comments are open or we have at least one comment, load up the comment template.
            bootstrapBasicPagination();
            ?>
            <?php
        } //endwhile;
        ?>
        <div class="related row">
            <h4 class="uppercase"> Tác phẩm cùng Tác giả</h4>   
            <?php $author_id = get_post_meta(get_the_ID(), 'tac_gia'); ?>
            <?php if ($author_id) : ?>
                <?php
                $posts = get_posts(array(
                    'numberposts' => -1,
                    'post_type' => 'pasticco',
                    'meta_key' => 'tac_gia',
                    'meta_value' => $author_id
                ));
                wp_reset_query();
                if ($posts):
                    $i = 1;
                    foreach ($posts as $post):
                        setup_postdata($post)
                        ?>
                        <?php
                        $b_id = $posts->posts_author;
                        $b_name = get_the_author_meta('display_name', $b_id);
                        ?>
                        <ul id="post">
                            <li><?php echo $i; ?>. <a href="<?php the_permalink(); ?>"><?php the_title(); ?> </a><span class="pull-right"><small><i>(Người đăng:</i><b> <?php echo $b_name ?>)</b></small></span>
                            </li>
                        </ul>
                        <?php $i++;
                        ?>
                    <?php endforeach; ?>
                    <?php wp_reset_postdata(); ?>

                <?php endif; ?>
            <?php endif; ?>

            <?php
            if (comments_open() || get_comments_number()) :
                comments_template();
            endif;
            ?>
        </div>

    </div>
    <?php get_sidebar('right'); ?> 
<?php else : ?>

    <div class="col-md-<?php echo $main_column_size; ?> content-area" id="main-column">

        <header class="entry-header">
            <div class="title">
                <h1><?php the_title(); ?></h1>
                <?php $user_ID = get_current_user_id(); ?>
                <?php $edit_post = get_permalink(81) . '?gform_post_id=' . $post->ID; ?>
                <?php if (is_super_admin($user_ID)) : ?>
                                                                                                                                                                                                        <!--<a class = "btn btn-success" href="<?php echo esc_url(get_permalink(551)); ?>?&edit=<?php echo $post->ID; ?>">Sửa</a >-->
                    <a class = "btn btn-success" href="<?php echo $edit_post; ?>">Sửa</a >
                <?php endif; ?>
            </div>
            <div class="clearfix"></div>
            <h4>
                <a href = "<?php the_permalink(get_post_meta($post->ID, 'tac_gia', true)) ?>">
                    <?php $tac_gia_id = get_post_meta($post->ID, 'tac_gia', true); ?>
                    <?php
                    if ($tac_gia_id) : {
                            echo get_the_title($tac_gia_id);
                        } else :
                        $nguoi_viet_id = get_post_meta($post->ID, 'nguoi_viet', true);
                        echo $nguoi_viet_id;
                        ?>
                    <?php endif; ?>
                </a> <br />              
                <?php if (has_post_thumbnail()) : ?>                                           
                    <img src="<?php the_post_thumbnail_url(); ?>"/>
                <?php endif; ?>                 
                <i>&nbsp;<?php // echo do_shortcode('[post-views]');                              ?></i>
                <?php // echo do_shortcode('[post-views]');                ?>
            </h4>
            <div class="clearfix"></div>
            <p><small><i>Bài viết được đẳng bởi:</i><b>
                        <?php
                        $a_id = $post->post_author;
                        $a_name = get_the_author_meta('display_name', $a_id);
                        echo $a_name;
                        ?></b></small></p>
        </header><!--.entry-header -->
        <?php
        while (have_posts()) {

            the_post();

            get_template_part('content', get_post_format());

            echo "\n\n";

            bootstrapBasicPagination();
            ?>
            <?php
        } //endwhile;
        ?>
        <div class="related row">
            <h4 class="uppercase"> Tác phẩm cùng Tác giả</h4>   
            <?php $author_id = get_post_meta(get_the_ID(), 'tac_gia'); ?>
            <?php if ($author_id) : ?>
                <?php
                $posts = get_posts(array(
                    'numberposts' => -1,
                    'post_type' => 'pasticco',
                    'meta_key' => 'tac_gia',
                    'meta_value' => $author_id
                ));
                wp_reset_query();
                if ($posts):
                    $i = 1;
                    foreach ($posts as $post):
                        setup_postdata($post)
                        ?>
                        <?php
                        $b_id = $posts->posts_author;
                        $b_name = get_the_author_meta('display_name', $b_id);
                        ?>
                        <ul id="post">
                            <li><?php echo $i; ?>. <a href="<?php the_permalink(); ?>"><?php the_title(); ?> </a><span class="pull-right"><small><i>(Người đăng:</i><b> <?php echo $b_name ?>)</b></small></span>
                            </li>
                        </ul>
                        <?php $i++;
                        ?>
                    <?php endforeach; ?>
                    <?php wp_reset_postdata(); ?>

                <?php endif; ?>
            <?php endif; ?>
            <?php
            if (comments_open() || get_comments_number()) :
                comments_template();
            endif;
            ?>
        </div>

    </div>
    <?php get_sidebar('left'); ?> 
    <?php get_sidebar('right'); ?> 
<?php endif; ?>
<?php get_footer(); ?> 