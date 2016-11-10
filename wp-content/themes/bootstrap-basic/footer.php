<?php
/**
 * The theme footer
 * 
 * @package bootstrap-basic
 */
?>

</div><!--.site-content-->

<nav id="menu-footer" class="navbar navbar-default" role="navigation">
    <div class="collapse navbar-collapse navbar-primary-collapse">
        <div class="row">
            <div class="col-md-12">
                <!--						<?php
                if (!dynamic_sidebar('footer-left')) {
                    printf(__('Powered by %s', 'bootstrap-basic'), 'WordPress');
                    echo ' | ';
                    printf(__('Theme: %s', 'bootstrap-basic'), '<a href="http://okvee.net">Bootstrap Basic</a>');
                }
                ?> -->
                <?php wp_nav_menu(array('theme_location' => 'secondary', 'container' => false, 'menu_class' => 'nav navbar-nav', 'walker' => new BootstrapBasicMyWalkerNavMenu())); ?> 
            </div>
        </div>
    </div>
</nav>
<footer id="site-footer" role="contentinfo">
    <div class="row">
        <div class="col-md-12">
            <table class="table table-striped">
                <tbody>
                    <tr>
                        <th>Địa chỉ:</th>
                        <th>Số điện thoại:</th>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</footer>
</div><!--.container page-container-->

<div id="goTop">
    <img src="<?php bloginfo('template_url'); ?>/img/backtop1.png" /> 
</div>

<script src="//code.jquery.com/jquery-1.11.3.min.js"></script>
<script type="text/javascript">
    $(function () {
        $(window).scroll(function () {
            if ($(this).scrollTop() > 100)
                $('#goTop').fadeIn();
            else
                $('#goTop').fadeOut();
        });
        $('#goTop').click(function () {
            $('body,html').animate({scrollTop: 0}, 'slow');
        });
    });
</script>
<script src="<?php bloginfo('template_url'); ?>/js/vendor/chosen.jquery.min.js"></script>
<script type="text/javascript">
    var config = {
        '#input_1_7': {},
        '#input_7_9': {},
    }
    for (var selector in config) {
        $(selector).chosen(config[selector]);
        $(".chosen-single > span").html("Chọn tác giả");
    }
</script>
<?php wp_footer(); ?> 
</body>
</html>