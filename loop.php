<?php
/**
 * The loop that displays posts.
 *
 * @package WordPress
 * @subpackage Starkers
 * @since Starkers HTML5 3.0
 */
?>

<div class="right">
<?php /* If there are no posts to display, such as an empty archive page */ ?>
<?php if ( ! have_posts() ) : ?>
        <div class="search"><h1> <?php _e( 'Nichts gefunden', 'starkers' ); ?></h1>
            <p><?php _e( 'Entschuldige bitte, aber in diesem Archiv wurden keine Ergebnisse gefunden. Vielleicht hilft die Suchfunktion ein Ergebnis zu finden.', 'starkers' ); ?></p>
            <?php get_search_form(); ?></div>
<?php endif; ?>
 
<?php while ( have_posts() ) : the_post(); ?>
 
<?php /* How to display posts of the Gallery format. The gallery category is the old way. */ ?>
 
    <?php if ( ( function_exists( 'get_post_format' ) && 'gallery' == get_post_format( $post->ID ) ) || in_category( _x( 'gallery', 'gallery category slug', 'starkers' ) ) ) : ?>
     
        <article id="post-<?php the_ID(); ?>" <?php post_class('hyphenate'); ?>>
            <header>
                <h2><a href="<?php the_permalink(); ?>" title="<?php printf( esc_attr__( 'Permalink zu %s', 'starkers' ), the_title_attribute( 'echo=0' ) ); ?>" rel="bookmark"><?php the_title(); ?></a></h2>
 
                <?php starkers_posted_on(); ?>
            </header>
 
<?php if ( post_password_required() ) : ?>
                <?php the_content(); ?>
<?php else : ?>
<?php $images = get_children( array( 'post_parent' => $post->ID, 'post_type' => 'attachment', 'post_mime_type' => 'image', 'orderby' => 'menu_order', 'order' => 'ASC', 'numberposts' => 999 ) );
    if ( $images ) :
        $total_images = count( $images );
        $image = array_shift( $images );
        $image_img_tag = wp_get_attachment_image( $image->ID, 'thumbnail' ); ?>
        
        <a href="<?php the_permalink(); ?>"><?php echo $image_img_tag; ?></a>
         
        <p><?php printf( _n( 'This gallery contains <a %1$s>%2$s photo</a>.', 'This gallery contains <a %1$s>%2$s photos</a>.', $total_images, 'starkers' ), 'href="' . get_permalink() . '" title="' . sprintf( esc_attr__( 'Permalink zu %s', 'starkers' ), the_title_attribute( 'echo=0' ) ) . '" rel="bookmark"', number_format_i18n( $total_images )); ?></p>

	<?php endif; ?>
     
    <?php the_excerpt(); ?>
 
<?php endif; ?>
 
            <footer>
	            <?php if ( function_exists( 'get_post_format' ) && 'gallery' == get_post_format( $post->ID ) ) : ?>
	            <a href="<?php echo get_post_format_link( 'gallery' ); ?>" title="<?php esc_attr_e( 'View Galleries', 'starkers' ); ?>"><?php _e( 'More Galleries', 'starkers' ); ?></a> | 
	            
	            <?php elseif ( in_category( _x( 'gallery', 'gallery category slug', 'starkers' ) ) ) : ?>
	            <a href="<?php echo get_term_link( _x( 'gallery', 'gallery category slug', 'starkers' ), 'category' ); ?>" title="<?php esc_attr_e( 'View posts in the Gallery category', 'starkers' ); ?>"><?php _e( 'More Galleries', 'twentyten' ); ?></a> | 
	            
	            <?php endif; ?>
	            
	            <?php //comments_popup_link( __( 'Leave a comment', 'starkers' ), __( '1 Comment', 'starkers' ), __( '% Comments', 'starkers' ) ); ?>
	            <?php edit_post_link( __( 'Bearbeiten', 'starkers' ), '| ', '' ); ?>
            </footer>
        </article>
 
<?php /* How to display posts of the Aside format. The asides category is the old way. */ ?>
    
    <?php elseif ( ( function_exists( 'get_post_format' ) && 'aside' == get_post_format( $post->ID ) ) || in_category( _x( 'asides', 'asides category slug', 'starkers' ) )  ) : ?>
     
        <article id="post-<?php the_ID(); ?>" <?php post_class('hyphenate'); ?>>
 
        <?php if ( is_archive() || is_search() ) : // Display excerpts for archives and search. ?>
                <?php the_excerpt(); ?>
        <?php else : ?>
                <?php the_content( __( 'Weiterlesen &raquo;', 'starkers' ) ); ?>
        <?php endif; ?>
         
            <footer>
                <?php starkers_posted_on(); ?> | <?php //comments_popup_link( __( 'Leave a comment', 'starkers' ), __( '1 Comment', 'starkers' ), __( '% Comments', 'starkers' ) ); ?> <?php edit_post_link( __( 'Bearbeiten', 'starkers' ), '| ', '' ); ?>
            </footer>
        </article>
 
