<?php
/* Template Name: Edit Posts */
//$post_id = $_GET['edit'];

$query = new WP_Query(array('post_type' => 'pasticco', 'posts_per_page' => '-1', 'post_status' => array('publish', 'pending', 'draft', 'private', 'trash')));

if ($query->have_posts()) : while ($query->have_posts()) : $query->the_post();

        if (isset($_GET['edit'])) {

            if ($_GET['edit'] == $post->ID) {
                $current_post = $post->ID;
//                $url = the_permalink();
                $title = get_the_title();
                $content = get_the_content();
                $tac_gia = get_post_meta($post->ID, 'tac_gia');
                $cat = wp_get_post_categories($post->ID);
                $category = $cat[0];
                if (has_post_thumbnail()) {
                    $thumbnail = true;
                    $image = wp_get_attachment_url(get_post_thumbnail_id());
                }
            }
        }

    endwhile;
endif;
if ($_POST) {
    update_post_data($current_post);
}

function update_post_data() {
//    var_dump($_POST);die;
    if (empty($_POST) || !wp_verify_nonce($_POST['name_of_nonce_field'], 'name_of_my_action')) {
        print 'Sorry, your nonce did not verify.';
        exit;
    } else {
        // Do some minor form validation to make sure there is content
        if (isset($_POST['title'])) {
            $title = $_POST['title'];
        } else {
            $title = '';
        }
        if (isset($_POST['description'])) {
            $description = $_POST['description'];
        } else {
            $description = '';
        }
        if (isset($_POST['cat'])) {
            $category = array($_POST['cat']);
        } else {
            $category = 0;
        }
        if (isset($_POST['tac-gia'])) {
            $tacgia = $_POST['tac-gia'];
        } else {
            $tacgia = 0;
        }
        // Add the content of the form to $post as an array
        $post = array(
            'post_title' => wp_strip_all_tags($title),
            'post_content' => $description,
            'post_category' => $category, // Usable for custom taxonomies too
            'post_status' => 'publish', // Choose: publish, preview, future, etc.
            'post_type' => 'pasticco'  // Use a custom post type if you want to
        );
        $new_post_id = wp_update_post($post);  // http://codex.wordpress.org/Function_Reference/wp_insert_post
        $location = get_permalink($new_post_id);
//        wp_redirect($location);
//        exit;
//        var_dump($location);die;
        add_post_meta($new_post_id, "tac_gia", $tacgia); // Add Custom field
        wp_redirect($location);
//        exit;
        require_once(ABSPATH . "wp-admin" . '/includes/image.php');
        require_once(ABSPATH . "wp-admin" . '/includes/file.php');
        require_once(ABSPATH . "wp-admin" . '/includes/media.php');
//        var_dump($_FILES);die;
        if (isset($_FILES['thumbnail']['name'])) {
            foreach ($_FILES as $file => $array) {
                if ($_FILES[$file]['error'] !== UPLOAD_ERR_OK) {
                    return "upload error : " . $_FILES[$file]['error'];
                }
                $attach_id = media_handle_upload($file, $new_post_id);
            }
        }
        if ($attach_id > 0) {
            //and if you want to set that image as Post  then use:
            update_post_meta($new_post_id, '_thumbnail_id', $attach_id);
        }
//        $location = get_permalink(45);
    } // end IF
}


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
        <form id="custom-post-type" name="custom-post-type" method="post" action="" enctype="multipart/form-data">

            <p><label for="title">Tên bài</label><br />

                <input type="text" id="title" value="<?php echo $title; ?>" tabindex="1" size="20" name="title" />

            </p> 

            <p><label for="title">Tác giả</label><br />
                <?php generate_post_select('tac-gia', 'article-author', $tac_gia[0]) ?>

            </p>
            <p>
                <label for="title">Thể loại</label><br />
                <?php
                $args = array(
                    'show_option_none' => '',
                    'taxonomy' => 'category',
                    'hide_empty' => 0,
                    'selected' => $category
                );
                ?>
                <?php wp_dropdown_categories($args); ?>
            </p>

            <p><label for="description">Nội dung</label><br />

            <!--                <textarea id="description" tabindex="3" name="description" cols="50" rows="6"><?php echo $content; ?></textarea>-->
                <?php
//                $old_description = get_post_meta($post->ID, 'description', true);
//                echo $content;die;
                $editor_id = 'description';
                $settings = array('media_buttons' => false );
                wp_editor($content, $editor_id, $settings);
                ?>

            </p>
            <p><label for="description">Upload</label><br />

                <input type="file" name="thumbnail" id="thumbnail">

            </p>
            <?php if ($thumbnail): ?>
                <img src="<?php echo $image; ?>" />
            <?php endif; ?>

            <p><input type="submit" value="Publish" tabindex="6" id="submit" name="submit" /></p>

            <input type="hidden" name="post-type" id="post-type" value="custom_posts" />

            <input type="hidden" name="action" value="custom_posts" />

            <?php wp_nonce_field('name_of_my_action', 'name_of_nonce_field'); ?>

        </form>
        <div class="clearfix"></div>
    </div>
    <?php get_sidebar('right'); ?> 
<?php else : ?>
    <div class="col-md-<?php echo $main_column_size; ?> content-area" id="main-column">
        <form id="custom-post-type" name="custom-post-type" method="post" action="" enctype="multipart/form-data">

            <p><label for="title">Tên bài</label><br />

                <input type="text" id="title" value="<?php echo $title; ?>" tabindex="1" size="20" name="title" />

            </p> 

            <p><label for="title">Tác giả</label><br />
                <?php generate_post_select('tac-gia', 'article-author', $tac_gia[0]) ?>

            </p>
            <p>
                <label for="title">Thể loại</label><br />
                <?php
                $args = array(
                    'show_option_none' => '',
                    'taxonomy' => 'category',
                    'hide_empty' => 0,
                    'selected' => $category
                );
                ?>
                <?php wp_dropdown_categories($args); ?>
            </p>

            <p><label for="description">Nội dung</label><br />

            <!--                <textarea id="description" tabindex="3" name="description" cols="50" rows="6"><?php echo $content; ?></textarea>-->
                <?php
                $old_description = get_post_meta($post->ID, 'description', true);
                $editor_id = 'description';
                $settings = array('media_buttons' => false);
                $content = get_the_content('description');
                wp_editor($old_description, $editor_id, $settings, $content);
                ?>

            </p>
            <p><label for="description">Upload</label><br />

                <input type="file" name="thumbnail" id="thumbnail">

            </p>
            <?php if ($thumbnail): ?>
                <img src="<?php echo $image; ?>" />
            <?php endif; ?>

            <p><input type="submit" value="Publish" tabindex="6" id="submit" name="submit" /></p>

            <input type="hidden" name="post-type" id="post-type" value="custom_posts" />

            <input type="hidden" name="action" value="custom_posts" />

            <?php wp_nonce_field('name_of_my_action', 'name_of_nonce_field'); ?>

        </form>
        <div class="clearfix"></div>
    </div>
    <?php get_sidebar('left'); ?> 
    <?php get_sidebar('right'); ?> 
<?php endif; ?>
<?php get_footer(); ?> 