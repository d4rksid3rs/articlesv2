<?php
/*
  Template Name: Recent Post Pending
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
        <h3>Tìm kiếm tác giả</h3>
        <form role="search" method="get" class="search-form" action="<?php echo home_url('/'); ?>">
            <label>
                <span class="screen-reader-text"><?php echo _x('Search for:', 'label') ?></span>
                <input type="search" class="search-field" placeholder="<?php echo esc_attr_x('Search …', 'placeholder') ?>" value="<?php echo get_search_query() ?>" name="s" title="<?php echo esc_attr_x('Search for:', 'label') ?>" />
                <!--<input type="hidden" name="post_type" value="pasticco" />-->
            </label>
            <input type="submit" class="search-submit" value="<?php echo esc_attr_x('Search', 'submit button') ?>" />
        </form>
        <h2>Danh sách tác phẩm cần duyệt</h2>
        <?php
        $paged = ( get_query_var('paged') ) ? get_query_var('paged') : 1;

        $args = array(
            'posts_per_page' => 8,
            'paged' => $paged,
            'post_type' => 'pasticco',
            'post_status' => 'pending',
        );
        $i = 0;
        $custom_query = new WP_Query($args);
        ?>
        <table class="table table-striped">
            <thead>
            <td><b>STT</b></td>
            <td><b>Tác phẩm</b></td>
            <td><b>Tác giả</b></td>
            <td><b>Phê duyệt</b></td>
            </thead>
            <tbody>
                <?php $a = 1 ?>
            <div class="row">
                <?php if ($custom_query->have_posts()) : ?>
                    <?php while ($custom_query->have_posts()) : $custom_query->the_post(); ?>
                        <tr>
                            <td><?php echo $a; ?></td>
                            <td><p><a class="title" href="<?php the_permalink() ?>" >
                                        <h4 class="uppercase"><?php the_title() ?></h4>                                    

                                        <?php if (has_post_thumbnail()) : ?>
                                            <img src="<?php the_post_thumbnail_url(); ?>"/>
                                        <?php endif; ?>
                                    </a></p></td>
                            <td><p><b><?php
                                        $nguoi_viet_id = get_post_meta($post->ID, 'nguoi_viet', true);
                                        echo $nguoi_viet_id;
                                        ?>
                                    </b></p></td>
                            <td><p><?php show_publish_button(); ?></p></td>
                        </tr>

                        <?php if ($i % 4 == 0) : ?>
                            <div class="clearfix"></div>
                            <?php $a++; ?>
                        <?php endif; ?>
                    <?php endwhile; ?> 
                <?php endif; ?>     
            </div>
            </tbody>
        </table>

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
        <h3>Tìm kiếm tác giả</h3>
        <form role="search" method="get" class="search-form" action="<?php echo home_url('/'); ?>">
            <label>
                <span class="screen-reader-text"><?php echo _x('Search for:', 'label') ?></span>
                <input type="search" class="search-field" placeholder="<?php echo esc_attr_x('Search …', 'placeholder') ?>" value="<?php echo get_search_query() ?>" name="s" title="<?php echo esc_attr_x('Search for:', 'label') ?>" />
                <!--<input type="hidden" name="post_type" value="pasticco" />-->
            </label>
            <input type="submit" class="search-submit" value="<?php echo esc_attr_x('Search', 'submit button') ?>" />
        </form>
        <h2>Danh sách tác phẩm cần duyệt</h2>
        <?php
        $paged = ( get_query_var('paged') ) ? get_query_var('paged') : 1;

        $args = array(
            'posts_per_page' => 8,
            'paged' => $paged,
            'post_type' => 'pasticco',
            'post_status' => 'pending',
        );
        $i = 0;
        $custom_query = new WP_Query($args);
        ?>
        <table class="table table-striped">
            <thead>
            <td><b>STT</b></td>
            <td><b>Tác phẩm</b></td>
            <td><b>Tác giả</b></td>
            <td><b>Phê duyệt</b></td>
            </thead>
            <tbody>
                <?php $a = 1 ?>
            <div class="row">
                <?php if ($custom_query->have_posts()) : ?>
                    <?php while ($custom_query->have_posts()) : $custom_query->the_post(); ?>
                        <tr>
                            <td><?php echo $a; ?></td>
                            <td><p><a class="title" href="<?php the_permalink() ?>" >
                                        <h4 class="uppercase"><?php the_title() ?></h4>                                    

                                        <?php if (has_post_thumbnail()) : ?>
                                            <img src="<?php the_post_thumbnail_url(); ?>"/>
                                        <?php endif; ?>
                                    </a></p></td>
                            <td><p><b><?php
                                        $nguoi_viet_id = get_post_meta($post->ID, 'nguoi_viet', true);
                                        echo $nguoi_viet_id;
                                        ?>
                                    </b></p></td>
                            <td><p><?php show_publish_button(); ?></p></td>
                        </tr>

                        <?php if ($i % 4 == 0) : ?>
                            <div class="clearfix"></div>
                            <?php $a++; ?>
                        <?php endif; ?>
                    <?php endwhile; ?> 
                <?php endif; ?>     
            </div>
            </tbody>
        </table>

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