<?php
/**
 * Plugin Name: Mitarbeiterverwaltung
 * Description: Plugin um Team-Mitglieder zu erfassen, zu Kategorisieren und auf einer oder mehreren Seiten auszugeben
 * Author: Marc Brühwiler<marc.bruehwiler@liip.ch>
 * Version: 1.0
 * Date: 15.04.2015
 */

require_once( 'includes/custom_postType.php' );
require_once( 'includes/custom_metaBoxes.php' );
require_once( 'includes/custom_adminColumns.php' );
require_once( 'includes/custom_taxonomie.php' );
require_once( 'includes/custom_shortCode.php' );
require_once( 'includes/custom_templateDescriptionPage.php' );

// WordPress Bildgrössen definieren
add_image_size( 'employee-image', 300, 200, true );
add_image_size( 'employee-image-single', 650, 400, true );


/**
 * Es wird überprüft ob das Plugin 'Custom-Meta-Boxes' von dem dieses Plugin abhängig ist bereits aktiviert wurde.
 * Wenn Ja lässt sich das Mitarbeiterverwaltungs Plugin Aktivieren, wenn nein wird eine Meldung mit dem Downloadlink angezeigt.
 */
function check_plugin_dependencies() {
	$mb_plugins         = get_option( 'active_plugins' );
	$mb_required_plugin = 'Custom-Meta-Boxes-master/custom-meta-boxes.php';

	if ( ! in_array( $mb_required_plugin, $mb_plugins ) ) {
		if ( function_exists( 'deactivate_plugins' ) ) {
			deactivate_plugins( 'mitarbeiterverwaltung/mitarbeiterverwaltung.php' );
		}

		wp_die( __( 'Achtung - Installieren Sie folgendes Plugin damit das Plugin "Mitarbeiterverwaltung" aktiviert werden kann! --> <a target="_blank" href="https://github.com/humanmade/Custom-Meta-Boxes">Zum Download</a>', 'mitarbeiterverwaltung' ) );
	}
}

add_action( 'admin_init', 'check_plugin_dependencies', 1 );

/**
 * WordPress Rewrite Rules beim aktvieren löschen damit sie neu aufgebaut werden
 */
function mv_rewrite() {
	cpt_employee();
	flush_rewrite_rules();
}

register_activation_hook( __FILE__, 'mv_rewrite' );


/**
 * Sprachdatei laden
 */
function mv_load_language() {
	load_plugin_textdomain( 'mitarbeiterverwaltung', false, dirname( plugin_basename( __FILE__ ) ) . '/languages' );
}

add_action( 'init', 'mv_load_language', 1 );


/**
 * Stylesheet einbinden
 */
function mv_styles() {
	wp_enqueue_style( 'customize', plugin_dir_url( __FILE__ ) . '/assets/css/customize.css' );
}

add_action( 'wp_enqueue_scripts', 'mv_styles' );