<?php
/**
 * File: custom_fieldValidation.php
 *
 * Description: -Validiert alle Felder
 *
 * Author: Marc Brühwiler <marc.bruehwiler@liip.ch>
 *
 * @package mitarbeiterverwaltung-ipa
 */


/**
 * - Diese Funktion wird bei speichern eines Beitrages aufgerufen und validiert die Pflicht sowie auch die Felder welche ein bestimmtes Format haben müssen
 * - Es wird eine Fehlermeldung erstellt für falsche E-Mail und Pflichtfeld nicht ausgefüllt
 *
 * @param $post_id Variable mit der ID des aktuellen Beitrages
 */
function mv_meta_box_save( $post_id ) {
	// Falls Revision oder Autosave läuft wird nicht geupdated
	if ( ( wp_is_post_revision( $post_id ) || wp_is_post_autosave( $post_id ) ) ) {
		return;
	}


	// Wenn der gespeicherte Beitrag nicht vom Typ 'Mitarbeiter' ist wird nicht weiter validiert
	if ( get_post_type( $post_id ) != 'cpt_employee' ) {
		return;
	}

	// Wenn der Status des Beitrags ein automatisch gespeicherter Entwurf ist wird nicht weiter validiert
	if ( get_post_status( $post_id ) === 'auto-draft' ) {
		return;
	}


	// Felder welche eine oder mehrere Validierungen benötigen
	$fields = array(
		'employee_email'          => array( __( 'Email', 'mitarbeiterverwaltung' ), 'required,email' ),
		'employee_firstname'      => array( __( 'Vorname', 'mitarbeiterverwaltung' ), 'required' ),
		'employee_lastname'       => array( __( 'Nachname', 'mitarbeiterverwaltung' ), 'required' ),
		'employee_street'         => array( __( 'Strasse', 'mitarbeiterverwaltung' ), 'required' ),
		'employee_plz'            => array( __( 'PLZ', 'mitarbeiterverwaltung' ), 'required' ),
		'employee_place'          => array( __( 'Ort', 'mitarbeiterverwaltung' ), 'required' ),
		'employee_phone'          => array( __( 'Telefon', 'mitarbeiterverwaltung' ), 'required' ),
		'employee_birthdate'      => array( __( 'Geburtsdatum', 'mitarbeiterverwaltung' ), 'required' ),
		'employee_employmentdate' => array( __( 'Anstellungsdatum', 'mitarbeiterverwaltung' ), 'required' ),
		'employee_location'       => array( __( 'Arbeitsstandort', 'mitarbeiterverwaltung' ), 'required' ),
	);


	foreach ( $fields as $field => $config ) {

		$value    = $_POST[ $field ][ key( $_POST[ $field ] ) ];
		$rule_arr = explode( ',', $config[1] );
		$i        = 1;

		foreach ( $rule_arr as $rule ) {
			$message = '';

			if ( $rule === 'email' ) {
				// wenn $value keine gültige E-Mail ist
				if ( ! is_email( $value ) ) {
					$message = $config[0] . __( ' Feld muss Email sein', 'mitarbeiterverwaltung' );
				}
			} elseif ( $rule === 'required' ) {
				// wenn $value leer ist
				if ( $value === '' ) {
					$message = $config[0] . __( ' Feld muss ausgefüllt werden', 'mitarbeiterverwaltung' );
				}
			}
			$i ++;

			if ( $message != '' ) {
				// WordPress Error-Meldung wird registriert
				add_settings_error(
					$field,
					$field . '-cmb-field-0',
					$message,
					'error'
				);
			}
		}

	}

	// Alle gesetzten Error-Meldungen werden für 30 sek in den Cache geschrieben
	set_transient( 'settings_errors', get_settings_errors(), 30 );

	// Der Aufgerufene Hook wird entfernt damit er nicht mehrmals aufgerufen wird
	remove_action( 'save_post', 'mv_meta_box_save' );
}


add_action( 'admin_notices', 'mv_show_admin_notices' );
add_action( 'save_post', 'mv_meta_box_save' );

/**
 * Gibt Error-Meldungen aus wenn welche im Cache vorhanden sind
 *
 */
function mv_show_admin_notices() {

	// Falls keine Meldungen vorhanden sind wird die Funktion hier abgebrochen
	if ( ! ( $errors = get_transient( 'settings_errors' ) ) ) {
		return;
	}

	// Array mit den Meldungen wird durchlaufen und formattiert
	$message = '<div id="acme-message" class="error below-h2"><p><ul>';
	foreach ( $errors as $error ) {
		$message .= '<li>' . $error['message'] . '</li>';
	}
	$message .= '</ul></p></div>';

	echo $message;

	// Löscht die im Cache gespeicherten Meldungen
	delete_transient( 'settings_errors' );

	// Der Aufgerufene Hook wird entfernt damit er nicht mehrmals aufgerufen wird
	remove_action( 'admin_notices', 'mv_show_admin_notices' );

}