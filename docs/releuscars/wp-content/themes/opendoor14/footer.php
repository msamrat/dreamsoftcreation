<?php if (get_option('wp_showfooter') == "show") { ?>
    <div class="sixteen columns outercontainer" id="footer">
        <div class="container">
            <?php
            //Check first that child theme is used or Parent theme and then that file exist or not in child theme if exist this file in child theme then include that otherwise used parent theme file
            if (get_stylesheet_directory() != get_template_directory() &&
                    file_exists(get_stylesheet_directory() . '/includes/variables.php')) {
                include get_stylesheet_directory() . '/includes/variables.php';
            } else {

                include get_template_directory() . '/includes/variables.php';
            }
            ?>

            <div class="three columns alpha">
                <?php if (!function_exists('dynamic_sidebar') || !dynamic_sidebar('footer1')) : ?>
                <?php endif; ?>
            </div>

            <div class="three columns">
                <?php if (!function_exists('dynamic_sidebar') || !dynamic_sidebar('footer2')) : ?>
                <?php endif; ?>
            </div>

            <div class="three columns">
                <?php if (!function_exists('dynamic_sidebar') || !dynamic_sidebar('footer3')) : ?>
                <?php endif; ?>
            </div>

            <div class="three columns omega">
                <?php if (!function_exists('dynamic_sidebar') || !dynamic_sidebar('footer4')) : ?>
                <?php endif; ?>
            </div>
            <div class="four columns alpha copyright">
                <h5><p id="copyright"><?php echo stripslashes(get_option('wp_copyright')) ?></p></h5>
                <?php
                if (has_nav_menu('footer')) {
                    wp_nav_menu(array('theme_location' => 'footer', 'container' => 'div', 'sort_column' => 'menu_order', 'menu_id' => 'footermenu'));
                } else {
                    echo "Footer menu area. Create your footer menu in Appearance -> Menus";
                }
                ?>
            </div>


        </div><!-- end footer -->
    <?php } ?>

    <?php echo stripslashes(get_option('wp_ga_code')) ?>
</div>
</div><!-- end wrapper (started in header) -->
<?php wp_footer(); ?>
</body>
</html>