<?php
/**
 * File: custom_adminColumns.php
 *
 * Description: -Fügt im backend in dem Custom Post Type (cpt_employee) weitere Spalten hinzu
 *              -Fügt im backend in der Custom Taxonomy (employee_categories) eine weitere Spalte hinzu.
 *
 * Author: Marc Brühwiler <marc.bruehwiler@liip.ch>
 *
 * @package mitarbeiterverwaltung-ipa
 */


/**
 * Fügt der Mitarbeiterübersicht weitere Spalten hinzu.
 *
 * @param $columns dieser Array beinhaltet alle Standard Spalten von WordPress
 *
 * @return mixed Array mit neuen Spalten
 */
function add_cpt_employee_columns( $columns ) {
	$columns['birthdate'] = __('Geburtsdatum', 'mitarbeiterverwaltung');
	$columns['email']     = 'E-Mail';
	$columns['shortcode'] = 'Shortcode';

	return $columns;
}

add_filter( 'manage_cpt_employee_posts_columns', 'add_cpt_employee_columns' );


/**
 * Inhalt der Spalte definieren und Filter aufrufen
 *
 * @param $column String mit allen aktuellen Spalten ID
 * @param $post_id die ID des aktuellen Beitrages
 *
 */
function add_cpt_employee_column_content( $column, $post_id ) {

	$birthdate = get_post_meta( get_the_id(), 'employee_birthdate', true );

	switch ( $column ) {
		case 'shortcode':
			echo '[employee id="' . $post_id . '"]';
			break;
		case 'birthdate':
			echo strftime( '%d.%m.%Y', strtotime( $birthdate ) );
			break;
		case 'email':
			echo get_post_meta( get_the_id(), 'employee_email', true );
		default:
			break;
	}
}

add_action( 'manage_posts_custom_column', 'add_cpt_employee_column_content', 10, 2 );


/**
 * Fügt der Mitarbeiter-Kategorie Übersicht weitere Spalten hinzu.
 *
 * @param $columns Array mit allen verfügbaren Spalten für die Kategorie
 *
 * @return mixed Array mit neuen Spalten
 */
function add_employee_categories_columns( $columns ) {
	$columns['shortcode'] = 'Shortcode';

	return $columns;
}

add_filter( 'manage_edit-employee_categories_columns', 'add_employee_categories_columns' );


/**
 * Inhalt der Spalte definieren und Filter aufrufen
 *
 * @param $content Inhalt der Spaltenfelder
 * @param $column_name Spalten ID
 * @param $term_id die ID der aktuellen Kategorie
 *
 * @return string Inhalt der Spalte
 */
function add_employee_categories_column_content( $content, $column_name, $term_id ) {
	$term = get_term( $term_id, 'employee_categories' );
	switch ( $column_name ) {
		case 'shortcode':
			$content = '[employee-group cat="' . $term->slug . '"]';
			break;
		default:
			break;
	}

	return $content;
}

add_filter( 'manage_employee_categories_custom_column', 'add_employee_categories_column_content', 10, 3 );