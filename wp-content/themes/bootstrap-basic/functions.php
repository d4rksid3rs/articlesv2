<?php

/**
 * Bootstrap Basic theme
 * 
 * @package bootstrap-basic
 */
/**
 * Required WordPress variable.
 */
if (!isset($content_width)) {
    $content_width = 1170;
}


if (!function_exists('bootstrapBasicSetup')) {

    /**
     * Setup theme and register support wp features.
     */
    function bootstrapBasicSetup() {
        /**
         * Make theme available for translation
         * Translations can be filed in the /languages/ directory
         * 
         * copy from underscores theme
         */
        load_theme_textdomain('bootstrap-basic', get_template_directory() . '/languages');

        // add theme support title-tag
        add_theme_support('title-tag');

        // add theme support post and comment automatic feed links
        add_theme_support('automatic-feed-links');

        // enable support for post thumbnail or feature image on posts and pages
        add_theme_support('post-thumbnails');

        // allow the use of html5 markup
        // @link https://codex.wordpress.org/Theme_Markup
        add_theme_support('html5', array('caption', 'comment-form', 'comment-list', 'gallery', 'search-form'));

        // add support menu
        register_nav_menus(array(
            'primary' => __('Primary Menu', 'bootstrap-basic'),
        ));
        register_nav_menus(array(
            'secondary' => __('Secondary Menu', 'bootstrap-basic'),
        ));
        // add post formats support
        add_theme_support('post-formats', array('aside', 'image', 'video', 'quote', 'link'));

        // add support custom background
        add_theme_support(
                'custom-background', apply_filters(
                        'bootstrap_basic_custom_background_args', array(
            'default-color' => 'ffffff',
            'default-image' => ''
                        )
                )
        );
    }

// bootstrapBasicSetup
}
add_action('after_setup_theme', 'bootstrapBasicSetup');


if (!function_exists('bootstrapBasicWidgetsInit')) {

    /**
     * Register widget areas
     */
    function bootstrapBasicWidgetsInit() {
        register_sidebar(array(
            'name' => __('Sidebar right', 'bootstrap-basic'),
            'id' => 'sidebar-right',
            'before_widget' => '<aside id="%1$s" class="widget %2$s">',
            'after_widget' => '</aside>',
            'before_title' => '<h1 class="widget-title">',
            'after_title' => '</h1>',
        ));

        register_sidebar(array(
            'name' => __('Sidebar left', 'bootstrap-basic'),
            'id' => 'sidebar-left',
            'before_widget' => '<aside id="%1$s" class="widget %2$s">',
            'after_widget' => '</aside>',
            'before_title' => '<h1 class="widget-title">',
            'after_title' => '</h1>',
        ));

        register_sidebar(array(
            'name' => __('Header right', 'bootstrap-basic'),
            'id' => 'header-right',
            'description' => __('Header widget area on the right side next to site title.', 'bootstrap-basic'),
            'before_widget' => '<div id="%1$s" class="widget %2$s">',
            'after_widget' => '</div>',
            'before_title' => '<h1 class="widget-title">',
            'after_title' => '</h1>',
        ));

        register_sidebar(array(
            'name' => __('Navigation bar right', 'bootstrap-basic'),
            'id' => 'navbar-right',
            'before_widget' => '',
            'after_widget' => '',
            'before_title' => '',
            'after_title' => '',
        ));

        register_sidebar(array(
            'name' => __('Footer left', 'bootstrap-basic'),
            'id' => 'footer-left',
            'before_widget' => '<div id="%1$s" class="widget %2$s">',
            'after_widget' => '</div>',
            'before_title' => '<h1 class="widget-title">',
            'after_title' => '</h1>',
        ));

        register_sidebar(array(
            'name' => __('Footer right', 'bootstrap-basic'),
            'id' => 'footer-right',
            'before_widget' => '<div id="%1$s" class="widget %2$s">',
            'after_widget' => '</div>',
            'before_title' => '<h1 class="widget-title">',
            'after_title' => '</h1>',
        ));
    }

// bootstrapBasicWidgetsInit
}
add_action('widgets_init', 'bootstrapBasicWidgetsInit');

