<?php
/**
 * Starkers functions and definitions
 *
 * @package WordPress
 * @subpackage Starkers
 * @since Starkers HTML5 3.0
 */

/** Tell WordPress to run starkers_setup() when the 'after_setup_theme' hook is run. */
add_action( 'after_setup_theme', 'starkers_setup' );

if ( ! function_exists( 'starkers_setup' ) ):
/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * @since Starkers HTML5 3.0
 */
function starkers_setup() {

	// Post Format support. You can also use the legacy "gallery" or "asides" (note the plural) categories.
	//add_theme_support( 'post-formats', array( 'aside', 'gallery' ) );

	// This theme uses post thumbnails
	add_theme_support( 'post-thumbnails' );

	// Add default posts and comments RSS feed links to head
	add_theme_support( 'automatic-feed-links' );

	// Make theme available for translation
	// Translations can be filed in the /languages/ directory
	load_theme_textdomain( 'starkers', TEMPLATEPATH . '/languages' );

	$locale = get_locale();
	$locale_file = TEMPLATEPATH . "/languages/$locale.php";
	if ( is_readable( $locale_file ) )
		require_once( $locale_file );

	// This theme uses wp_nav_menu() in one location.
	register_nav_menus( array(
		'primary' => __( 'Primary Navigation', 'starkers' ),
	) );
}
endif;

if ( ! function_exists( 'starkers_menu' ) ):
/**
 * Set our wp_nav_menu() fallback, starkers_menu().
 *
 * @since Starkers HTML5 3.0
 */
function starkers_menu() {
	echo '<nav><ul><li><a href="'.get_bloginfo('url').'">Home</a></li>';
	wp_list_pages('title_li=');
	echo '</ul></nav>';
}
endif;
 
// Register some javascript files, because we love javascript files. Enqueue a couple as well 
function wpcandy_load_javascript_files() {
	wp_register_script( 'hyphenator', get_template_directory_uri().'/js/hyphenator.js', array(), '1.0', false );
}
add_action( 'wp_enqueue_scripts', 'wpcandy_load_javascript_files' );

function enqueue_hyphenator() {
    wp_enqueue_script('hyphenator');            
}
add_action( 'wp_enqueue_scripts', 'enqueue_hyphenator' );

/**
 * Set up scout right management system.
 */
function dpsg_rott_set_roles() {
	if ( get_role( "rover" ) == null || get_role( "leiter" ) == null || get_role( "stavo" ) == null ) {
		add_role('stavo', __( 'StaVo' ),
			array(
				'create_users' => true,
				'delete_users' => false,
				'edit_users'   => true,
				'list_users'   => true,
				'moderate_comments' => true,
				'manage_categories' => true,
				'manage_links' => true,
				'edit_others_posts' => true,
				'edit_pages'   => true,
				'edit_others_pages' => true,
				'edit_published_pages'   => true,
				'publish_pages'     => true,
				'delete_pages' => true,
				'delete_others_pages'    => true,
				'delete_published_pages' => true,
				'delete_others_posts'    => true,
				'delete_private_posts'   => true,
				'edit_private_posts'     => true,
				'read_private_posts'     => true,
				'delete_private_pages'   => true,
				'edit_private_pages'     => true,
				'read_private_pages'     => true,
				'read'         => true,
				'edit_posts'   => true,
				'delete_posts' => true,
				'upload_files' => true,
				'publish_posts'          => true,
				'delete_published_posts' => true,
				'edit_published_posts'   => true
			)
		);
		add_role('leiter', __( 'Leiter' ),
			array(
				'read'         => true,
				'edit_posts'   => true,
				'delete_posts' => true,
				'upload_files' => true,
				'edit_pages'   => true,
				'edit_others_pages' => true,
				'edit_published_pages'   => true,
				'publish_posts'          => true,
				'delete_published_posts' => true,
				'edit_published_posts'   => true,
				'edit_others_posts'      => true,
				'delete_others_posts'    => true
			)
		);
		add_role('rover', __( 'Rover' ),
			array(
				'read'         => true,
				'edit_posts'   => true,
				'delete_posts' => true,
				'upload_files' => true,
				'publish_posts'          => true,
				'delete_published_posts' => true,
				'edit_published_posts'   => true
			)
		);
		add_role('pfadi', __( 'Pfadi' ),
			array(
				'read'         => true,
				'edit_posts'   => true,
				'delete_posts' => true
			)
		);
		add_role('jupfi', __( 'Jupfi' ),
			array(
				'read'         => true,
				'edit_posts'   => true,
				'delete_posts' => true
			)
		);
		add_role('woe', __( 'Wö' ),
			array(
				'read'         => true,
				'edit_posts'   => true,
				'delete_posts' => true
			)
		);

		remove_role( 'subscriber' );
		remove_role( 'contributor' );
		remove_role( 'author' );
		remove_role( 'editor' );
	}
}
add_action( 'after_setup_theme', 'dpsg_rott_set_roles' );

