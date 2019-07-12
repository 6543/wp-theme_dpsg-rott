<?php
/**
 * The template for displaying Author Archive pages.
 *
 * @package WordPress
 * @subpackage Starkers
 * @since Starkers HTML5 3.0
 */
 
get_header(); ?>
 
<?php
if ( have_posts() ) the_post();
?>
 
<?php
// If a user has filled out their description, show a bio on their entries.
if ( get_the_author_meta( 'description' ) ) : ?>
				<?php echo '<div class="the_author">'; ?>
                <h2><?php printf( __( '&Uuml;ber den Autor', 'starkers' ), get_the_author() ); ?></h2>
                <div class="author_picture"><?php echo get_avatar( get_the_author_meta( 'user_email' ), apply_filters( 'starkers_author_bio_avatar_size', 80 ) ); ?></div>
                <div class="author_description hyphenate"><?php $the_author_description = apply_filters("the_content", get_the_author_meta('description')); ?>
				<?php echo $the_author_description; ?></div><br style="clear:both;" />
                <?php echo '</div>'; ?>
<?php endif; ?>
 
<?php
    rewind_posts();
 
    get_template_part( 'loop', 'author' );
?>
 
<?php get_sidebar(); ?>
<?php get_footer(); ?>