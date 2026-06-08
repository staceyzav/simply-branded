<?php
/**
 * Plugin Name: Simply Branded
 * Plugin URI:  https://simplydesign.com
 * Description: Brand configuration for Simply Design sites. Set your brand palette once — every Simply plugin picks it up automatically via CSS tokens.
 * Author:      Simply Design
 * Author URI:  https://simplydesign.com
 * Version:     2.0.0
 * License:     GPL-2.0-or-later
 * Text Domain: simply-branded
 */

if ( ! defined( 'ABSPATH' ) ) exit;

define( 'SB_VERSION', '2.0.0' );
define( 'SB_OPTION',  'simply_branded' );

require_once plugin_dir_path( __FILE__ ) . 'includes/class-github-updater.php';
new Simply_GitHub_Updater( 'plugin', plugin_basename( __FILE__ ), 'staceyzav/simply-branded', SB_VERSION );

// ── Defaults ─────────────────────────────────────────────────────────

function sb_defaults() {
	return [
		// Brand palette
		'light_neutral'    => '#f5f5f5',
		'dark_neutral'     => '#1a1a1a',
		'brand1'           => '#2563eb',
		'brand2'           => '',
		'highlight'        => '#2563eb',
		'highlight2'       => '',

		// Buttons & shapes
		'border_radius'    => 0,

		// Fonts
		'font_display'     => '',
		'font_primary'     => '',
		'font_script'      => '',
		'google_fonts_url' => '',
		'typekit_id'       => '',

		// Custom CSS
		'custom_css'       => '',
	];
}

function sb_settings() {
	return wp_parse_args( get_option( SB_OPTION, [] ), sb_defaults() );
}

// ── CSS token output ──────────────────────────────────────────────────

add_action( 'wp_head', 'sb_output_css', 99 );
function sb_output_css() {
	$s = sb_settings();

	$light  = $s['light_neutral'];
	$dark   = $s['dark_neutral'];
	$brand1 = $s['brand1'];
	$brand2 = ! empty( $s['brand2'] ) ? $s['brand2'] : $s['highlight'];
	$hl     = $s['highlight'];
	$hl2    = ! empty( $s['highlight2'] ) ? $s['highlight2'] : sb_darken_hex( $hl, 15 );
	$radius = absint( $s['border_radius'] );

	$tokens = [
		// Page
		'--client-bg'                          => $light,
		'--client-text'                        => $dark,
		'--client-heading'                     => $dark,
		'--client-link'                        => $hl,
		'--client-link-hover'                  => $hl2,

		// Navigation
		'--client-nav-bg'                      => $dark,
		'--client-nav-text'                    => '#ffffff',
		'--client-nav-highlight'               => $hl,
		'--client-nav-highlight-text'          => '#ffffff',

		// Accent / Buttons
		'--client-accent'                      => $hl,
		'--client-accent-text'                 => '#ffffff',
		'--client-accent-hover'                => $hl2,
		'--client-accent-2'                    => ! empty( $s['highlight2'] ) ? $s['highlight2'] : $hl,

		// Shapes
		'--client-radius'                      => $radius . 'px',

		// Section — Dark
		'--client-section-dark-bg'             => $dark,
		'--client-section-dark-text'           => $light,
		'--client-section-dark-heading'        => '#ffffff',
		'--client-section-dark-highlight'      => $hl,

		// Section — Light
		'--client-section-light-bg'            => $light,
		'--client-section-light-text'          => $dark,
		'--client-section-light-heading'       => $dark,
		'--client-section-light-highlight'     => $hl,

		// Section — Brand 1
		'--client-section-brand1-bg'           => $brand1,
		'--client-section-brand1-text'         => '#ffffff',
		'--client-section-brand1-heading'      => '#ffffff',
		'--client-section-brand1-highlight'    => $light,

		// Section — Brand 2
		'--client-section-brand2-bg'           => $brand2,
		'--client-section-brand2-text'         => '#ffffff',
		'--client-section-brand2-heading'      => '#ffffff',
		'--client-section-brand2-highlight'    => $light,
	];

	if ( ! empty( $s['font_display'] ) ) $tokens['--client-font-display'] = $s['font_display'];
	if ( ! empty( $s['font_primary'] ) ) $tokens['--client-font-primary'] = $s['font_primary'];
	if ( ! empty( $s['font_script']  ) ) $tokens['--client-font-script']  = $s['font_script'];

	echo "<style id=\"simply-branded-tokens\">\n:root {\n";
	foreach ( $tokens as $var => $value ) {
		echo "\t" . esc_attr( $var ) . ': ' . esc_attr( $value ) . ";\n";
	}
	echo "}\n</style>\n";

	if ( ! empty( $s['custom_css'] ) ) {
		echo "<style id=\"simply-branded-custom\">\n" . wp_strip_all_tags( $s['custom_css'] ) . "\n</style>\n";
	}

	if ( ! empty( $s['google_fonts_url'] ) ) {
		echo '<link rel="preconnect" href="https://fonts.googleapis.com">' . "\n";
		echo '<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>' . "\n";
		echo '<link href="' . esc_url( $s['google_fonts_url'] ) . '" rel="stylesheet">' . "\n";
	}

	if ( ! empty( $s['typekit_id'] ) ) {
		echo '<script src="https://use.typekit.net/' . esc_attr( $s['typekit_id'] ) . '.js"></script>' . "\n";
		echo '<script>try{Typekit.load({async:true});}catch(e){}</script>' . "\n";
	}
}

// ── Helpers ───────────────────────────────────────────────────────────

function sb_darken_hex( $hex, $percent ) {
	$hex = ltrim( $hex, '#' );
	if ( strlen( $hex ) === 3 ) {
		$hex = $hex[0] . $hex[0] . $hex[1] . $hex[1] . $hex[2] . $hex[2];
	}
	$amount = round( 255 * $percent / 100 );
	$r = max( 0, hexdec( substr( $hex, 0, 2 ) ) - $amount );
	$g = max( 0, hexdec( substr( $hex, 2, 2 ) ) - $amount );
	$b = max( 0, hexdec( substr( $hex, 4, 2 ) ) - $amount );
	return sprintf( '#%02x%02x%02x', $r, $g, $b );
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

	$color_fields = [ 'light_neutral', 'dark_neutral', 'brand1', 'brand2', 'highlight', 'highlight2' ];
	$text_fields  = [ 'font_display', 'font_primary', 'font_script', 'google_fonts_url', 'typekit_id' ];
	$data         = [];

	foreach ( $color_fields as $key ) {
		$val = sanitize_hex_color( $_POST['sb'][ $key ] ?? '' );
		$data[ $key ] = $val ?: '';
	}

	foreach ( $text_fields as $key ) {
		$data[ $key ] = sanitize_text_field( wp_unslash( $_POST['sb'][ $key ] ?? '' ) );
	}

	$data['border_radius'] = absint( $_POST['sb']['border_radius'] ?? 0 );
	$data['custom_css']    = wp_strip_all_tags( wp_unslash( $_POST['sb']['custom_css'] ?? '' ) );

	// Required fields fall back to defaults if left blank
	$defaults = sb_defaults();
	foreach ( [ 'light_neutral', 'dark_neutral', 'brand1', 'highlight' ] as $required ) {
		if ( empty( $data[ $required ] ) ) {
			$data[ $required ] = $defaults[ $required ];
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
