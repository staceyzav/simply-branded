<?php if ( ! defined( 'ABSPATH' ) ) exit; ?>
<?php $s = sb_settings(); ?>

<div class="wrap sb-wrap">
<h1><?php esc_html_e( 'Simply Branded', 'simply-branded' ); ?></h1>

<form method="post" action="">
<?php wp_nonce_field( 'sb_save', 'sb_nonce' ); ?>

<nav class="nav-tab-wrapper sb-tabs">
	<a href="#sb-tab-branding"      class="nav-tab nav-tab-active"><?php esc_html_e( 'Branding',        'simply-branded' ); ?></a>
	<a href="#sb-tab-sections"      class="nav-tab"               ><?php esc_html_e( 'Section Colors',  'simply-branded' ); ?></a>
	<a href="#sb-tab-fonts"         class="nav-tab"               ><?php esc_html_e( 'Fonts',           'simply-branded' ); ?></a>
	<a href="#sb-tab-custom-css"    class="nav-tab"               ><?php esc_html_e( 'Custom CSS',      'simply-branded' ); ?></a>
</nav>


<!-- ── BRANDING ──────────────────────────────────────────────────── -->
<div id="sb-tab-branding" class="sb-tab-panel">

	<?php sb_section_header( __( 'Accent & Buttons', 'simply-branded' ) ); ?>
	<?php sb_color_row( $s, 'accent',     __( 'Accent color',       'simply-branded' ) ); ?>
	<?php sb_color_row( $s, 'accent_text', __( 'Accent text',        'simply-branded' ) ); ?>
	<?php sb_color_row( $s, 'accent_hover', __( 'Accent hover',      'simply-branded' ) ); ?>

	<?php sb_section_header( __( 'Page', 'simply-branded' ) ); ?>
	<?php sb_color_row( $s, 'bg',         __( 'Background',          'simply-branded' ) ); ?>
	<?php sb_color_row( $s, 'text',       __( 'Body text',           'simply-branded' ) ); ?>
	<?php sb_color_row( $s, 'heading',    __( 'Headings',            'simply-branded' ) ); ?>
	<?php sb_color_row( $s, 'link',       __( 'Links',               'simply-branded' ) ); ?>
	<?php sb_color_row( $s, 'link_hover', __( 'Links (hover)',       'simply-branded' ) ); ?>

	<?php sb_section_header( __( 'Navigation', 'simply-branded' ) ); ?>
	<?php sb_color_row( $s, 'nav_bg',             __( 'Nav background',   'simply-branded' ) ); ?>
	<?php sb_color_row( $s, 'nav_text',           __( 'Nav links',        'simply-branded' ) ); ?>
	<?php sb_color_row( $s, 'nav_highlight',      __( 'Nav highlight',    'simply-branded' ) ); ?>
	<?php sb_color_row( $s, 'nav_highlight_text', __( 'Nav highlight text','simply-branded' ) ); ?>

</div><!-- #sb-tab-branding -->


<!-- ── SECTION COLORS ────────────────────────────────────────────── -->
<div id="sb-tab-sections" class="sb-tab-panel" style="display:none">

	<?php sb_section_header( __( 'Dark Section (.is-dark)', 'simply-branded' ) ); ?>
	<?php sb_color_row( $s, 'dark_bg',        __( 'Background',  'simply-branded' ) ); ?>
	<?php sb_color_row( $s, 'dark_text',      __( 'Body text',   'simply-branded' ) ); ?>
	<?php sb_color_row( $s, 'dark_heading',   __( 'Headings',    'simply-branded' ) ); ?>
	<?php sb_color_row( $s, 'dark_highlight', __( 'Highlight',   'simply-branded' ) ); ?>

	<?php sb_section_header( __( 'Light Section (.is-light)', 'simply-branded' ) ); ?>
	<?php sb_color_row( $s, 'light_bg',        __( 'Background',  'simply-branded' ) ); ?>
	<?php sb_color_row( $s, 'light_text',      __( 'Body text',   'simply-branded' ) ); ?>
	<?php sb_color_row( $s, 'light_heading',   __( 'Headings',    'simply-branded' ) ); ?>
	<?php sb_color_row( $s, 'light_highlight', __( 'Highlight',   'simply-branded' ) ); ?>

	<?php sb_section_header( __( 'Brand 1 Section (.is-brand-1)', 'simply-branded' ) ); ?>
	<?php sb_color_row( $s, 'brand1_bg',        __( 'Background',  'simply-branded' ) ); ?>
	<?php sb_color_row( $s, 'brand1_text',      __( 'Body text',   'simply-branded' ) ); ?>
	<?php sb_color_row( $s, 'brand1_heading',   __( 'Headings',    'simply-branded' ) ); ?>
	<?php sb_color_row( $s, 'brand1_highlight', __( 'Highlight',   'simply-branded' ) ); ?>

	<?php sb_section_header( __( 'Brand 2 Section (.is-brand-2)', 'simply-branded' ) ); ?>
	<?php sb_color_row( $s, 'brand2_bg',        __( 'Background',  'simply-branded' ) ); ?>
	<?php sb_color_row( $s, 'brand2_text',      __( 'Body text',   'simply-branded' ) ); ?>
	<?php sb_color_row( $s, 'brand2_heading',   __( 'Headings',    'simply-branded' ) ); ?>
	<?php sb_color_row( $s, 'brand2_highlight', __( 'Highlight',   'simply-branded' ) ); ?>

