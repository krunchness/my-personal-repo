<?php
/**
 * The template for displaying the footer.
 *
 * Contains the closing of the #content div and all content after
 *
 * @package fx
 */
global $fx_data;

?>      



<footer id="site-footer">      
    <div class="footer-info">
        <div class="row">
            <div class="large-3 columns">
                <?php dynamic_sidebar('first_widget') ?>
            </div>
            <div class="large-3 columns">
                <?php dynamic_sidebar('second_widget') ?>
            </div>
            <div class="large-3 columns" >
                <?php dynamic_sidebar('third_widget') ?>
            </div>
            <div class="large-3 columns">
                <?php dynamic_sidebar('fourth_widget') ?>
            </div>
        </div>
    </div>

    <div class="site-info">
        <div class="row">
            <div class="large-12 columns">
                <span id="footer-text">&copy; Copyright <?php echo date("Y"); ?> 
                    <a href="<?php echo site_url(); ?>"><?php bloginfo('name'); ?></a> | 
                    <a href="http://www.fxwebstudio.com.au/web-design-and-development/" target="_blank">Web Design</a> by <a href="http://www.fxwebstudio.com.au/" target="_blank">FX Web Studio</a> | <a href="<?= site_url() ?>/privacy-policy/">Privacy Policy</a>
                </span>
            </div>
        </div>
    </div><!-- .site-info -->
</footer><!-- #site-footer -->

<?php 

if( is_mobile()):
        // echo '<a href="tel:12345" class="sticky-phone"><i class="fa fa-phone" aria-hidden="true"></i></a>';
    ?>
<?php
endif;
?>
<?php if(is_mobile() && $fx_data['enable_backtotop']): ?>
        <button id="scrollup" class="fa fa-chevron-up"> </button>
<?php endif; ?>


<?php wp_footer(); ?>
</body>
</html>