/**
 * Set up specific dashboard pages.
 */
function dpsg_rott_set_dashboard() {
	add_dashboard_page('Tipikalender', 'Tipikalender', 'publish_posts', 'tipikalender', 'dpsg_rott_dashboard_tipikalender');
	add_dashboard_page('Downloads', 'Downloads', 'publish_posts', 'downloads', 'dpsg_rott_dashboard_downloads');
	add_dashboard_page('Wiki und Veranstaltungstool', 'Wiki / Veranstaltungen', 'publish_posts', 'wiki', 'dpsg_rott_dashboard_wiki');
}
add_action('admin_menu', 'dpsg_rott_set_dashboard');

/**
 * Define the new dashboard pages.
 */
function dpsg_rott_dashboard_tipikalender() {
	require 'dashboard/tipikalender.php';
}
function dpsg_rott_dashboard_downloads() {
	require 'dashboard/downloads.php';
}
function dpsg_rott_dashboard_wiki() {
        require 'dashboard/wiki.php';
}

/**
 * Add help and option tabs to the new dashboard pages.
 */
function add_help_options_dashboard_page_downloads() {
	// Adds a help tab to the current page
    get_current_screen()->add_help_tab( array(
        'id'	=> 'my_help_tab_one',
        'title'	=> __('Übersicht'),
        'content'	=> '<p>Hier findest du mehr und weniger wichtige Dokumente wie z. B. Ausschreibungen, eine Packliste, Ordnung und Satzung der DPSG, Zuschussanträge, und so weiter.</p><p>Dokumente lassen sich über die Spalte <i>Formate</i> einzeln oder über die Funktion <i>Alle herunterladen</i> als Formatpaket herunterladen. Mehrere Dokumente können über die Checkboxen ausgewählt und mittels der Aktion <i>Herunterladen</i> als Paket geladen werden. Dafür dürfen Pop-ups nicht unterdrückt werden!</p>'
    ) );
    get_current_screen()->add_help_tab( array(
        'id'	=> 'my_help_tab_two',
        'title'	=> __('Upload'),
        'content'	=> '<p>Dokumente können mittels FTP zur Liste hinzugefügt und auch wieder entfernt werden. Dafür wird ein FTP-Client (z. B. <a href="https://filezilla-project.org/download.php?type=client" target="_blank">FileZilla</a>) benötigt. Die Zugangsdaten lauten:</p><p>Server: ftp.strato.com<br>Benutzername: upload@dpsg-rott.de<br>Passwort: M3bfr/rG</p><p>Hinweis: Leerzeichen im Dateinamen bitte durch Unterstriche ersetzen und Sonderzeichen - soweit möglich - vermeiden. Verschiedene Formate einer Datei müssen den gleichen Dateinamen haben, damit sie in der Liste korrekt aufgeführt werden!</p>'
    ) );
}
function add_help_options_dashboard_page_tipikalender() {
	// Adds a help tab to the current page
    get_current_screen()->add_help_tab( array(
        'id'	=> 'my_help_tab_one',
        'title'	=> __('Übersicht'),
        'content'	=> '<p>In diesem Kalender befinden sich alle Reservierungen für das Tipi. Termine können über die Aktion <i>Bearbeiten</i> geändert und mit <i>Löschen</i> entfernt werden. Neue Termine lassen sich über <i>Neuer Eintrag</i> hinzufügen.</p>'
    ) );
    get_current_screen()->add_help_tab( array(
        'id'	=> 'my_help_tab_two',
        'title'	=> __('Abonnieren'),
        'content'	=> '<p>Der Tipikalender lässt sich mit folgendem Link in fast alle gängigen Kalenderprogramme einfügen:</p><p>'.get_stylesheet_directory_uri().'/tipikalender.php</p>'
    ) );
}
add_action('load-dashboard_page_tipikalender', 'add_help_options_dashboard_page_tipikalender');
add_action('load-dashboard_page_downloads', 'add_help_options_dashboard_page_downloads');

/**
 * Register new page to create entries for tipi calendar.
 */