<?php /* How to display all other posts. */ ?>
 
    <?php else : ?>
     	<?php if ( is_user_logged_in() || !in_category('tipi') ) : ?>
        <article id="post-<?php the_ID(); ?>" <?php post_class('hyphenate'); ?>>
         
			<header><span class="article-meta">
            	<?php starkers_posted_on(); ?>
                <?php edit_post_link( __( 'Bearbeiten', 'starkers' ), '| ', '' ); ?></span>
                <h2><a href="<?php the_permalink(); ?>" title="<?php printf( esc_attr__( 'Permalink zu %s', 'starkers' ), the_title_attribute( 'echo=0' ) ); ?>" rel="bookmark"><?php the_title(); ?></a></h2>
 
                
            </header><div class="content">
 
    <?php if ( is_archive() || is_search() ) : // Only display excerpts for archives and search. ?>
    <?php if ( has_post_thumbnail() ) { // check if the post has a Post Thumbnail assigned to it.
  			echo '<p style="text-align:center;"><a href="'.get_permalink().'">';
  			the_post_thumbnail('front');
  			echo '</a></p>'; } ?>
                <?php the_content( __( 'Weiterlesen &raquo;', 'starkers' ) ); ?>
    <?php else : ?>
    <?php if ( has_post_thumbnail() ) { // check if the post has a Post Thumbnail assigned to it.
  			echo '<p style="text-align:center;"><a href="'.get_permalink().'">';
  			the_post_thumbnail('front');
  			echo '</a></p>'; } ?>
                <?php the_content( __( 'Weiterlesen &raquo;', 'starkers' ) ); ?>
                 
                <?php wp_link_pages( array( 'before' => '<nav>' . __( 'Pages:', 'starkers' ), 'after' => '</nav>' ) ); ?>
    <?php endif; ?>
     </div>
            <footer>
                <?php
                    /*$tags_list = get_the_tag_list( '', ' | ' );
                    if ( $tags_list ):*/
                ?>
                        <?php //printf( __( 'Schlagwort: %2$s', 'starkers' ), 'entry-utility-prep entry-utility-prep-tag-links', $tags_list ); ?>
                <?php //endif; ?>
            </footer>
		</article>
 
            <?php comments_template( '', true ); ?>
 		<?php endif; ?>
    <?php endif; // This was the if statement that broke the loop into three parts based on categories. ?>
 
<?php endwhile; // End the loop. Whew. ?>
 
<?php /* Display navigation to next/previous pages when applicable */ ?>
<?php if (  $wp_query->max_num_pages > 1 ) : ?>
    <nav>
    	<div style="float:left;"><?php previous_posts_link( __( '&larr; Vorherige Seite', 'starkers' ) ); ?></div>
        <div style="float:right;"><?php next_posts_link( __( 'Nächste Seite &rarr;', 'starkers' ) ); ?></div>
        <br style="clear:both;" />
    </nav>
<?php endif; ?>

<div class="back-to-top">
    <div class="elevator">
        <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" version="1.1" x="0px" y="0px" viewBox="0 0 100 100" enable-background="new 0 0 100 100" xml:space="preserve" height="100px" width="100px">
            <path d="M70,47.5H30c-1.4,0-2.5,1.1-2.5,2.5v40c0,1.4,1.1,2.5,2.5,2.5h40c1.4,0,2.5-1.1,2.5-2.5V50C72.5,48.6,71.4,47.5,70,47.5z   M47.5,87.5h-5v-25h5V87.5z M57.5,87.5h-5v-25h5V87.5z M67.5,87.5h-5V60c0-1.4-1.1-2.5-2.5-2.5H40c-1.4,0-2.5,1.1-2.5,2.5v27.5h-5  v-35h35V87.5z"/>
            <path d="M50,42.5c1.4,0,2.5-1.1,2.5-2.5V16l5.7,5.7c0.5,0.5,1.1,0.7,1.8,0.7s1.3-0.2,1.8-0.7c1-1,1-2.6,0-3.5l-10-10  c-1-1-2.6-1-3.5,0l-10,10c-1,1-1,2.6,0,3.5c1,1,2.6,1,3.5,0l5.7-5.7v24C47.5,41.4,48.6,42.5,50,42.5z"/>
        </svg>
        Nach oben
    </div>
</div>

</div>