function pasticco() {

    /*
     * Biến $label để chứa các text liên quan đến tên hiển thị của Post Type trong Admin
     */
    $label = array(
        'name' => 'Tác phẩm', //Tên post type dạng số nhiều
        'singular_name' => 'Danh sách Tác phẩm', //Tên post type dạng số ít
        'add_new' => 'Thêm mới',
        'add_new_item' => 'Thêm mới tác phẩm',
        'edit_item' => 'Sửa thông tin tác phẩm',
        'all_item' => 'Chuyên mục',
        'name_admin_bar' => 'Danh sách Tác phẩm',
    );

    /*
     * Biến $args là những tham số quan trọng trong Post Type
     */
    $args = array(
        'labels' => $label, //Gọi các label trong biến $label ở trên
        'description' => 'Tác Phẩm', //Mô tả của post type
        'supports' => array(
            'title',
            'editor',
            'excerpt',
            'author',
            'thumbnail',
            'comments',
            'trackbacks',
            'revisions',
            'custom-fields'
        ), //Các tính năng được hỗ trợ trong post type
        'taxonomies' => array('category', 'post_tag'), //Các taxonomy được phép sử dụng để phân loại nội dung
        'hierarchical' => false, //Cho phép phân cấp, nếu là false thì post type này giống như Post, true thì giống như Page
        'public' => true, //Kích hoạt post type
        'show_ui' => true, //Hiển thị khung quản trị như Post/Page
        'show_in_menu' => true, //Hiển thị trên Admin Menu (tay trái)
        'show_in_nav_menus' => true, //Hiển thị trong Appearance -> Menus
        'show_in_admin_bar' => true, //Hiển thị trên thanh Admin bar màu đen.
        'menu_position' => 4, //Thứ tự vị trí hiển thị trong menu (tay trái)
        'menu_icon' => 'dashicons-admin-post', //Đường dẫn tới icon sẽ hiển thị
        'can_export' => true, //Có thể export nội dung bằng Tools -> Export
        'has_archive' => true, //Cho phép lưu trữ (month, date, year)
        'exclude_from_search' => false, //Loại bỏ khỏi kết quả tìm kiếm
        'publicly_queryable' => true, //Hiển thị các tham số trong query, phải đặt true
        'capability_type' => 'post', //
        'query_var' => true,
        'rewite' => array('slug' => 'pasticco')
    );

    register_post_type('pasticco', $args); //Tạo post type với slug tên là sanpham và các tham số trong biến $args ở trên
    global $wp_rewrite;
    $wp_rewrite->flush_rules();
}

/* Kích hoạt hàm tạo custom post type */
add_action('init', 'pasticco');

function tacgia() {

    /*
     * Biến $label để chứa các text liên quan đến tên hiển thị của Post Type trong Admin
     */
    $label = array(
        'name' => 'Tác Giả', //Tên post type dạng số nhiều
        'singular_name' => 'Tác giả', //Tên post type dạng số ít
        'add_new' => 'Thêm mới',
        'add_new_item' => 'Thêm mới tác giả',
        'edit_item' => 'Sửa thông tin tác giả',
        'all_item' => 'Chuyên mục',
        'name_admin_bar' => 'Danh sách Tác giả',
    );

    /*
     * Biến $args là những tham số quan trọng trong Post Type
     */
    $args = array(
        'labels' => $label, //Gọi các label trong biến $label ở trên
        'description' => 'Tác Giả', //Mô tả của post type
        'supports' => array(
            'title',
            'editor',
            'excerpt',
            'author',
            'thumbnail',
            'comments',
            'trackbacks',
            'revisions',
            'custom-fields'
        ), //Các tính năng được hỗ trợ trong post type
        'taxonomies' => array('category', 'post_tag'), //Các taxonomy được phép sử dụng để phân loại nội dung
        'hierarchical' => false, //Cho phép phân cấp, nếu là false thì post type này giống như Post, true thì giống như Page
        'public' => true, //Kích hoạt post type
        'show_ui' => true, //Hiển thị khung quản trị như Post/Page
        'show_in_menu' => true, //Hiển thị trên Admin Menu (tay trái)
        'show_in_nav_menus' => true, //Hiển thị trong Appearance -> Menus
        'show_in_admin_bar' => true, //Hiển thị trên thanh Admin bar màu đen.
        'menu_position' => 5, //Thứ tự vị trí hiển thị trong menu (tay trái)
        'menu_icon' => 'dashicons-admin-post', //Đường dẫn tới icon sẽ hiển thị
        'can_export' => true, //Có thể export nội dung bằng Tools -> Export
        'has_archive' => true, //Cho phép lưu trữ (month, date, year)
        'exclude_from_search' => false, //Loại bỏ khỏi kết quả tìm kiếm
        'publicly_queryable' => true, //Hiển thị các tham số trong query, phải đặt true
        'capability_type' => 'post', //
        'query_var' => true,
        'rewite' => array('slug' => 'article-author')
    );

    register_post_type('article-author', $args); //Tạo post type với slug tên là sanpham và các tham số trong biến $args ở trên
    global $wp_rewrite;
    $wp_rewrite->flush_rules();
}

