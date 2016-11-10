<?php
/**
 * The theme header
 * 
 * @package bootstrap-basic
 */
?>
<!DOCTYPE html>
<!--[if lt IE 7]>  <html class="no-js lt-ie9 lt-ie8 lt-ie7" <?php language_attributes(); ?>> <![endif]-->
<!--[if IE 7]>     <html class="no-js lt-ie9 lt-ie8" <?php language_attributes(); ?>> <![endif]-->
<!--[if IE 8]>     <html class="no-js lt-ie9" <?php language_attributes(); ?>> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js" <?php language_attributes(); ?>> <!--<![endif]-->
    <head>
        <meta charset="<?php bloginfo('charset'); ?>">
        <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
        <title><?php wp_title('|', true, 'right'); ?></title>
        <meta name="viewport" content="width=device-width">

        <link rel="profile" href="http://gmpg.org/xfn/11">
        <link rel="pingback" href="<?php bloginfo('pingback_url'); ?>">

        <!--wordpress head-->
        <?php wp_head(); ?>
    </head>
    <body onload="time()" <?php body_class(); ?>>
        <!--[if lt IE 8]>
                <p class="chromeframe">You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your browser</a> or <a href="http://www.google.com/chromeframe/?redirect=true">activate Google Chrome Frame</a> to improve your experience.</p>
        <![endif]-->





        <div class="container page-container">
            <?php do_action('before'); ?> 
            <header role="banner">
                <!--                <div class="row row-with-vspace site-branding">
                                    <div class="col-md-6 site-title">
                                        <h1 class="site-title-heading">
                                            <a href="<?php echo esc_url(home_url('/')); ?>" title="<?php echo esc_attr(get_bloginfo('name', 'display')); ?>" rel="home"><?php bloginfo('name'); ?></a>
                                        </h1>
                                                                                        <div class="site-description">
                                                                                                <small>
                <?php bloginfo('description'); ?> 
                                                                                                </small>
                                                                                        </div>
                                    </div>
                                    <div class="col-md-6 page-header-top-right">
                                        <div class="sr-only">
                                            <a href="#content" title="<?php esc_attr_e('Skip to content', 'bootstrap-basic'); ?>"><?php _e('Skip to content', 'bootstrap-basic'); ?></a>
                                        </div>
                <?php if (is_active_sidebar('header-right')) { ?> 
                                                                                        <div class="pull-right">
                    <?php dynamic_sidebar('header-right'); ?> 
                                                                                        </div>
                                                                                        <div class="clearfix"></div>
                <?php } // endif; ?> 
                                    </div>
                                </div>-->

                <div class="row main-navigation">
                    <div class="col-md-12">
                        <nav class="navbar navbar-default" role="navigation">
                            <div class="navbar-header">
                                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-primary-collapse">
                                    <span class="sr-only"><?php _e('Toggle navigation', 'bootstrap-basic'); ?></span>
                                    <span class="icon-bar"></span>
                                    <span class="icon-bar"></span>
                                    <span class="icon-bar"></span>
                                </button>
                            </div>

                            <div class="collapse navbar-collapse navbar-primary-collapse">
                                <?php wp_nav_menu(array('theme_location' => 'primary', 'container' => false, 'menu_class' => 'nav navbar-nav', 'walker' => new BootstrapBasicMyWalkerNavMenu())); ?> 
                                <!--                                <?php dynamic_sidebar('navbar-right'); ?> -->
                            </div><!--.navbar-collapse-->
                        </nav>
                    </div>
                </div><!--.main-navigation-->
                <div class="date pull-left">
<!--                    <p><strong><i><?php
//                    echo returnDate(date("N"), "day") . ", ngày " . date("j") . " tháng " . returnDate(date("n"), "month") . " năm " . date("Y");
//
//                    function returnDate($num, $tipe) {
//                        $str;
//                        switch ($tipe) {
//                            case "month":
//                                $month_name = array("", "01", "02", "03", "04", "05", "06", "07", "08", "09", "10", "11", "12");
//                                $str = $month_name[floor($num)];
//                                break;
//                            case "day":
//                                $day_name = array("", "Thứ 2", "Thứ 3", "Thứ 4", "Thứ 5", "Thứ 6", "Thứ 7", "Chủ Nhật");
//                                $str = $day_name[floor($num)];
//                                break;
//                        }
//                        return $str;
//                    }
                    ?></i></strong></p>-->
                    <p><strong><i id="clock"></i></strong></p>
                </div>
                <div class="row search pull-right" rol="search">

                    <form class="navbar-form" role="search" action="<php echo site_url('/'); ?>" method="get">
                        <div class="form-group pull-left">
                            <input type="text" name="s" class="form-control" placeholder="Tìm kiếm ..."/>
                        </div>

                        <button type="submit" class="btn btn-warning pull-right">Tìm kiếm</button>

                    </form>

                </div>

            </header>

            <div class="clearfix"></div>
            <div id="content" class="row row-with-vspace site-content">