</div><!-- #sb-tab-sections -->


<!-- ── FONTS ─────────────────────────────────────────────────────── -->
<div id="sb-tab-fonts" class="sb-tab-panel" style="display:none">

	<?php sb_section_header( __( 'Font Families', 'simply-branded' ) ); ?>
	<p class="description" style="margin-bottom:16px"><?php esc_html_e( 'Enter the exact font-family name as it appears in your font provider\'s embed code. Example: "Playfair Display"', 'simply-branded' ); ?></p>

	<?php sb_text_row( $s, 'font_display', __( 'Display font',  'simply-branded' ), __( 'Headings and titles', 'simply-branded' ) ); ?>
	<?php sb_text_row( $s, 'font_primary', __( 'Primary font',  'simply-branded' ), __( 'Body text and paragraphs', 'simply-branded' ) ); ?>
	<?php sb_text_row( $s, 'font_script',  __( 'Script font',   'simply-branded' ), __( 'Decorative accent font', 'simply-branded' ) ); ?>

	<?php sb_section_header( __( 'Font Loading', 'simply-branded' ) ); ?>

	<?php sb_text_row( $s, 'google_fonts_url', __( 'Google Fonts URL', 'simply-branded' ), __( 'Paste the full URL from fonts.google.com embed code', 'simply-branded' ) ); ?>
	<?php sb_text_row( $s, 'typekit_id',       __( 'Adobe Fonts Kit ID', 'simply-branded' ), __( 'The kit ID from use.typekit.net/KITID.js', 'simply-branded' ) ); ?>

</div><!-- #sb-tab-fonts -->


<!-- ── CUSTOM CSS ────────────────────────────────────────────────── -->
<div id="sb-tab-custom-css" class="sb-tab-panel" style="display:none">

	<?php sb_section_header( __( 'Custom CSS', 'simply-branded' ) ); ?>
	<p class="description" style="margin-bottom:12px"><?php esc_html_e( 'Added to every page after the token CSS. Use for client-specific overrides.', 'simply-branded' ); ?></p>
	<textarea name="sb[custom_css]" rows="20" style="width:100%;font-family:monospace;font-size:13px"><?php echo esc_textarea( $s['custom_css'] ); ?></textarea>

</div><!-- #sb-tab-custom-css -->


<?php submit_button( __( 'Save Brand Settings', 'simply-branded' ) ); ?>
</form>
</div><!-- .sb-wrap -->

<?php
function sb_section_header( $title ) {
	echo '<h2 style="margin:24px 0 12px;padding-bottom:8px;border-bottom:1px solid #ddd">' . esc_html( $title ) . '</h2>';
}

function sb_color_row( $s, $key, $label ) {
	$value = isset( $s[ $key ] ) ? $s[ $key ] : '';
	echo '<div style="display:flex;align-items:center;gap:16px;margin-bottom:12px">';
	echo '<label style="width:180px;font-weight:500">' . esc_html( $label ) . '</label>';
	echo '<input type="text" name="sb[' . esc_attr( $key ) . ']" value="' . esc_attr( $value ) . '" class="sb-color-picker" data-default-color="' . esc_attr( $value ) . '">';
	echo '</div>';
}

function sb_text_row( $s, $key, $label, $placeholder = '' ) {
	$value = isset( $s[ $key ] ) ? $s[ $key ] : '';
	echo '<div style="margin-bottom:12px">';
	echo '<label style="display:block;font-weight:500;margin-bottom:4px">' . esc_html( $label ) . '</label>';
	echo '<input type="text" name="sb[' . esc_attr( $key ) . ']" value="' . esc_attr( $value ) . '" placeholder="' . esc_attr( $placeholder ) . '" style="width:100%;max-width:500px">';
	echo '</div>';
}
