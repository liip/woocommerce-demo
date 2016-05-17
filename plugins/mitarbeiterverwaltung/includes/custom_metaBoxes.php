<?php
/**
 * File: custom_metaBoxes.php
 *
 * Description: -Erstellt anhand des Plugins Custom-Meta-Boxes alle Metaboxen und Metafelder um einen neuen Mitarbeiter zu erfassen.
 *               Ist also abhängig von dem Plugin Custom-Meta-Boxes-master
 *
 * Author: Marc Brühwiler <marc.bruehwiler@liip.ch>
 *
 * @package mitarbeiterverwaltung-ipa
 */

include_once ('custom_fieldValidation.php');

/**
 * Definiert Metaboxen und Metafelder mit ihren konfigurationen
 *
 * @param array $meta_boxes beinhaltet alle Metaboxes und Metafields
 *
 * @return array $meta_boxes beinhaltet alle Metaboxes und Metafields
 */
function mb_metaboxes( array $meta_boxes ) {

	// Meta-Felder erstellen
	$employee_details = array(
		array( 'id' => 'mitarbeiter-details', 'name' => __( 'Mitarbeiterbezogene Angaben', 'mitarbeiterverwaltung' ), 'type' => 'title' ),
		array(
			'id'      => 'employee_salutation',
			'name'    => __( 'Anrede', 'mitarbeiterverwaltung' ),
			'type'    => 'select',
			'options' => array( 'Herr' => __( 'Herr', 'mitarbeiterverwaltung' ), 'Frau' => __( 'Frau', 'mitarbeiterverwaltung' ) )
		),
		array( 'id' => 'employee_firstname', 'name' => __( 'Vorname', 'mitarbeiterverwaltung' ), 'type' => 'text' ),
		array( 'id' => 'employee_lastname', 'name' => __( 'Nachname', 'mitarbeiterverwaltung' ), 'type' => 'text' ),
		array( 'id' => 'employee_street', 'name' => __( 'Strasse', 'mitarbeiterverwaltung' ), 'type' => 'text' ),
		array( 'id' => 'employee_plz', 'name' => __( 'PLZ', 'mitarbeiterverwaltung' ), 'type' => 'text' ),
		array( 'id' => 'employee_place', 'name' => __( 'Ort', 'mitarbeiterverwaltung' ), 'type' => 'text' ),
		array( 'id' => 'employee_email', 'name' => __( 'Email', 'mitarbeiterverwaltung' ), 'type' => 'text' ),
		array( 'id' => 'employee_phone', 'name' => __( 'Telefon', 'mitarbeiterverwaltung' ), 'type' => 'text' ),
		array( 'id' => 'employee_birthdate', 'name' => __( 'Geburtsdatum (mm/dd/YYYY)', 'mitarbeiterverwaltung' ), 'type' => 'date' ),
		array(
			'id'   => 'employee_remarkfield',
			'name' => __( 'Bemerkungen', 'mitarbeiterverwaltung' ),
			'type' => 'textarea'
		),
	);
	// Meta-Felder erstellen
	$employeeCompany_details = array(
		array( 'id' => 'company_information', 'name' => __( 'Firmenbezogene Angaben', 'mitarbeiterverwaltung' ), 'type' => 'title' ),
		array( 'id' => 'employee_employmentdate', 'name' => __( 'Anstellungsdatum (mm/dd/YYYY)', 'mitarbeiterverwaltung' ), 'type' => 'date' ),
		array( 'id' => 'employee_location', 'name' => __( 'Arbeitsstandort', 'mitarbeiterverwaltung' ), 'type' => 'text' ),
	);
	// Metabox erstellen und Meta.Felder hinzufügen
	$meta_boxes[] = array(
		'title'  => __( 'Mitarbeiter Details', 'mitarbeiterverwaltung' ),
		'pages'  => 'cpt_employee',
		'fields' => $employee_details
	);
	// Metabox erstellen und Meta.Felder hinzufügen
	$meta_boxes[] = array(
		'title'  => __( 'Firmen Details', 'mitarbeiterverwaltung' ),
		'pages'  => 'cpt_employee',
		'fields' => $employeeCompany_details
	);

	return $meta_boxes;

}

add_filter( 'cmb_meta_boxes', 'mb_metaboxes' );