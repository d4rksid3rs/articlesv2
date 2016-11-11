<?php
/*
  Plugin Name: Admin New Post
  Plugin URI: http://teachingyou.net
  Description: This plugin is based on a tutorial from teachingyou.net.
  Version: 1.0
  Author: Morne Zeelie
  Author URI: http://teachingyou.net
  License: GPL2
 */

// register post type for custom posts
function generate_post_select($select_id, $post_type, $selected = 0) {
    $post_type_object = get_post_type_object($post_type);
    $label = $post_type_object->label;
    $posts = get_posts(array('post_type' => $post_type, 'post_status' => 'publish', 'suppress_filters' => false, 'posts_per_page' => -1));
    echo '<select name="' . $select_id . '" id="' . $select_id . '">';
//    echo '<option value = "" >All ' . $label . ' </option>';
    foreach ($posts as $post) {
        echo '<option value="', $post->ID, '"', $selected == $post->ID ? ' selected="selected"' : '', '>', $post->post_title, '</option>';
    }
    echo '</select>';
}

function admin_post_frontend() {
    ?>
    <form id="custom-post-type" name="custom-post-type" method="post" action="" enctype="multipart/form-data">

        <p><label for="title">Tên bài</label><br />

            <input type="text" id="title" value="" tabindex="1" size="20" name="title" />

        </p> 

        <p><label for="title">Tác giả</label><br />
            <?php generate_post_select('tac-gia', 'article-author', 0) ?>

        </p>
        <p>
            <label for="title">Thể loại</label><br />
            <?php wp_dropdown_categories('show_option_none=&tab_index=4&taxonomy=category&hide_empty=0'); ?>
        </p>

        <p><label for="description">Nội dung</label><br />

    <!--            <textarea id="description" tabindex="3" name="description" cols="50" rows="6"></textarea>-->
            <?php
            $old_description = get_post_meta($post->ID, 'description', true);
            $editor_id = 'description';
            $settings = array('media_buttons' => false);

            wp_editor($old_description, $editor_id, $settings);
            ?>

        </p>
        <p><label for="description">Upload</label><br />

            <input type="file" name="thumbnail" id="thumbnail">

        </p>


        <p><input type="submit" value="Publish" tabindex="6" id="submit" name="submit" /></p>

        <input type="hidden" name="post-type" id="post-type" value="custom_posts" />

        <input type="hidden" name="action" value="custom_posts" />

        <?php wp_nonce_field('name_of_my_action', 'name_of_nonce_field'); ?>

    </form>
    <?php
    if ($_POST) {
        save_post_data();
    }
}

add_shortcode('admin-post', 'admin_post_frontend');

function save_post_data() {
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
        $new_post_id = wp_insert_post($post);  // http://codex.wordpress.org/Function_Reference/wp_insert_post
        if (!function_exists('wp_generate_attachment_metadata')) {
            require_once(ABSPATH . "wp-admin" . '/includes/image.php');
            require_once(ABSPATH . "wp-admin" . '/includes/file.php');
            require_once(ABSPATH . "wp-admin" . '/includes/media.php');
        }
//        var_dump($_FILES);die;
        if ($_FILES) {
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
        add_post_meta($new_post_id, "tac_gia", $tacgia); // Add Custom field
        $location = get_permalink(45); // redirect location, should be login page         
        echo "<meta http-equiv='refresh' content='0;url=$location' />";
        exit;
    } // end IF
}
?>