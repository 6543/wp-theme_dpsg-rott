<?php
/**
 * The template for displaying Search Results pages.
 *
 * @package WordPress
 * @subpackage Starkers
 * @since Starkers HTML5 3.0
 */

get_header(); ?>
<div class="search">
<?php if ( have_posts() ) : ?>
		<h2><?php printf( __( 'Suchergebnisse für: %s', 'starkers' ), '' . get_search_query() . '' ); ?></h2><footer></footer></div>
			<?php
				get_template_part( 'loop', 'search' );
			?>
<?php else : ?>
		<h2><?php _e( 'Nichts gefunden', 'starkers' ); ?></h2>
			<p><?php _e( 'Entschuldige bitte, aber das was du gesucht hast, konnte nicht gefunden werden. Nutze doch die Suchfunktion oder ein paar der weiter unten angebotenen Möglichkeiten, um das Gewünschte zu finden.', 'twentyeleven' ); ?></p>
			<?php get_search_form(); ?>
			</div>
<?php endif; ?>

<?php get_sidebar(); ?>
<?php get_footer(); ?>