function register_tipikalender_new() {
	add_submenu_page( null, 'Neuen Eintrag erstellen', 'Neuen Eintrag erstellen', 'publish_posts', 'tipikalender-new', function(){ include get_stylesheet_directory()."/dashboard/tipikalender-new.php";} ); 
}
add_action('admin_menu', 'register_tipikalender_new');

/**
 * Register new page to edit entries for tipi calendar.
 */
function register_tipikalender_edit() {
	add_submenu_page( null, 'Eintrag bearbeiten', 'Eintrag bearbeiten', 'publish_posts', 'tipikalender-edit', function(){ include get_stylesheet_directory()."/dashboard/tipikalender-edit.php";} ); 
}
add_action('admin_menu', 'register_tipikalender_edit');

/**
 * Remove inline styles printed when the gallery shortcode is used.
 *
 * @since Starkers HTML5 3.2
 */
add_filter( 'use_default_gallery_style', '__return_false' );

/* Kategorie auf der Startseite: 1 */
function mts_include_category_homepage( $query ) {
	global $wp_the_query;
	if( $wp_the_query === $query && $query->is_home() ) {
		$query->set( 'cat', '1' );
	}
}
add_action( 'pre_get_posts', 'mts_include_category_homepage' );

/* Führt eine neue Funktion ein: the_slug() */
function the_slug() {
    $post_data = get_post(get_the_ID(), ARRAY_A);
    $slug = $post_data['post_name'];
    return $slug; 
}
/* Entfernt "Geschützt: " und "Privat: " aus dem Titel */
function trim_title($title) {
    $title = utf8_decode($title);
    $find = array('/Protected: /','/Private: /','/Privat: /','/Geschützt: /');
    $replace = array('','','','');
    $title = preg_replace($find, $replace, $title);
    $title = utf8_encode($title);
    return $title;
}
add_filter('the_title', 'trim_title');

/* Fügt das Recht, private Beiträge zu lesen, allen Nutzern hinzu und erlaube Widgets zu bearbeiten */
function fb_add_cap2role() {
	global $wp_roles;
	
	//$wp_roles->add_cap('editor', 'edit_theme_options');
	$wp_roles->remove_cap('editor', 'edit_theme_options');
	$wp_roles->add_cap('author', 'read_private_posts');
	//$wp_roles->add_cap('author', 'edit_theme_options');
	$wp_roles->remove_cap('author', 'edit_theme_options');
	$wp_roles->add_cap('contributor', 'read_private_posts');
	$wp_roles->add_cap('subscriber', 'read_private_posts');
}
add_action( 'init', 'fb_add_cap2role' );

/* Fügt  neue Standard-Bildgrößen hinzu */
if ( function_exists( 'add_theme_support' ) ) {
	add_theme_support( 'post-thumbnails' );
}

if ( function_exists( 'add_image_size' ) ) { 
	add_image_size( 'front', 610, 250, true ); //300 pixels wide and 250 pixels heigh
	add_image_size( 'in-article', 800, 600 ); //300 pixels wide (and unlimited height)
}

/* Artikelanfang beim Weiterlesen*/
function remove_more_link_scroll( $link ) {
	$link = preg_replace( '|#more-[0-9]+|', '', $link );
	return $link;
}
add_filter( 'the_content_more_link', 'remove_more_link_scroll' );

/* Setzt den more-Tag */
/* function new_excerpt_more($more) {
       global $post;
	return ' <a href="'. get_permalink($post->ID) . '">Weiterlesen &raquo;</a>';
}
add_filter('excerpt_more', 'new_excerpt_more'); */

//  Shortcodes für 2 Spalten
 
//  Linke Spalte
function basic_leftcolumn($atts, $content = null) {
    if(!empty($content)){
    return do_shortcode('<div class="leftcolumn hyphenate">' . $content . '</div>');}
    return '<div class="leftcolumn">' . $content . '</div>';
}
add_shortcode("leftcolumn", "basic_leftcolumn");

//  Mittlere Spalte
function basic_centercolumn($atts, $content = null) {
    if(!empty($content)){
    return do_shortcode('<div class="centercolumn hyphenate">' . $content . '</div>');}
    return '<div class="centercolumn">' . $content . '</div>';
}
add_shortcode("centercolumn", "basic_centercolumn");
 
