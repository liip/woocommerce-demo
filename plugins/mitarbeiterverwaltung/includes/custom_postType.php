<?php

/**
 * File: custom_postType.php
 *
 * Description: -Erstellen des neuen Custom Post Types Employee.
 *              -Es können Mitarbeiter hinzugefügt werden und alle in einer Tabelle angesehen werden.
 *              -Es wird die Single Template Seite definiert für die Anzeige eines einzelnen Mitarbeiter im Frontend
 *
 * Author: Marc Brühwiler <marc.bruehwiler@liip.ch>
 *
 * @package mitarbeiterverwaltung-ipa
 */


/**
 * Custom Post Type erstellen und registrieren
 * Generiert: http://generatewp.com/post-type/
 */
function cpt_employee() {

	$labels = array(
		'name'               => __( 'Mitarbeiter', 'mitarbeiterverwaltung' ),
		'singular_name'      => __( 'Mitarbeiter', 'mitarbeiterverwaltung' ),
		'menu_name'          => __( 'Mitarbeiter', 'mitarbeiterverwaltung' ),
		'parent_item_colon'  => __( 'Mitarbeiter', 'mitarbeiterverwaltung' ),
		'all_items'          => __( 'Alle Mitarbeiter', 'mitarbeiterverwaltung' ),
		'view_item'          => __( 'Mitarbeiter anzeigen', 'mitarbeiterverwaltung' ),
		'add_new_item'       => __( 'Mitarbeiter hinzufügen', 'mitarbeiterverwaltung' ),
		'add_new'            => __( 'Mitarbeiter hinzufügen', 'mitarbeiterverwaltung' ),
		'edit_item'          => __( 'Mitarbeiter bearbeiten', 'mitarbeiterverwaltung' ),
		'update_item'        => __( 'Mitarbeiter aktualisieren', 'mitarbeiterverwaltung' ),
		'search_items'       => __( 'Mitarbeiter suchen', 'mitarbeiterverwaltung' ),
		'not_found'          => __( 'Mitarbeiter nicht gefunden', 'mitarbeiterverwaltung' ),
		'not_found_in_trash' => __( 'Mitarbeiter nicht gefunden', 'mitarbeiterverwaltung' ),
	);

	$rewrite = array(
		'slug'       => 'mitarbeiter',
		'with_front' => true,
		'pages'      => true,
		'feeds'      => true,
	);

	$args = array(
		'label'               => __( 'cpt_employee', 'mitarbeiterverwaltung' ),
		'description'         => __( 'Mitarbeiter hinzufügen und bearbeiten', 'mitarbeiterverwaltung' ),
		'labels'              => $labels,
		'supports'            => array( 'title', 'thumbnail' ),
		'taxonomies'          => array( 'employee_categories' ),
		'hierarchical'        => false,
		'public'              => true,
		'show_ui'             => true,
		'show_in_menu'        => true,
		'show_in_nav_menus'   => true,
		'show_in_admin_bar'   => true,
		'menu_position'       => 5,
		'can_export'          => true,
		'has_archive'         => false,
		'exclude_from_search' => false,
		'publicly_queryable'  => true,
		'rewrite'             => $rewrite,
		'capability_type'     => 'page',
	);

	register_post_type( 'cpt_employee', $args );
}

add_action( 'init', 'cpt_employee' );

/**
 * Eigenes Template für die Singleseite suchen und zurückgeben
 *
 * @return string Template Pfad
 */
function get_mv_singletemplate() {
	global $post;

	if ( $post->post_type == 'cpt_employee' ) {

		// Template wird im Theme Ordner lokalisiert und zurückgegeben
		if ( locate_template( 'single-cpt_employee.php' ) != '' ) {
			return locate_template( 'single-cpt_employee.php' );
		}

		// Template aus dem Plugin Ordner wird zurückgegeben
		return __DIR__ . '/../templates/single-cpt_employee.php';
	}

}

add_filter( 'single_template', 'get_mv_singletemplate' );