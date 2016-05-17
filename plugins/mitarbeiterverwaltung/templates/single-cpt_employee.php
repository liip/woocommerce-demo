<?php

get_header();

$birthdate      = get_post_meta( get_the_id(), 'employee_birthdate', true );
$employmentdate = get_post_meta( get_the_id(), 'employee_employmentdate', true );

?>
	<div class="mv-plugin">
		<div id="content" class="site-content">
			<div id="primary" class="content-area">
				<main id="main" class="site-main" role="main">
					<article class="page type-page status-publish hentry">
						<h1 class="single-employee-title"><span><?php echo esc_attr( get_post_meta( get_the_id(), 'employee_salutation', true ) ); ?></span>
							<span><?php echo esc_attr( get_post_meta( get_the_id(), 'employee_firstname', true ) ); ?></span>
							<span><?php echo esc_attr( get_post_meta( get_the_id(), 'employee_lastname', true ) ); ?></span></h1>

						<?php echo the_post_thumbnail( 'employee-image-single' ); ?>

						<dl class="employee-infos">
							<dt><?php _e( 'Kategorie', 'mitarbeiterverwaltung' ) ?></dt>
							<dd><?php echo strip_tags( get_the_term_list( get_the_ID(), 'employee_categories', '', ', ' ) ); ?></dd>
							<dt><?php _e( 'Strasse', 'mitarbeiterverwaltung' ) ?></dt>
							<dd><?php echo esc_attr( get_post_meta( get_the_id(), 'employee_street', true ) ); ?></dd>
							<dt><?php _e( 'PLZ', 'mitarbeiterverwaltung' ) ?></dt>
							<dd><?php echo esc_attr( get_post_meta( get_the_id(), 'employee_plz', true ) ); ?></dd>
							<dt><?php _e( 'Ort', 'mitarbeiterverwaltung' ) ?></dt>
							<dd><?php echo esc_attr( get_post_meta( get_the_id(), 'employee_place', true ) ); ?></dd>
							<dt><?php _e( 'E-Mail', 'mitarbeiterverwaltung' ) ?></dt>
							<dd><?php echo esc_attr( get_post_meta( get_the_id(), 'employee_email', true ) ); ?></dd>
							<dt><?php _e( 'Telefon', 'mitarbeiterverwaltung' ) ?></dt>
							<dd><?php echo esc_attr( get_post_meta( get_the_id(), 'employee_phone', true ) ); ?></dd>
							<dt><?php _e( 'Geburtsdatum', 'mitarbeiterverwaltung' ) ?></dt>
							<dd><?php echo strftime( '%d.%m.%Y', strtotime( $birthdate ) ) ?></dd>
							<dt><?php _e( 'Anstellungsdatum', 'mitarbeiterverwaltung' ) ?></dt>
							<dd><?php echo strftime( '%d.%m.%Y', strtotime( $employmentdate ) ) ?></dd>
							<dt><?php _e( 'Firmen Standort', 'mitarbeiterverwaltung' ) ?></dt>
							<dd><?php echo esc_attr( get_post_meta( get_the_id(), 'employee_location', true ) ); ?></dd>
						</dl>
						<p><?php echo esc_attr( get_post_meta( get_the_id(), 'employee_remarkfield', true ) ); ?></p>
					</article>
				</main>
			</div>
		</div>
	</div>


<?php

get_footer();