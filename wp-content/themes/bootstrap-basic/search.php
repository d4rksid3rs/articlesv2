<?php
/**
 * The template for displaying search results.
 * 
 * @package bootstrap-basic
 */
get_header();

/**
 * determine main column size from actived sidebar
 */
$main_column_size = bootstrapBasicGetMainColumnSize();
?> 
<div class="pull-right">
    <?php
    echo returnDate(date("N"), "day") . ", ngày " . date("j") . " tháng" . returnDate(date("n"), "month") . " năm" . date("Y");

    function returnDate($num, $tipe) {
        $str;
        switch ($tipe) {
            case "month":
                $month_name = array("", "01", "02", "03", "04", "05", "06", "07", "08", "09", "10", "11", "12");
                $str = $month_name[floor($num)];
                break;
            case "day":
                $day_name = array("", "Thứ 2", "Thứ 3", "Thứ 4", "Thứ 5", "Thứ 6", "Thứ 7", "Chủ Nhật");
                $str = $day_name[floor($num)];
                break;
        }
        return $str;
    }
    ?>
</div>
<?php // get_sidebar('left'); ?> 
<div class="col-md-<?php echo $main_column_size; ?> content-area" id="main-column">
    <main id="main" class="site-main" role="main">
        <?php
        $search_value = $_GET['s'];
        $args = array(
            'post_type' => 'pasticco',
            'post_status' => 'pending',
            'meta_query' => array(
                array(
                    'key' => 'nguoi_viet',
                    'value' => $search_value,
                    'compare' => 'LIKE'
                ))
        );        
        $custom_query = new WP_Query($args);       
        ?>
        <?php if ($custom_query->have_posts()) : ?>
            <table class="table table-striped">
                <thead>
                <td><b>STT</b></td>
                <td><b>Tác phẩm</b></td>
                <td><b>Tác giả</b></td>
                <td><b>Phê duyệt</b></td>
                </thead>
                <tbody>
                    <?php while ($custom_query->have_posts()) : $custom_query->the_post(); ?>
                <h3>Kết quả tìm kiếm</h3>
                        <?php $a = 1 ?>
                        <tr>
                            <td><?php echo $a; ?></td>
                            <td><p><a class="title" href="<?php the_permalink() ?>" ><h4 class="uppercase"><?php the_title() ?></h4></a></p></td>
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
            </tbody>
        </table>
    </main>
</div>
<?php get_sidebar('right'); ?> 
<?php get_footer(); ?> 