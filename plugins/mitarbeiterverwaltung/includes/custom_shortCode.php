<?php
/**
 * File: custom_shortCode.php
 *
 * Description: -Es wird ein Shortcode generiert um alle Mitarbeiter einer bestimmten Kategorie auszugeben.
 *              -Es wird ein Shortcode generiert um jeden Mitarbeiter einzeln auszugeben.
 *              -Es wird das Archive Template definiert für beide Shortcodes
 *
 * Author: Marc Brühwiler <marc.bruehwiler@liip.ch>
 *
 * @package mitarbeiterverwaltung-ipa
 */

/**
 * Funktion für die Ausgabe von Mitarbeiter Gruppen
 *
 * @param $atts
 */
function mv_shortcode_employee_group( $atts ) {

	// Attribute aus dem Shortcode werden in Variablen geschrieben
	extract( shortcode_atts(
			array(
				'cat' => '',
			), $atts )
	);

	$args              = array();
	$args['post_type'] = 'cpt_employee';
	$args['tax_query'] = array(
		'relation' => 'AND',
		array(
			'taxonomy'         => 'employee_categories',
			'field'            => 'slug',
			'terms'            => array( $cat ),
			'include_children' => false,
			'operator'         => 'IN'
		),
	);


	//WordPress Query erstellen um alle Mitarbeiter auszulesen
	$the_query    = new WP_Query( $args );

	// Schleife um alle Mitarbeiter auszugeben
	while ( $the_query->have_posts() ) : $the_query->the_post();
		if ( '' === locate_template( 'archive-cpt_employee.php', true, false ) ) {
			include( __DIR__ . '/../templates/archive-cpt_employee.php' );
		}
	endwhile;

	// Setzt die Query-Daten wieder zurück auf das Original-Query
	wp_reset_postdata();

}

add_shortcode( 'employee-group', 'mv_shortcode_employee_group' );


/**
 * Funktion für die Ausgabe von einzelnen Mitarbeiter
 *
 * @param $atts
 */
function mv_shortcode_employee( $atts ) {

	extract( shortcode_atts(
			array(
				'id' => '',
			), $atts )
	);

	$args              = array();
	$args['post_type'] = 'cpt_employee';
	$args['p']         = $atts['id'];

	$the_query = new WP_Query( $args );

	while ( $the_query->have_posts() ) : $the_query->the_post();
		if ( '' === locate_template( 'archive-cpt_employee.php', true, false ) ) {
			include( __DIR__ . '/../templates/archive-cpt_employee.php' );
		}
	endwhile;

	wp_reset_postdata();

}

add_shortcode( 'employee', 'mv_shortcode_employee' );