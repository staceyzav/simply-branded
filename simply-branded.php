<?php
/**
 * Plugin Name: Simply Branded
 * Plugin URI:  https://simplydesign.com
 * Description: Brand configuration for Simply Design sites. Set your colors, fonts, and custom CSS once — every Simply plugin picks them up automatically via CSS tokens.
 * Author:      Simply Design
 * Author URI:  https://simplydesign.com
 * Version:     1.0.0
 * License:     GPL-2.0-or-later
 * Text Domain: simply-branded
 */

if ( ! defined( 'ABSPATH' ) ) exit;

define( 'SB_VERSION', '1.0.0' );
define( 'SB_OPTION',  'simply_branded' );

require_once plugin_dir_path( __FILE__ ) . 'includes/class-github-updater.php';
new Simply_GitHub_Updater( 'plugin', plugin_basename( __FILE__ ), 'staceyzav/simply-branded', SB_VERSION );

// ── Defaults ─────────────────────────────────────────────────────────

function sb_defaults() {
	return [
		// Accent / Buttons
		'accent'              => '#2563eb',
		'accent_text'         => '#ffffff',
		'accent_hover'        => '#1d4ed8',

		// Page
		'bg'                  => '#ffffff',
		'text'                => '#333333',
		'heading'             => '#111111',
		'link'                => '#2563eb',
		'link_hover'          => '#1d4ed8',

		// Navigation
		'nav_bg'              => '#ffffff',
		'nav_text'            => '#333333',
		'nav_highlight'       => '#2563eb',
		'nav_highlight_text'  => '#ffffff',

		// Section — Dark
		'dark_bg'             => '#1a1a1a',
		'dark_text'           => '#f0f0f0',
		'dark_heading'        => '#ffffff',
		'dark_highlight'      => '#2563eb',

		// Section — Light
		'light_bg'            => '#f5f5f5',
		'light_text'          => '#333333',
		'light_heading'       => '#111111',
		'light_highlight'     => '#2563eb',

		// Section — Brand 1
		'brand1_bg'           => '#2563eb',
		'brand1_text'         => '#ffffff',
		'brand1_heading'      => '#ffffff',
		'brand1_highlight'    => '#ffffff',

		// Section — Brand 2
		'brand2_bg'           => '#1d4ed8',
		'brand2_text'         => '#ffffff',
		'brand2_heading'      => '#ffffff',
		'brand2_highlight'    => '#ffffff',

		// Fonts
		'font_display'        => '',
		'font_primary'        => '',
		'font_script'         => '',
		'google_fonts_url'    => '',
		'typekit_id'          => '',

		// Custom CSS
		'custom_css'          => '',
	];
}

function sb_settings() {
	return wp_parse_args( get_option( SB_OPTION, [] ), sb_defaults() );
}

// ── CSS token output ──────────────────────────────────────────────────

