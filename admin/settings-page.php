<?php if ( ! defined( 'ABSPATH' ) ) exit; ?>
<?php $s = sb_settings(); ?>

<div class="wrap sb-wrap">
<h1><?php esc_html_e( 'Simply Branded', 'simply-branded' ); ?></h1>

<form method="post" action="">
<?php wp_nonce_field( 'sb_save', 'sb_nonce' ); ?>

<nav class="nav-tab-wrapper sb-tabs">
	<a href="#sb-tab-colors"     class="nav-tab nav-tab-active"><?php esc_html_e( 'Brand Colors',  'simply-branded' ); ?></a>
	<a href="#sb-tab-fonts"      class="nav-tab"               ><?php esc_html_e( 'Fonts',         'simply-branded' ); ?></a>
	<a href="#sb-tab-custom-css" class="nav-tab"               ><?php esc_html_e( 'Custom CSS',    'simply-branded' ); ?></a>
</nav>


<!-- ── BRAND COLORS ──────────────────────────────────────────────── -->
<div id="sb-tab-colors" class="sb-tab-panel">

	<?php sb_section_header( __( 'Brand Palette', 'simply-branded' ) ); ?>
	<p class="description" style="margin-bottom:20px"><?php esc_html_e( 'These five colors drive the entire site — sections, navigation, buttons, and links are all derived automatically.', 'simply-branded' ); ?></p>

	<?php sb_color_row( $s, 'light_neutral', __( 'Light Neutral', 'simply-branded' ),  __( 'Page background and light sections', 'simply-branded' ) ); ?>
	<?php sb_color_row( $s, 'dark_neutral',  __( 'Dark Neutral',  'simply-branded' ),  __( 'Dark sections and navigation background', 'simply-branded' ) ); ?>
	<?php sb_color_row( $s, 'brand1',        __( 'Brand Color 1', 'simply-branded' ),  __( 'Primary brand color — Brand 1 section background', 'simply-branded' ) ); ?>
	<?php sb_color_row( $s, 'brand2',        __( 'Brand Color 2', 'simply-branded' ),  __( 'Secondary brand color — Brand 2 section background. Leave empty to use Highlight.', 'simply-branded' ), true ); ?>
	<?php sb_color_row( $s, 'highlight',     __( 'Highlight',     'simply-branded' ),  __( 'Buttons, links, and section accents', 'simply-branded' ) ); ?>
	<?php sb_color_row( $s, 'highlight2',    __( 'Highlight 2',   'simply-branded' ),  __( 'Secondary accent — hover states. Leave empty to auto-darken Highlight.', 'simply-branded' ), true ); ?>

	<?php sb_section_header( __( 'Buttons &amp; Shapes', 'simply-branded' ) ); ?>

	<div style="display:flex;align-items:center;gap:16px;margin-bottom:12px">
		<label style="width:180px;font-weight:500"><?php esc_html_e( 'Button border radius', 'simply-branded' ); ?></label>
		<div style="display:flex;align-items:center;gap:6px">
			<input type="number" name="sb[border_radius]" value="<?php echo esc_attr( $s['border_radius'] ); ?>" min="0" max="100" style="width:70px">
			<span class="description">px &nbsp;(0 = square, 4–8 = rounded, 100 = pill)</span>
		</div>
	</div>

	<div style="display:flex;align-items:center;gap:16px;margin-bottom:12px">
		<label style="width:180px;font-weight:500"><?php esc_html_e( 'Button border width', 'simply-branded' ); ?></label>
		<div style="display:flex;align-items:center;gap:6px">
			<input type="number" name="sb[button_border_width]" value="<?php echo esc_attr( $s['button_border_width'] ); ?>" min="0" max="10" style="width:70px">
			<span class="description">px &nbsp;(0 = no border)</span>
		</div>
	</div>

	<?php sb_color_row( $s, 'button_border_color', __( 'Button border color', 'simply-branded' ), __( 'Leave empty to use the button background color', 'simply-branded' ), true ); ?>

</div><!-- #sb-tab-colors -->


