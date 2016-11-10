<?php
/*
  Template Name: Page Author
 */

get_header();

/**
 * determine main column size from actived sidebar
 */
global $wp_query;
$main_column_size = 9;
?>  
<div class="col-md-<?php echo $main_column_size; ?> content-area" id="main-column">
    <main id="main" class="site-main" role="main">
        <div class="alpha">
        <?php
//get all post IDs for posts beginning with cap B, in title order,
//display posts
//        $first_char = 'P';
        $this_letter = 'All';
        $letter_link = add_query_arg('first-letter', $this_letter, $this_page);
        $character = $_GET['first-letter'];
        if (!$character) $character = 'All' ;
        ?>
            [<a class="letter <?php if($character == "All" ) echo 'active'; ?>" href="<?php echo $letter_link; ?>" title="<?php echo "letter-$this_letter"; ?>"> <?php echo $this_letter; ?> </a>]
        <?php
        // Make the menu
        for ($i = 0; $i < 26; ++$i) {
            $this_letter = chr(ord('A') + $i);
            $letter_link = add_query_arg('first-letter', $this_letter, $this_page);
            ?>
            [<a class="letter <?php if($character == "$this_letter" ) echo 'active'; ?>" href="<?php echo $letter_link; ?>" title="<?php echo "letter-$this_letter"; ?>"> <?php echo $this_letter; ?> </a>]
        <?php } ?>
        </div>   
        <?php
        if ($character == 'All') {            
            $postids = $wpdb->get_col("SELECT ID FROM $wpdb->posts ORDER BY $wpdb->posts.post_title");
        } else {
            $first_char = ($_GET['first-letter']) ? $_GET['first-letter'] : 'A';
            $postids = $wpdb->get_col($wpdb->prepare("SELECT ID FROM $wpdb->posts WHERE SUBSTR($wpdb->posts.post_title,1,1) = %s ORDER BY $wpdb->posts.post_title", $first_char));
        }
//        var_dump($postids);die;
        if ($postids) {
            $args = array(
                'post__in' => $postids,
                'post_type' => 'article-author',
                'post_status' => 'publish',
                'posts_per_page' => -1,
                'caller_get_posts' => 1
            );
            $my_query = null;
            $my_query = new WP_Query($args);
            if ($my_query->have_posts()) {
                ?>
                <table class="table table-striped">
                    <thead>
                    <td>STT</td>
                    <td>Tác giả</td>
                    <td>Địa chỉ</td>
                    <td>Số tác phẩm</td>                    
                    </thead>
                    <tbody>
                        <?php $i = 1; ?>
                        <?php while ($my_query->have_posts()) : $my_query->the_post(); ?>
                            <tr>
                                <?php
                                $author_id = get_the_ID();
//                                var_dump($author_id);die;
                                ?>
                                <td><?php echo $i; ?></td>
                                <td><p><a href="<?php the_permalink() ?>" 
                                          rel="bookmark" title="Permanent Link to 
                                          <?php the_title_attribute(); ?>"><?php the_title(); ?></a></p>
                                </td>  
                                <td><?php
                                    $dia_chi = get_post_meta($author_id, 'dia_chi', true);
//                                    var_dump($dia_chi);
                                    if ($dia_chi) { // kiểm tra xem nó có dữ liệu hay không
                                        echo '' . $dia_chi . '</br>';
                                    }
                                    ?>
                                </td>
                                <?php wp_reset_postdata(); ?>
                                <?php wp_reset_query(); ?>
                                <td>
                                    <?php
                                    $arg2 = array(
                                        'numberposts' => -1,
                                        'post_type' => 'pasticco',
                                        'meta_key' => 'tac_gia',
                                        'meta_value' => $author_id
                                    );
                                    $post_number = new WP_Query($arg2);
                                    ?>

                                    <?php if ($post_number->have_posts()) : ?>
                                        <?php echo $post_number->post_count; ?>
                                    <?php endif; ?>		                                    
                                    <?php wp_reset_postdata(); ?>
                                </td>
                            </tr>

                            <?php $i++; ?>
                        <?php endwhile; ?>
                    </tbody>
                    <?php
                }
                wp_reset_postdata();  // Restore global post data stomped by the_post().
            }
            ?>
        </table>
    </main>
</div>
<?php get_sidebar('right'); ?> 
<?php get_footer(); ?> 