add_action( 'wp_head', 'sb_output_css', 5 );
function sb_output_css() {
	$s = sb_settings();

	$tokens = [
		'--client-accent'              => $s['accent'],
		'--client-accent-text'         => $s['accent_text'],
		'--client-accent-hover'        => $s['accent_hover'],
		'--client-bg'                  => $s['bg'],
		'--client-text'                => $s['text'],
		'--client-heading'             => $s['heading'],
		'--client-link'                => $s['link'],
		'--client-link-hover'          => $s['link_hover'],
		'--client-nav-bg'              => $s['nav_bg'],
		'--client-nav-text'            => $s['nav_text'],
		'--client-nav-highlight'       => $s['nav_highlight'],
		'--client-nav-highlight-text'  => $s['nav_highlight_text'],
		'--client-section-dark-bg'         => $s['dark_bg'],
		'--client-section-dark-text'       => $s['dark_text'],
		'--client-section-dark-heading'    => $s['dark_heading'],
		'--client-section-dark-highlight'  => $s['dark_highlight'],
		'--client-section-light-bg'        => $s['light_bg'],
		'--client-section-light-text'      => $s['light_text'],
		'--client-section-light-heading'   => $s['light_heading'],
		'--client-section-light-highlight' => $s['light_highlight'],
		'--client-section-brand1-bg'       => $s['brand1_bg'],
		'--client-section-brand1-text'     => $s['brand1_text'],
		'--client-section-brand1-heading'  => $s['brand1_heading'],
		'--client-section-brand1-highlight'=> $s['brand1_highlight'],
		'--client-section-brand2-bg'       => $s['brand2_bg'],
		'--client-section-brand2-text'     => $s['brand2_text'],
		'--client-section-brand2-heading'  => $s['brand2_heading'],
		'--client-section-brand2-highlight'=> $s['brand2_highlight'],
	];

	if ( ! empty( $s['font_display'] ) ) $tokens['--client-font-display'] = $s['font_display'];
	if ( ! empty( $s['font_primary'] ) ) $tokens['--client-font-primary'] = $s['font_primary'];
	if ( ! empty( $s['font_script']  ) ) $tokens['--client-font-script']  = $s['font_script'];

	echo "<style id=\"simply-branded-tokens\">\n:root {\n";
	foreach ( $tokens as $var => $value ) {
		echo "\t" . esc_attr( $var ) . ': ' . esc_attr( $value ) . ";\n";
	}
	echo "}\n</style>\n";

	// Custom CSS
	if ( ! empty( $s['custom_css'] ) ) {
		echo "<style id=\"simply-branded-custom\">\n" . wp_strip_all_tags( $s['custom_css'] ) . "\n</style>\n";
	}

	// Google Fonts
	if ( ! empty( $s['google_fonts_url'] ) ) {
		echo '<link rel="preconnect" href="https://fonts.googleapis.com">' . "\n";
		echo '<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>' . "\n";
		echo '<link href="' . esc_url( $s['google_fonts_url'] ) . '" rel="stylesheet">' . "\n";
	}

	// Adobe Fonts (Typekit)
	if ( ! empty( $s['typekit_id'] ) ) {
		echo '<script src="https://use.typekit.net/' . esc_attr( $s['typekit_id'] ) . '.js"></script>' . "\n";
		echo '<script>try{Typekit.load({async:true});}catch(e){}</script>' . "\n";
	}
}

// ── Admin menu ────────────────────────────────────────────────────────

add_action( 'admin_menu', 'sb_admin_menu' );
function sb_admin_menu() {
	add_theme_page(
		__( 'Simply Branded', 'simply-branded' ),
		__( 'Simply Branded', 'simply-branded' ),
		'manage_options',
		'simply-branded',
		'sb_admin_page'
	);
}

add_action( 'admin_enqueue_scripts', 'sb_admin_enqueue' );
function sb_admin_enqueue( $hook ) {
	if ( $hook !== 'appearance_page_simply-branded' ) return;
	wp_enqueue_style( 'wp-color-picker' );
	wp_enqueue_script( 'sb-admin', plugin_dir_url( __FILE__ ) . 'admin/admin.js', [ 'wp-color-picker', 'jquery' ], SB_VERSION, true );
}

// ── Settings save ─────────────────────────────────────────────────────

add_action( 'admin_init', 'sb_save_settings' );
function sb_save_settings() {
	if (
		! isset( $_POST['sb_nonce'] ) ||
		! wp_verify_nonce( $_POST['sb_nonce'], 'sb_save' ) ||
		! current_user_can( 'manage_options' )
	) return;

	$defaults = sb_defaults();
	$data     = [];

	foreach ( $defaults as $key => $default ) {
		if ( $key === 'custom_css' ) {
			$data[ $key ] = wp_strip_all_tags( wp_unslash( $_POST['sb'][ $key ] ?? '' ) );
		} elseif ( in_array( $key, [ 'google_fonts_url', 'typekit_id', 'font_display', 'font_primary', 'font_script' ], true ) ) {
			$data[ $key ] = sanitize_text_field( wp_unslash( $_POST['sb'][ $key ] ?? '' ) );
		} else {
			$data[ $key ] = sanitize_hex_color( $_POST['sb'][ $key ] ?? $default ) ?: $default;
		}
	}

	update_option( SB_OPTION, $data );
	add_action( 'admin_notices', function() {
		echo '<div class="notice notice-success is-dismissible"><p>' . __( 'Brand settings saved.', 'simply-branded' ) . '</p></div>';
	} );
}

// ── Admin page HTML ───────────────────────────────────────────────────

function sb_admin_page() {
	require_once plugin_dir_path( __FILE__ ) . 'admin/settings-page.php';
}
