<?php
/**
 * The template for displaying 404 pages.
 *
 * @package WordPress
 * @subpackage Starkers
 * @since Starkers HTML5 3.0
 */

get_header(); ?>

	<div class="search"><h1><?php _e( 'Nichts gefunden', 'starkers' ); ?></h1>
		<p><?php _e( 'Entschuldige bitte, aber diese Seite konnte nicht gefunden werden. Vielleicht hilft die Suchfunktion ein Ergebnis zu finden.', 'starkers' ); ?></p>
		<?php get_search_form(); ?>
	</div>
	<script type="text/javascript">
		// focus on search field after it has loaded
		document.getElementById('s') && document.getElementById('s').focus();
	</script>

<?php get_footer(); ?>