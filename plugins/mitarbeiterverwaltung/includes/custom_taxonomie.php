<?php
/**
 * File: custom_taxonomie.php
 *
 * Description: -Es wird eine Custom Taxonomie erstellt (employee_categories)
 *
 * Author: Marc Brühwiler <marc.bruehwiler@liip.ch>
 *
 * @package mitarbeiterverwaltung-ipa
 */

/**
 * Custom Taxonomy erstellen und registrieren und dem Posttype zuweisen
 * Generiert: http://generatewp.com/taxonomy/
 */
function ctx_employee() {

	$labels = array(
		'name'                       => __( 'Mitarbeiterkategorie', 'mitarbeiterverwaltung' ),
		'singular_name'              => __( 'Mitarbeiterkategorie', 'mitarbeiterverwaltung' ),
		'menu_name'                  => __( 'Mitarbeiterkategorien', 'mitarbeiterverwaltung' ),
		'all_items'                  => __( 'Alle Kategorien', 'mitarbeiterverwaltung' ),
		'parent_item'                => __( 'Übergeordnete Mitarbeiterkategorie', 'mitarbeiterverwaltung' ),
		'parent_item_colon'          => __( 'Übergeordnete Mitarbeiterkategorie:', 'mitarbeiterverwaltung' ),
		'new_item_name'              => __( 'Neue Mitarbeiterkategorie', 'mitarbeiterverwaltung' ),
		'add_new_item'               => __( 'Mitarbeiterkategorie hinzufügen', 'mitarbeiterverwaltung' ),
		'edit_item'                  => __( 'Mitarbeiterkategorie bearbeiten', 'mitarbeiterverwaltung' ),
		'update_item'                => __( 'Mitarbeiterkategorie aktualisieren', 'mitarbeiterverwaltung' ),
		'separate_items_with_commas' => __( 'trennt Kategorien mit Kommas', 'mitarbeiterverwaltung' ),
		'search_items'               => __( 'Kategorie suchen', 'mitarbeiterverwaltung' ),
		'add_or_remove_items'        => __( 'Hinzufügen oder entfernen von Kategorien', 'mitarbeiterverwaltung' ),
		'choose_from_most_used'      => __( 'Wählen Sie aus den am meisten verwendeten Kategorien aus', 'mitarbeiterverwaltung' ),
		'not_found'                  => __( 'Nicht gefunden', 'mitarbeiterverwaltung' ),
	);
	$args   = array(
		'labels'            => $labels,
		'hierarchical'      => true,
		'public'            => true,
		'show_ui'           => true,
		'show_admin_column' => true,
		'show_in_nav_menus' => true,
		'show_tagcloud'     => true,
	);

	register_taxonomy( 'employee_categories', array( 'cpt_employee' ), $args );
}

add_action( 'init', 'ctx_employee' );