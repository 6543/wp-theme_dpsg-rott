<?php
/**
 * The loop that displays a single post.
 *
 * @package WordPress
 * @subpackage Starkers
 * @since Starkers HTML5 3.2
 */
?>

<?php if ( have_posts() ) while ( have_posts() ) : the_post(); ?>

		<?php //<!--<nav>--> ?>
			<?php /*previous_post_link( '%link', '' . _x( '&larr;', 'Previous post link', 'starkers' ) . ' %title' ); */ ?>
			<?php /*next_post_link( '%link', '%title ' . _x( '&rarr;', 'Next post link', 'starkers' ) . '' ); */ ?>
		<?php //<!--</nav>--> ?>
		<div class="social">
		<div id="twitter"></div>
		<div id="facebook"></div>
		<div id="googleplus"></div>
		</div>
		<article id="post-<?php the_ID(); ?>" <?php post_class('hyphenate'); ?>>
			
			<header><span class="article-meta">

				<?php starkers_posted_on_new(); ?>
                <?php edit_post_link( __( 'Bearbeiten', 'starkers' ), '| ', '' ); ?></span>
                <h2><?php the_title(); ?></h2>
			</header>
			<div class="content">
			<?php if ( has_post_thumbnail() ) { // check if the post has a Post Thumbnail assigned to it.
				$thumb = wp_get_attachment_image_src( get_post_thumbnail_id($post->ID), 'in-article' );
				$two = wp_get_attachment_image_src( get_post_thumbnail_id($post->ID), 'front' );
  				echo '<p style="text-align:center;"><a href="'.$thumb[0].'"><img title="'.get_the_title().'" src="'.$two[0].'"></img></a></p>'; } ?>
			<?php the_content(); ?>
			</div>
			<footer>
				
			</footer>
				
		</article>

		<?php //<!--<nav>--> ?>
			<?php /*previous_post_link( '%link', '' . _x( '&larr;', 'Previous post link', 'starkers' ) . ' %title' ); */ ?>
			<?php /*next_post_link( '%link', '%title ' . _x( '&rarr;', 'Next post link', 'starkers' ) . '' ); */ ?>
		<?php //<!--</nav>--> ?>

		<?php /* comments_template( '', true ); */ ?>

<?php endwhile; // end of the loop. ?>