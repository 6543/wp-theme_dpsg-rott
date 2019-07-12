<?php
/**
 * The Header for our theme.
 *
 * Displays all of the <head> section
 *
 * @package WordPress
 * @subpackage Starkers
 * @since Starkers HTML5 3.0
 */
?>
<?php
// Include Mobile_Detect
include('Mobile_Detect.php');
$detect = new Mobile_Detect();
?>
<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
<meta charset="<?php bloginfo( 'charset' ); ?>" />
<title>
<?php
 
    global $page, $paged;
 
    wp_title( '|', true, 'right' );
 
    bloginfo( 'name' );
 
    $site_description = get_bloginfo( 'description', 'display' );
    if ( $site_description && ( is_home() || is_front_page() ) )
        echo " | $site_description";
 
    if ( $paged >= 2 || $page >= 2 )
        echo ' | ' . sprintf( __( 'Page %s', 'starkers' ), max( $paged, $page ) );
 
    ?>
</title>
<link rel="profile" href="http://gmpg.org/xfn/11" />
<?php
/*if ( is_page('bilder') ) {
	echo '<link rel="stylesheet" href="'.get_bloginfo( "template_directory" ).'/js/jquery.fancybox-1.3.4/style.css" type="text/css" media="screen" />
	
	<script type="text/javascript" src="'.get_bloginfo( "template_directory" ).'/js/jquery.fancybox-1.3.4/fancybox/jquery.fancybox-1.3.4.pack.js"></script>
	<script type="text/javascript" src="'.get_bloginfo( "template_directory" ).'/js/jquery.fancybox-1.3.4/fancybox/jquery.easing-1.3.pack.js"></script>
	<script type="text/javascript" src="'.get_bloginfo( "template_directory" ).'/js/jquery.fancybox-1.3.4/fancybox/jquery.mousewheel-3.0.4.pack.js"></script>';
}*/
?>
<link rel="stylesheet" type="text/css" media="all" href="<?php bloginfo( 'template_directory' ); ?>/style.css" />
<script type="text/javascript" src="<?php bloginfo('template_url'); ?>/js/elevator.min.js"></script>
<?php
// This is just for Mobile-Detection.
if($detect->isTablet()) {
	echo '<meta name="viewport" content="width=device-width, user-scalable=no" />';
}
if($detect->isMobile()==true && $detect->isTablet()==false) {
	echo '<link rel="stylesheet" type="text/css" media="all" href="'.get_bloginfo( 'template_directory' ).'/mobile.css" />';
}
?>
<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>" />
<script src="<?php bloginfo('template_directory'); ?>/js/modernizr-1.6.min.js"></script>
<?php
    /* We add some JavaScript to pages with the comment form
     * to support sites with threaded comments (when in use).
     */
    if ( is_singular() && get_option( 'thread_comments' ) )
        wp_enqueue_script( 'comment-reply' );
 
    /* Always have wp_head() just before the closing </head>
     * tag of your theme, or you will break many plugins, which
     * generally use this hook to add elements to <head> such
     * as styles, scripts, and meta tags.
     */
    wp_head();
?>
<?php if(is_home()) : ?>
<meta property="og:title" content="<?php bloginfo('name'); ?>" />
<meta property="og:type" content="website" />
<meta property="og:url" content="<?php echo home_url('/'); ?>" />
<meta property="og:description" content="<?php bloginfo('description'); ?>" />
<meta property="og:site_name" content="<?php bloginfo('name'); ?>" />
<meta property="og:locale" content="de_de" />
<meta property="og:image" content="<?php echo get_bloginfo('template_url')."/images/logo_gross.png"; ?>" />
<?php endif; ?>
</head>
<body <?php body_class(); ?>>
<img src="<?php echo get_bloginfo('template_url')."/images/background.png"; ?>" id="bg" alt="">
<div class="left"><header>
<a href="<?php echo get_option('home'); ?>/"><div class="headerpicture" style="<?=(strcmp(current_time("Ymd"), "20170401")==0) ? "background-image: url('/wp-content/themes/pfadfinder-rott/images/logo_engelbert.png');" : ""?>"></div></a>
  <hr>
        
  <?php /* Our navigation menu.  If one isn't filled out, wp_nav_menu falls back to the 'starkers_menu' function which can be found in functions.php.  The menu assiged to the primary position is the one used.  If none is assigned, the menu with the lowest ID is used.  */ ?>
  <div id="menu">
    <?php wp_nav_menu( array( 'container' => 'nav', 'fallback_cb' => 'starkers_menu', 'theme_location' => 'primary' ) );
		 ?>
  </div>
  <hr>
  <div class="hyphenate"><?php get_sidebar(); ?></div>
</header></div>
