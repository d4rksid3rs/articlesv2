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
<?php if (!wp_is_mobile() ) :?>
<?php get_sidebar('left'); ?> 
<div class="col-md-<?php echo $main_column_size; ?> content-area" id="main-column">
    <div class="row">
        <h1><?php the_title(); ?></h1>
        <div class="col-md-4">
            <header class="entry-header">
                
                
                <a href="<?php the_permalink(); ?>">
                    <?php if (has_post_thumbnail()): ?>
                        <?php the_post_thumbnail(); ?>
                    <?php else: ?>
                        <img src="<?php bloginfo('template_directory'); ?>/img/no-image.png">
                    <?php endif; ?>                                        
                </a>
            </header><!-- .entry-header --> 
        </div>
        <div class="col-md-8">
            <?php $new_query = new WP_Query('post_type=article-author'); ?>
            <?php
            while (have_posts()) {

                the_post();

                get_template_part('content', get_post_format());

                echo "\n\n";

                bootstrapBasicPagination();
                ?>

                
        </div>
    </div>
    <div class="row">
        <h3> Tác phẩm của tác giả</h3>
    <table class="table table-striped">
                    <thead>
                    <td>STT</td>
                    <td>Tác phẩm</td>
                    </thead>
                    <tbody>
                        <?php $i = 1; ?>     


                        <?php
                        echo "\n\n";
                    } //endwhile;
                    ?> 
                    <?php
                    $author_id = get_the_ID();
//    var_dump($author_id);die;
                    $posts = get_posts(array(
                        'numberposts' => -1,
                        'post_type' => 'pasticco',
                        'meta_key' => 'tac_gia',
                        'meta_value' => $author_id
                    ));
//var_dump($posts);die;
                    if ($posts):
                        ?>


                        <?php
                        foreach ($posts as $post):

                            setup_postdata($post)
                            ?>
                            <tr>
                                <td><?php echo $i; ?> </td>
                                <td><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></td>
                            </tr>
                            <?php $i++; ?>
                        <?php endforeach; ?>
                    </tbody>



                    <?php wp_reset_postdata(); ?>

                <?php endif; ?>
            </table>
    </div>
</div>



<?php get_sidebar('right'); ?> 
<?php else : ?>
<div class="col-md-<?php echo $main_column_size; ?> content-area" id="main-column">
    <div class="row">
        <h1><?php the_title(); ?></h1>
        <div class="col-md-4">
            <header class="entry-header">
                
                
                <a href="<?php the_permalink(); ?>">
                    <?php if (has_post_thumbnail()): ?>
                        <?php the_post_thumbnail(); ?>
                    <?php else: ?>
                        <img src="<?php bloginfo('template_directory'); ?>/img/no-image.png">
                    <?php endif; ?>                                        
                </a>
            </header><!-- .entry-header --> 
        </div>
        <div class="col-md-8">
            <?php $new_query = new WP_Query('post_type=article-author'); ?>
            <?php
            while (have_posts()) {

                the_post();

                get_template_part('content', get_post_format());

                echo "\n\n";

                bootstrapBasicPagination();
                ?>

                
        </div>
    </div>
    <div class="row">
        <h3> Tác phẩm của tác giả</h3>
    <table class="table table-striped">
                    <thead>
                    <td>STT</td>
                    <td>Tác phẩm</td>
                    </thead>
                    <tbody>
                        <?php $i = 1; ?>     


                        <?php
                        echo "\n\n";
                    } //endwhile;
                    ?> 
                    <?php
                    $author_id = get_the_ID();
//    var_dump($author_id);die;
                    $posts = get_posts(array(
                        'numberposts' => -1,
                        'post_type' => 'pasticco',
                        'meta_key' => 'tac_gia',
                        'meta_value' => $author_id
                    ));
//var_dump($posts);die;
                    if ($posts):
                        ?>


                        <?php
                        foreach ($posts as $post):

                            setup_postdata($post)
                            ?>
                            <tr>
                                <td><?php echo $i; ?> </td>
                                <td><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></td>
                            </tr>
                            <?php $i++; ?>
                        <?php endforeach; ?>
                    </tbody>



                    <?php wp_reset_postdata(); ?>

                <?php endif; ?>
            </table>
    </div>
</div>
<?php get_sidebar('left'); ?> 
<?php get_sidebar('right'); ?> 
<?php endif; ?>
<?php get_footer(); ?> 