<?php
/**
 * The template for displaying the footer.
 *
 * @package WordPress
 * @subpackage Starkers
 * @since Starkers HTML5 3.0
 */
?>
	<footer>
<?php
	get_sidebar( 'footer' );
?>
		<p class="footer"><a href="<?php echo home_url( '/' ) ?>" title="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>" rel="home">&copy; <?php echo date('Y')." "; ?><?php bloginfo( 'name' ); ?></a> |
		<a href="/uber-uns/" title="Impressum">Impressum & Datenschutzerklärung</a> |
		<?php if(is_user_logged_in()) : ?>
		<a href="<?php echo wp_logout_url(); ?>">Logout</a></p>
		<?php else : ?>
		<a href="<?php echo home_url( '/wp-login.php' ) ?>">Login</a></p>
		<?php endif; ?>
	</footer>

<?php
	/* Always have wp_footer() just before the closing </body>
	 * tag of your theme, or you will break many plugins, which
	 * generally use this hook to reference JavaScript files.
	 */

	wp_footer();
?>
<!-- Elevator -->
<script>

            // Simple elevator usage.
            var elementButton = document.querySelector('.elevator');
            var elevator = new Elevator({
                element: elementButton,
                mainAudio: '<?php bloginfo("template_url"); ?>/elevator/elevator-music.mp3', // Music from http://www.bensound.com/
                endAudio:  '<?php bloginfo("template_url"); ?>/elevator/ding.mp3' // Music from http://www.bensound.com/
            });

</script>
<!-- End Elevator Code -->
</body>
</html>
