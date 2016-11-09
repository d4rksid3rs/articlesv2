<?php
/*
  Template Name: Gravity Form
 */
get_header();
?>
<?php
/**
 * determine main column size from actived sidebar
 */
$main_column_size = bootstrapBasicGetMainColumnSize();
?> 
<?php if (!wp_is_mobile()) : ?>
    <?php get_sidebar('left'); ?> 
    <div class="col-md-<?php echo $main_column_size; ?> content-area" id="main-column">
        <?php
        /*
         * Requires the following plugin:
         * https://bitbucket.org/jupitercow/gravity-forms-update-post/
         *
         * 1. Create a WordPress page to handle editing events
         * 2. Pass the "gform_post_id" variable with the desired post ID
         * 3. $gform_id is the Gravity Form ID. Visit the "Forms" admin section to see available forms
         */
        $edit_post_id = isset($_GET['gform_post_id']) ? (int) $_GET['gform_post_id'] : 0;
        if (!empty($edit_post_id)) {
            gform_update_post::setup_form($edit_post_id);
            gravity_form($gform_id);
        }
        ?>
        <?php echo do_shortcode('[gravityform id="1" title="false" description="false"]'); ?>
    </div>
    <?php get_sidebar('right'); ?> 
<?php else: ?>
    <div class="col-md-<?php echo $main_column_size; ?> content-area" id="main-column">
        <?php
        /*
         * Requires the following plugin:
         * https://bitbucket.org/jupitercow/gravity-forms-update-post/
         *
         * 1. Create a WordPress page to handle editing events
         * 2. Pass the "gform_post_id" variable with the desired post ID
         * 3. $gform_id is the Gravity Form ID. Visit the "Forms" admin section to see available forms
         */
        $edit_post_id = isset($_GET['gform_post_id']) ? (int) $_GET['gform_post_id'] : 0;
        if (!empty($edit_post_id)) {
            gform_update_post::setup_form($edit_post_id);
            gravity_form($gform_id);
        }
        ?>
        <?php echo do_shortcode('[gravityform id="1" title="false" description="false"]'); ?>
    </div>
    <?php get_sidebar('left'); ?> 
    <?php get_sidebar('right'); ?> 
<?php endif; ?>
<?php get_footer(); ?> 