<!-- ── FONTS ─────────────────────────────────────────────────────── -->
<div id="sb-tab-fonts" class="sb-tab-panel" style="display:none">

	<?php sb_section_header( __( 'Font Families', 'simply-branded' ) ); ?>
	<p class="description" style="margin-bottom:16px"><?php esc_html_e( 'Enter the exact font-family name as it appears in your font provider\'s embed code. Example: "Playfair Display"', 'simply-branded' ); ?></p>

	<?php sb_text_row( $s, 'font_display', __( 'Display font',  'simply-branded' ), __( 'Headings and titles', 'simply-branded' ) ); ?>
	<?php sb_text_row( $s, 'font_primary', __( 'Primary font',  'simply-branded' ), __( 'Body text and paragraphs', 'simply-branded' ) ); ?>
	<?php sb_text_row( $s, 'font_script',  __( 'Script font',   'simply-branded' ), __( 'Decorative accent font', 'simply-branded' ) ); ?>

	<?php sb_section_header( __( 'Font Loading', 'simply-branded' ) ); ?>

	<?php sb_text_row( $s, 'google_fonts_url', __( 'Font Stylesheet URL', 'simply-branded' ), 'https://fonts.googleapis.com/css2?family=...', __( 'Paste just the URL from the &lt;link href="…"&gt; embed code — not the whole tag. Works with Google Fonts, cdnfonts.com, or any CSS-based font service. Example: https://fonts.cdnfonts.com/css/berthold-city', 'simply-branded' ) ); ?>
	<?php sb_text_row( $s, 'typekit_id', __( 'Adobe Fonts Kit ID', 'simply-branded' ), 'abc1def', __( 'Enter only the kit ID — the short code in your embed URL: use.typekit.net/<strong>KITID</strong>.css. Not the full URL or tag.', 'simply-branded' ) ); ?>

	<div style="margin-top:16px">
		<label style="display:block;font-weight:500;margin-bottom:6px"><?php esc_html_e( 'Self-Hosted Font CSS', 'simply-branded' ); ?></label>
		<div style="background:#f0f6fc;border-left:4px solid #72aee6;padding:10px 14px;margin-bottom:12px;max-width:680px">
			<p style="margin:0 0 4px;font-weight:500"><?php esc_html_e( 'How this works:', 'simply-branded' ); ?></p>
			<ol style="margin:0;padding-left:20px">
				<li><?php esc_html_e( 'Click Upload Font File and select your font files (.woff2, .otf, .ttf).', 'simply-branded' ); ?></li>
				<li><?php esc_html_e( 'The @font-face code will appear automatically in the box below — weight and style are detected from the filename.', 'simply-branded' ); ?></li>
				<li><?php esc_html_e( 'Copy the font family name from the generated code and enter it in the Display, Primary, or Script font fields above.', 'simply-branded' ); ?></li>
				<li><?php esc_html_e( 'Click Save Brand Settings.', 'simply-branded' ); ?></li>
			</ol>
		</div>
		<div style="margin-bottom:8px">
			<button type="button" id="sb-font-upload" class="button"><?php esc_html_e( 'Upload Font File', 'simply-branded' ); ?></button>
		</div>
		<div id="sb-font-upload-notice" style="display:none;margin-bottom:8px;padding:8px 12px;background:#edfaef;border-left:4px solid #00a32a;max-width:680px">
			<span id="sb-font-upload-notice-text"></span>
			<strong><?php esc_html_e( ' Now copy the font family name from the code below and enter it in the Display, Primary, or Script font field above.', 'simply-branded' ); ?></strong>
		</div>
		<textarea id="sb-custom-font-css" name="sb[custom_font_css]" rows="8" style="width:100%;max-width:680px;font-family:monospace;font-size:12px"><?php echo esc_textarea( $s['custom_font_css'] ); ?></textarea>
	</div>

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

function sb_color_row( $s, $key, $label, $description = '', $optional = false ) {
	$value = isset( $s[ $key ] ) ? $s[ $key ] : '';
	echo '<div style="display:flex;align-items:flex-start;gap:16px;margin-bottom:14px">';
	echo '<div style="width:180px;padding-top:4px">';
	echo '<label style="font-weight:500;display:block">' . esc_html( $label );
	if ( $optional ) echo ' <span style="font-weight:400;color:#888;font-size:12px">' . esc_html__( '(optional)', 'simply-branded' ) . '</span>';
	echo '</label>';
	if ( $description ) echo '<span class="description" style="font-size:12px;line-height:1.3;display:block;margin-top:2px">' . esc_html( $description ) . '</span>';
	echo '</div>';
	echo '<input type="text" name="sb[' . esc_attr( $key ) . ']" value="' . esc_attr( $value ) . '" class="sb-color-picker" data-default-color="' . esc_attr( $value ) . '">';
	echo '</div>';
}

function sb_text_row( $s, $key, $label, $placeholder = '', $description = '' ) {
	$value = isset( $s[ $key ] ) ? $s[ $key ] : '';
	echo '<div style="margin-bottom:12px">';
	echo '<label style="display:block;font-weight:500;margin-bottom:4px">' . esc_html( $label ) . '</label>';
	echo '<input type="text" name="sb[' . esc_attr( $key ) . ']" value="' . esc_attr( $value ) . '" placeholder="' . esc_attr( $placeholder ) . '" style="width:100%;max-width:500px">';
	if ( $description ) echo '<p class="description" style="margin-top:4px">' . wp_kses( $description, [ 'strong' => [] ] ) . '</p>';
	echo '</div>';
}
