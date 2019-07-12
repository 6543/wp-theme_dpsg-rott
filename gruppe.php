<?php
error_reporting(E_ALL);
/*
Template Name: Pfadfindergruppe
*/
get_header(); ?>

<div class="widgets">
<?php if ( is_user_logged_in() ) : ?>
<div class="edit"><a href="<?php echo get_edit_post_link(); ?>">Bearbeiten</a></div>
<?php endif; ?>
<?php if ( have_posts() ) while ( have_posts() ) : the_post(); ?>
	<h2 id="post-<?php the_ID(); ?>">Die <?php the_title();?></h2>
	<?php the_content(); ?>
<?php endwhile; ?>
<br style="clear:both;" />
</div>

<?php $slug = the_slug(); ?>
<?php $title = wp_title("", false, ""); ?>
<?php $paged = (get_query_var('paged')) ? get_query_var('paged') : 1; ?>
<?php query_posts("category_name=".$slug."&paged=$paged"); ?>
<?php global $more;
$more = 0; ?>

<?php get_template_part( 'loop', 'index' ); ?>

<?php get_sidebar(); ?>
<?php get_footer(); ?>
