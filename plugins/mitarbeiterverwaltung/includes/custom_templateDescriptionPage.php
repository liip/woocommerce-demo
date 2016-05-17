<?php
/**
 * File: custom_templateDescriptionPage.php
 *
 * Description: -Fügt einen neuen Submenüpunkt beim Post-Type cpt_employee ein und fügt auf der neuen Seite Inhalt ein
 *
 * Author: Marc Brühwiler <marc.bruehwiler@liip.ch>
 *
 * @package mitarbeiterverwaltung-ipa
 */

/**
 * Erstellt den Submenüpunkt Anleitung im Hauptmenüpunkt Mitarbeiter (cpt_employee)
 */
function register_description() {
	add_submenu_page( 'edit.php?post_type=cpt_employee', __( 'Anleitung', 'mitarbeiterverwaltung' ), __( 'Anleitung', 'mitarbeiterverwaltung' ), 'manage_options', 'manual', 'description_content' );
}

add_action( 'admin_menu', 'register_description' );


function description_content() {
?>
	<div class="wrap">
		<h1><?php _e( 'Anleitung zur Template-Anpassung', 'mitarbeiterverwaltung' ); ?></h1>
		<p><?php _e( 'Dieses Plugin verwendet zwei standard Templates, eines für die Mitarbeiter-Archivseite und eines für die Mitarbeiter-Detailseite. Diese beiden Templates sind angepasst ans WordPress Twenty Fifteen Theme. ' . '</br>' . 'Verwendet ein Benutzer ein anderes Theme, wird die Mitarbeiterausgabe nicht korrekt angezeigt. Da im Theme die CSS Klassen fehlen. Um dieses Problem zu umgehen wird nachfolgend erklärt, wie schnell und einfach ein eigenes Template erstellt werden kann.', 'mitarbeiterverwaltung' ); ?></p>
		<p><?php _e( 'Das Mitarbeiterverwaltungs-Plugin ist so vorbereitet das die Templates einfach überschrieben werden können. Dazu muss im Theme Directory eine PHP Datei erstellt werden, die denselben Namen wie die Templates des Plugins aufweist.', 'mitarbeiterverwaltung' ); ?></p>

		<h3><?php _e( 'Wo ist das Theme Directory?', 'mitarbeiterverwaltung' ); ?></h3>
		<p><?php _e( 'Um ins Theme Directory zu gelangen, muss die WordPress Instanz geöffnet werden. Im Haupt-Directory von WordPress befindet sich ein Ordner Namens "wp-content". Darin gibt es einen Ordner Themes. ' . '</br>' . 'Im Themes Ordner öffnet man das gewünschte Theme und erstellt die neuen PHP Files im Hauptverzeichnis. (Beispiel Pfad: WordPress/wp-content/themes/twentyten/)', 'mitarbeiterverwaltung' ); ?></p>

		<h3><?php _e( 'Wie müssen die PHP Templates heissen?', 'mitarbeiterverwaltung' ); ?></h3>
		<p><?php _e( 'Es müssen folgende PHP Template Files erstellt werden: ' . '</br>' . '- "archive-cpt_employee.php" für die Archivseite der Mitarbeiter. ' . '</br>' . '- "single-cpt_employee.php" für die Detailseite eines Mitarbeiters.', 'mitarbeiterverwaltung' ); ?></p>

		<h3><?php _e( 'Inhalt der Templates', 'mitarbeiterverwaltung' ); ?></h3>
		<p><?php _e( 'Am Besten werden die beiden Templates aus dem Mitarbeiterverwaltungs-Plugin kopiert. Somit werden die Ausgaben des Plugin übernommen und es müssen nur noch die HTML Klassen angepasst werden.', 'mitarbeiterverwaltung' ); ?></p>

		<h3><?php _e( 'Styles der Templates', 'mitarbeiterverwaltung' ); ?></h3>
		<p><?php _e( 'Die neuen Templates lassen sich mit CSS einfach in dem im Theme enthaltenen "style.css" File stylen.', 'mitarbeiterverwaltung' ); ?></p>

	</div>
<?php
}