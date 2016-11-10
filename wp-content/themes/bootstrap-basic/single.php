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
<?php get_sidebar('left'); ?> 
<div class="col-md-<?php echo $main_column_size; ?> content-area" id="main-column">


    <header class="entry-header">
        <h1><?php the_title(); ?></h1>
        <h4>Tác giả: <a href="<?php the_permalink() ?>">                                       
                <?php
                $tac_gia_id = get_post_meta($post->ID, 'tac_gia', true);
                echo get_the_title($tac_gia_id);
                ?></a></h4>
    </header><!-- .entry-header -->
    <?php
    while (have_posts()) {

        the_post();

        get_template_part('content', get_post_format());

        echo "\n\n";

        bootstrapBasicPagination();
        ?>
        <?php // echo postview_get(get_the_ID()); ?>
        <?php
        echo "\n\n";
        // If comments are open or we have at least one comment, load up the comment template
        if (comments_open() || '0' != get_comments_number()) {
            comments_template();
            
        }
        echo "\n\n";
    } //endwhile;
    ?> 

</div>
<?php get_sidebar('right'); ?> 
<?php get_footer(); ?> 