//  Rechte Spalte
function basic_rightcolumn($atts, $content = null) {
	global $wpdb;
    if(!empty($content)){
    return do_shortcode('<div class="rightcolumn notempty hyphenate">' . $content . '</div>');}
    $table_bilder = $wpdb->prefix . "bilder";
	$x = trim(wp_title("", false));
	$picture = $wpdb->get_var( "SELECT datei FROM $table_bilder WHERE titel='$x'" );
	if(strcmp($picture, "")==true) {
	return '<div class="rightcolumn empty"><h3>Das sind wir</h3><a href="'.get_template_directory_uri().'/bilder/uploader/server/php/files/'.$picture.'" title="Die '.$x.'"><img src="'.get_template_directory_uri().'/bilder/uploader/server/php/files/notbig/'.$picture.'" alt /></a></div>';
	}
	return '<div class="rightcolumn empty">' . $content . '</div>';
}
add_shortcode("rightcolumn", "basic_rightcolumn");

/**
 * Force post titles.
 */
function force_post_title_init() 
{
  wp_enqueue_script('jquery');
}
function force_post_title() 
{
  echo "<script type='text/javascript'>\n";
  echo "
  jQuery('#publish').click(function(){
        var testervar = jQuery('[id^=\"titlediv\"]')
        .find('#title');
        if (testervar.val().length < 1)
        {
            setTimeout(\"jQuery('#ajax-loading').css('visibility', 'hidden');\", 100);
            alert('Bitte gib einen Titel ein!');
            setTimeout(\"jQuery('#publish').removeClass('button-primary-disabled');\", 100);
            jQuery('[id^=\"title\"]').focus();
            return false;
        }
    });
  ";
   echo "</script>\n";
}
add_action('admin_init', 'force_post_title_init');
add_action('edit_form_advanced', 'force_post_title');

/**
 * @since Starkers HTML5 3.0
 * @deprecated in Starkers HTML5 3.2 for WordPress 3.1
 *
 * @return string The gallery style filter, with the styles themselves removed.
 */
function starkers_remove_gallery_css( $css ) {
	return preg_replace( "#<style type='text/css'>(.*?)</style>#s", '', $css );
}
// Backwards compatibility with WordPress 3.0.
if ( version_compare( $GLOBALS['wp_version'], '3.1', '<' ) )
	add_filter( 'gallery_style', 'starkers_remove_gallery_css' );

if ( ! function_exists( 'starkers_comment' ) ) :
/**
 * Template for comments and pingbacks.
 *
 * @since Starkers HTML5 3.0
 */
function starkers_comment( $comment, $args, $depth ) {
	$GLOBALS['comment'] = $comment;
	switch ( $comment->comment_type ) :
		case '' :
	?>
<article <?php comment_class(); ?> id="comment-<?php comment_ID() ?>">
<?php echo get_avatar( $comment, 40 ); ?><?php printf( __( '%s', 'starkers' ), sprintf( '%s', get_comment_author_link() ) ); ?>
<?php if ( $comment->comment_approved == '0' ) : ?>
<?php _e( 'Your comment is awaiting moderation.', 'starkers' ); ?>

<br />
<?php endif; ?>
<span class="comment-time"><a href="<?php echo esc_url( get_comment_link( $comment->comment_ID ) ); ?>">
<?php
				/* translators: 1: date, 2: time */
				printf( __( '%1$s &#64; %2$s', 'starkers' ), get_comment_date('j.n.y'),  get_comment_time() ); ?>
</a></span>
<?php edit_comment_link( __( '(Bearbeiten)', 'starkers' ), ' ' );
			?>
<?php comment_text(); ?>
<?php comment_reply_link( array_merge( $args, array( 'depth' => $depth, 'max_depth' => $args['max_depth'] ) ) ); ?>
<?php
			break;
		case 'pingback'  :
		case 'trackback' :
	?>
<article <?php comment_class(); ?> id="comment-<?php comment_ID() ?>">
<p>
  <?php _e( 'Pingback:', 'starkers' ); ?>
  <?php comment_author_link(); ?>
  <?php edit_comment_link( __('(Edit)', 'starkers'), ' ' ); ?>
</p>
<?php
			break;
	endswitch;
}
endif;

/**
 * Closes comments and pingbacks with </article> instead of </li>.
 *
 * @since Starkers HTML5 3.0
 */
function starkers_comment_close() {
	echo '</article>';
}

/**
 * Adjusts the comment_form() input types for HTML5.
 *
 * @since Starkers HTML5 3.0
 */
function starkers_fields($fields) {
$commenter = wp_get_current_commenter();
$req = get_option( 'require_name_email' );
$aria_req = ( $req ? " aria-required='true'" : '' );
$fields =  array(
	'author' => '<p><label for="author">' . __( 'Name' ) . '</label> ' . ( $req ? '*' : '' ) .
	'<input id="author" name="author" type="text" value="' . esc_attr( $commenter['comment_author'] ) . '" size="30"' . $aria_req . ' /></p>',
	'email'  => '<p><label for="email">' . __( 'Email' ) . '</label> ' . ( $req ? '*' : '' ) .
	'<input id="email" name="email" type="email" value="' . esc_attr(  $commenter['comment_author_email'] ) . '" size="30"' . $aria_req . ' /></p>',
	'url'    => '<p><label for="url">' . __( 'Website' ) . '</label>' .
	'<input id="url" name="url" type="url" value="' . esc_attr( $commenter['comment_author_url'] ) . '" size="30" /></p>',
);
return $fields;
}
add_filter('comment_form_default_fields','starkers_fields');

/**
 * Register widgetized areas.
 *
 * @since Starkers HTML5 3.0
 */
function starkers_widgets_init() {
	// Area 1, located at the top of the sidebar.
	register_sidebar( array(
		'name' => __( 'Unter dem Hauptmenü', 'starkers' ),
		'id' => 'primary-widget-area',
		'description' => __( 'Beschreibung der Seite', 'starkers' ),
		'before_widget' => '<li>',
		'after_widget' => '</li>',
		'before_title' => '<h3>',
		'after_title' => '</h3>',
	) );
	register_sidebar( array(
		'name' => __( 'Über uns Links', 'starkers' ),
		'id' => 'about-us-left-area',
		'description' => __( 'Über uns', 'starkers' ),
		'before_widget' => '<li>',
		'after_widget' => '</li>',
		'before_title' => '<h3>',
		'after_title' => '</h3>',
	) );
	register_sidebar( array(
		'name' => __( 'Über uns Mitte', 'starkers' ),
		'id' => 'about-us-middle-area',
		'description' => __( 'Über uns', 'starkers' ),
		'before_widget' => '<li>',
		'after_widget' => '</li>',
		'before_title' => '<h3>',
		'after_title' => '</h3>',
	) );
	register_sidebar( array(
		'name' => __( 'Über uns Rechts', 'starkers' ),
		'id' => 'about-us-right-area',
		'description' => __( 'Über uns', 'starkers' ),
		'before_widget' => '<li>',
		'after_widget' => '</li>',
		'before_title' => '<h3>',
		'after_title' => '</h3>',
	) );
	register_sidebar( array(
		'name' => __( 'Impressum', 'starkers' ),
		'id' => 'impressum-area',
		'description' => __( 'Impressum', 'starkers' ),
		'before_widget' => '<li>',
		'after_widget' => '</li>',
		'before_title' => '<h3>',
		'after_title' => '</h3>',
	) );
}
/** Register sidebars by running starkers_widgets_init() on the widgets_init hook. */
add_action( 'widgets_init', 'starkers_widgets_init' );



function hide_wp_logo_login() { ?>
    <style type="text/css">
        #login h1 a, .login h1 a {
		display: none;        	
        }
    </style>
<?php }
add_action( 'login_enqueue_scripts', 'hide_wp_logo_login' );
function add_yeti_to_login() {
	return file_get_contents(get_stylesheet_directory()."/login/login.html");
}
add_filter( 'login_message', 'add_yeti_to_login' );
function animate_yeti_login() {
	echo '<script type="text/javascript">'.file_get_contents(get_stylesheet_directory()."/login/TweenMax.min.js")."</script>";
	echo '<script type="text/javascript">'.file_get_contents(get_stylesheet_directory()."/login/login.js")."</script>";
}
add_action('login_footer', 'animate_yeti_login');

/* Fügt einen neuen Link zum Dashboard hinzu */

function hans() {
	include 'bilder/forward.php';
}

function dashboardMenu(){
if(current_user_can("publish_posts")==true) add_dashboard_page( "Bilder", "Bilder", "read", "bilder", 'hans');
} /* end function */  
add_action('admin_menu', 'dashboardMenu');

if (!is_admin()) add_action("wp_enqueue_scripts", "my_jquery_enqueue", 11);
function my_jquery_enqueue() {
   wp_deregister_script('jquery');
   wp_register_script('jquery', "http" . ($_SERVER['SERVER_PORT'] == 443 ? "s" : "") . "://www.pfadfinder-rott.de/wp-content/themes/pfadfinder-rott/js/jquery-1.7.1.min.js", false, null);
   wp_enqueue_script('jquery');
}

/**
 * Customize the TinyMCE editor. Standard:
 *
 * $in['toolbar1'] = 'bold,italic,strikethrough,bullist,numlist,blockquote,hr,alignleft,aligncenter,alignright,link,unlink,wp_more,spellchecker,wp_fullscreen,wp_adv ';
 * $in['toolbar2'] = 'formatselect,underline,alignjustify,forecolor,pastetext,removeformat,charmap,outdent,indent,undo,redo,wp_help ';
 *
 */
function my_format_TinyMCE( $in ) {
	$in['toolbar1'] = 'bold,italic,underline,bullist,numlist,blockquote,hr,link,unlink,wp_more,spellchecker,wp_fullscreen,wp_adv ';
	$in['toolbar2'] = 'formatselect,strikethrough,pastetext,removeformat,charmap,outdent,indent,undo,redo,wp_help ';
	$in['toolbar3'] = '';
	$in['toolbar4'] = '';
	return $in;
}
add_filter( 'tiny_mce_before_init', 'my_format_TinyMCE' );

/**
 * Removes the default styles that are packaged with the Recent Comments widget.
 *
 * @updated Starkers HTML5 3.2
 */
function starkers_remove_recent_comments_style() {
	add_filter( 'show_recent_comments_widget_style', '__return_false' );
}
add_action( 'widgets_init', 'starkers_remove_recent_comments_style' );

if ( ! function_exists( 'starkers_posted_on' ) ) :
/**
 * Prints HTML with meta information for the current post—date/time and author.
 *
 * @since Starkers HTML5 3.0
 */
function starkers_posted_on() {
	
	printf( __( the_time('l').', den %2$s | '.get_the_category_list( '<span class="comma">, </span>' ), 'starkers' ),
		'meta-prep meta-prep-author',
		sprintf( '<time datetime="%3$s" pubdate>%4$s</time>',
			get_permalink(),
			esc_attr( get_the_time() ),
			get_the_date('Y-m-d'),
			get_the_date()
		),
		sprintf( '<a href="%1$s" title="%2$s">%3$s</a>',
			get_author_posts_url( get_the_author_meta( 'ID' ) ),
			sprintf( esc_attr__( 'Alle Beiträge von %s ansehen', 'starkers' ), get_the_author() ),
			get_the_author()
		)
	);
}
endif;

if ( ! function_exists( 'starkers_posted_on_new' ) ) :
/**
 * Prints HTML with meta information for the current post—date/time and author.
 *
 * @since Starkers HTML5 3.0
 */
function starkers_posted_on_new() {
	printf( __( the_time('l').', den %2$s von %3$s', 'starkers' ),
		'meta-prep meta-prep-author',
		sprintf( '<time datetime="%3$s" pubdate>%4$s</time>',
			get_permalink(),
			esc_attr( get_the_time() ),
			get_the_date('Y-m-d'),
			get_the_date()
		),
		sprintf( '<a href="%1$s" class="header-link" title="%2$s">%3$s</a>',
			get_author_posts_url( get_the_author_meta( 'ID' ) ),
			sprintf( esc_attr__( 'Alle Beiträge von %s ansehen', 'starkers' ), get_the_author() ),
			get_the_author()
		)
	);
}
endif;

if ( ! function_exists( 'starkers_posted_in' ) ) :
/**
 * Prints HTML with meta information for the current post (category, tags and permalink).
 *
 * @since Starkers HTML5 3.0
 */
function starkers_posted_in() {
	// Retrieves tag list of current post, separated by commas.
	$tag_list = get_the_tag_list( '', ', ' );
	if ( $tag_list ) {
		$posted_in = __( 'This entry was posted in %1$s and tagged %2$s. Bookmark the <a href="%3$s" title="Permalink to %4$s" rel="bookmark">permalink</a>.', 'starkers' );
	} elseif ( is_object_in_taxonomy( get_post_type(), 'category' ) ) {
		$posted_in = __( 'This entry was posted in %1$s. Bookmark the <a href="%3$s" title="Permalink to %4$s" rel="bookmark">permalink</a>.', 'starkers' );
	} else {
		$posted_in = __( 'Bookmark the <a href="%3$s" title="Permalink to %4$s" rel="bookmark">permalink</a>.', 'starkers' );
	}
	// Prints the string, replacing the placeholders.
	printf(
		$posted_in,
		get_the_category_list( ', ' ),
		$tag_list,
		get_permalink(),
		the_title_attribute( 'echo=0' )
	);
}
endif;
