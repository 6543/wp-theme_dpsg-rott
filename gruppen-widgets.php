<?php
/**
 * Starkers functions and definitions
 *
 * @package WordPress
 * @subpackage Starkers
 * @since Starkers HTML5 3.0
 */
 
function gruppen_widgets_init() {
	$groups = array("Adler", "Biber", "Elche", "Fledermäuse", "Füchse", "Kojoten", "Trolle", "Wiesel");
	$slugs = array("adler", "biber", "elche", "fledermause", "fuchse", "kojoten", "trolle", "wiesel");
	for($i = 0; $i<count($groups); $i++) {
		register_sidebar( array(
			'name' => __( $groups[$i].' Links', 'starkers' ),
			'id' => $slugs[$i].'-left-widget-area',
			'description' => __( 'Beschreibung der Gruppe', 'starkers' ),
			'before_widget' => '<li>',
			'after_widget' => '</li>',
			'before_title' => '<h3>',
			'after_title' => '</h3>',
		) );
		register_sidebar( array(
			'name' => __( $groups[$i].' Mitte', 'starkers' ),
			'id' => $slugs[$i].'-middle-widget-area',
			'description' => __( 'Beschreibung der Gruppe', 'starkers' ),
			'before_widget' => '<li>',
			'after_widget' => '</li>',
			'before_title' => '<h3>',
			'after_title' => '</h3>',
		) );
		register_sidebar( array(
			'name' => __( $groups[$i].' Rechts', 'starkers' ),
			'id' => $slugs[$i].'-right-widget-area',
			'description' => __( 'Beschreibung der Gruppe', 'starkers' ),
			'before_widget' => '<li>',
			'after_widget' => '</li>',
			'before_title' => '<h3>',
			'after_title' => '</h3>',
		) );
	}
}

add_action( 'widgets_init', 'gruppen_widgets_init' );