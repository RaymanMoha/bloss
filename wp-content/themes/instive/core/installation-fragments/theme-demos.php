<?php
/*
 * One Click Demo Import added
 * */
function instive_import_files() {
	$demo_content_installer = INSTIVE_REMOTE_CONTENT;

	return [
		[
			'import_file_name'           => 'Instive Demo',
			'import_file_url'            => $demo_content_installer . '/default/main.xml',
			'import_customizer_file_url' => $demo_content_installer . '/default/customizer.dat',
			'import_widget_file_url'     => $demo_content_installer . '/default/widgets.wie',
			'import_preview_image_url'   => $demo_content_installer . '/default/screenshot.png',
			'preview_url'                => INSTIVE_LIVE_URL
		],
		[
			'import_file_name'           => 'Instive Health Insurance Demo',
			'import_file_url'            => $demo_content_installer . '/health-insurance/main.xml',
			'import_customizer_file_url' => $demo_content_installer . '/health-insurance/customizer.dat',
			'import_widget_file_url'     => $demo_content_installer . '/health-insurance/widgets.wie',
			'import_preview_image_url'   => $demo_content_installer . '/health-insurance/screenshot.png',
			'preview_url'                => INSTIVE_LIVE_URL
		],
	];
}

add_action( 'pt-ocdi/import_files', 'instive_import_files' );

function instive_after_import( $selected_import ) {
	// Set homepage in imported demo
	$page_setup_array = [
		"Instive Demo" => [
			"slug" => "Home",
		]
	];

	// RevSlider import when importing the demo content.
	if ( class_exists( 'RevSliderSlider' ) ) {

		// Now you can use it!
		$slider_url_one = INSTIVE_REMOTE_CONTENT . '/default/slider/home-1.zip';
		$slider_url_two = INSTIVE_REMOTE_CONTENT . '/default/slider/home-2.zip';
		$slider_url_three = INSTIVE_REMOTE_CONTENT . '/default/slider/home-3.zip';
		$slider_url_four = INSTIVE_REMOTE_CONTENT . '/default/slider/home-4.zip';
		$slider_url_five = INSTIVE_REMOTE_CONTENT . '/default/slider/home-5.zip';
		$slider_url_six = INSTIVE_REMOTE_CONTENT . '/default/slider/home-6.zip';


		$sliders_array = array(
			download_url( $slider_url_one ),
			download_url( $slider_url_two ),
			download_url( $slider_url_three ),
			download_url( $slider_url_four ),
			download_url( $slider_url_five ),
			download_url( $slider_url_six )
		);

		$slider = new RevSlider();
		if(is_array( $sliders_array )) {
			foreach( $sliders_array as $filepath ) {
				$slider->importSliderFromPost( true, true, $filepath );
			}
		}
	}


	if ( is_array( $page_setup_array ) ) {
		foreach ( $page_setup_array as $i => $values ) {
			if ( $i === $selected_import['import_file_name'] ) {
				foreach ( $values as $key => $value ) {
					//Set Front page
					$page = get_page_by_title( $values['slug'] );
					if ( isset( $page->ID ) ) {
						update_option( 'page_on_front', $page->ID );
						update_option( 'show_on_front', 'page' );
					}
				}
			}
		}
	}

	// Set menu after demo import
	$primary_menu    = get_term_by( 'name', 'Primary Menu', 'nav_menu' );
	$footer_menu     = get_term_by( 'name', 'Footer Menu', 'nav_menu' );
	$sub_header_menu = get_term_by( 'name', 'Sub Header Menu', 'nav_menu' );
	set_theme_mod( 'nav_menu_locations', [
			'primary'    => $primary_menu->term_id,
			'footermenu' => $footer_menu->term_id,
			'submenu'    => $sub_header_menu->term_id,
		]
	);
}

add_action( 'pt-ocdi/after_import', 'instive_after_import' );

function demo_license_content() {
	?>
	<div class="license-wrap">
		<h2 class="license-title"><?php esc_html_e( 'Please Activate Your License', 'nuclear-txd' ); ?></h2>
		<div class="license-desc">
			<div class="notice-icon">
				<svg width="17" height="18" viewBox="0 0 17 18" fill="none" xmlns="http://www.w3.org/2000/svg">
					<path d="M8.27148 5.6001V9.80009" stroke="#FF7129" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
					<path d="M15.536 6.26402V11.736C15.536 12.632 15.056 13.464 14.28 13.92L9.52801 16.664C8.75201 17.112 7.792 17.112 7.008 16.664L2.256 13.92C1.48 13.472 1 12.64 1 11.736V6.26402C1 5.36802 1.48 4.53599 2.256 4.07999L7.008 1.336C7.784 0.888 8.74401 0.888 9.52801 1.336L14.28 4.07999C15.056 4.53599 15.536 5.36002 15.536 6.26402Z" stroke="#FF7129" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
					<path d="M8.27148 12.3599V12.4399" stroke="#FF7129" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
				</svg>
			</div>
			<p>
			<?php 
				echo instive_kses('In order to get regular update, support and demo content, you must activate the theme license. Please  <a href="'. admin_url('themes.php?page=license') .'">Goto License Page</a> and activate the theme license as soon as possible.	','instive');
			?>
			</p>
		</div>
	</div>
	<?php
}

function set_license_menu() {
	if ( theme_is_valid_license() ) {
		return;
	}

	remove_submenu_page('themes.php', 'one-click-demo-import');
	$page = isset( $_GET['page'] ) ? sanitize_text_field( $_GET['page'] ) : '';

	if ( 'one-click-demo-import' === $page ) {
		// wp_die('Sorry, you are not allowed to access this page', '');
		wp_redirect(admin_url("themes.php?page=license"));
	}

	add_submenu_page(
		'themes.php',
		'Demo Content Install',
		'Demo Content Install',
		'manage_options',
		'one-click-demo-import',
		'demo_license_content'
	);
}

add_action('admin_menu', 'set_license_menu', 999);