function string_limit_words($string, $word_limit) {
    $words = explode(' ', $string, ($word_limit + 1));
    if (count($words) > $word_limit)
        array_pop($words);
    return implode(' ', $words);
}

/* Kích hoạt hàm tạo custom post type */
add_action('init', 'tacgia');

if (!function_exists('bootstrapBasicEnqueueScripts')) {

    /**
     * Enqueue scripts & styles
     */
    function bootstrapBasicEnqueueScripts() {
        wp_enqueue_style('bootstrap-style', get_template_directory_uri() . '/css/bootstrap.min.css', array(), '3.3.6');
        wp_enqueue_style('bootstrap-theme-style', get_template_directory_uri() . '/css/bootstrap-theme.min.css', array(), '3.3.6');
        wp_enqueue_style('fontawesome-style', get_template_directory_uri() . '/css/font-awesome.min.css', array(), '4.5.0');
        wp_enqueue_style('chosen-style', get_template_directory_uri() . '/css/chosen.min.css', array(), '1.5.1');
        wp_enqueue_style('main-style', get_template_directory_uri() . '/css/main.css');

        wp_enqueue_script('modernizr-script', get_template_directory_uri() . '/js/vendor/modernizr.min.js', array(), '3.3.1');
        wp_enqueue_script('respond-script', get_template_directory_uri() . '/js/vendor/respond.min.js', array(), '1.4.2');
        wp_enqueue_script('html5-shiv-script', get_template_directory_uri() . '/js/vendor/html5shiv.min.js', array(), '3.7.3');
        wp_enqueue_script('jquery');
        wp_enqueue_script('bootstrap-script', get_template_directory_uri() . '/js/vendor/bootstrap.min.js', array(), '3.3.6', true);
        wp_enqueue_script('chosen-script', get_template_directory_uri() . '/js/vendor/chosen.jquery.min.js', array(), '1.5.1', true);
        wp_enqueue_script('main-script', get_template_directory_uri() . '/js/main.js', array(), false, true);
        wp_enqueue_style('bootstrap-basic-style', get_stylesheet_uri());
    }

// bootstrapBasicEnqueueScripts
}
add_action('wp_enqueue_scripts', 'bootstrapBasicEnqueueScripts');


/**
 * admin page displaying help.
 */
if (is_admin()) {
    require get_template_directory() . '/inc/BootstrapBasicAdminHelp.php';
    $bbsc_adminhelp = new BootstrapBasicAdminHelp();
    add_action('admin_menu', array($bbsc_adminhelp, 'themeHelpMenu'));
    unset($bbsc_adminhelp);
}


/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/inc/template-tags.php';


/**
 * Custom functions that act independently of the theme templates.
 */
require get_template_directory() . '/inc/extras.php';


/**
 * Custom dropdown menu and navbar in walker class
 */
require get_template_directory() . '/inc/BootstrapBasicMyWalkerNavMenu.php';


/**
 * Template functions
 */
require get_template_directory() . '/inc/template-functions.php';


/**
 * --------------------------------------------------------------
 * Theme widget & widget hooks
 * --------------------------------------------------------------
 */
require get_template_directory() . '/inc/widgets/BootstrapBasicSearchWidget.php';
require get_template_directory() . '/inc/template-widgets-hook.php';

// publish button
function show_publish_button() {
    Global $post;
//only print fi admin
    if (current_user_can('manage_options')) {
        echo '

<form action="" method="POST" name="front_end_publish"><input id="pid" type="hidden" name="pid" value="' . $post->ID . '" />
<input id="FE_PUBLISH" type="hidden" name="FE_PUBLISH" value="FE_PUBLISH" />
<input class="btn btn-success" id="submit" type="submit" name="submit" value="Phê duyệt" /></form>';
    }
}
