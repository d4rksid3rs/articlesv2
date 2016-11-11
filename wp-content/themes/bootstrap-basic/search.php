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
<?php // get_sidebar('left');    ?> 
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

        <div class="row">
            <div class="category section recent">
                <h3 class="uppercase">Kết quả tìm kiếm</h3>
                <?php if (have_posts()) : while (have_posts()) : the_post() ?>
                        <div class="col-md-3">
                            <a class="title" href="<?php the_permalink() ?>"> <h4 class="uppercase"><?php the_title() ?></h4></a>
                            <span class="author"><b> <a href="<?php the_permalink(get_post_meta($post->ID, 'tac_gia', true)) ?>"><?php $tac_gia_id = get_post_meta($post->ID, 'tac_gia', true); ?>
                                        <?php
                                        $nguoi_viet_id = get_post_meta($post->ID, 'nguoi_viet', true);
                                        if ($tac_gia_id):
                                            echo get_the_title($tac_gia_id);
                                        elseif ($nguoi_viet_id) :
                                            echo $nguoi_viet_id;
                                        else:
                                            echo 'Không có tác giả';
                                            ?>
                                        <?php endif; ?>                                       
                                    </a></b></span>
                            <p><small><i>Bài viết được đăng bởi:</i><b>
                                        <?php
                                        $a_id = $post->post_author;
                                        $a_name = get_the_author_meta('display_name', $a_id);
                                        echo $a_name;
                                        ?></b></small></p>
                            <div class="pt-cv-content">
                                <?php if (has_post_thumbnail()) : ?>
                                    <a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>">
                                        <img src="<?php the_post_thumbnail_url(); ?>"/>
                                    </a>
                                <?php endif; ?>
                                <br />
                                <?php
                                $i ++;
                                $excerpt = get_the_excerpt();
                                echo string_limit_words($excerpt, 20);
                                ?>
                                <a class="btn btn-success" href="<?php the_permalink() ?>"><span class="glyphicon glyphicon-arrow-right"></span></a>
                            </div>
                        </div>
                        <?php if ($i % 4 == 0) : ?>
                            <div class="clearfix"></div>
                        <?php endif; ?>
                    <?php endwhile; ?> 
                <?php endif; ?>
            </div>
        </div>    
    </main>
</div>
<?php get_sidebar('right'); ?> 
<?php get_footer(); ?> 