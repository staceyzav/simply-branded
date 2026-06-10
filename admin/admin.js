jQuery( function( $ ) {

	// Colour pickers
	$( '.sb-color-picker' ).wpColorPicker();

	// Tab switching
	$( '.sb-tabs .nav-tab' ).on( 'click', function( e ) {
		e.preventDefault();
		var target = $( this ).attr( 'href' );

		$( '.sb-tabs .nav-tab' ).removeClass( 'nav-tab-active' );
		$( this ).addClass( 'nav-tab-active' );

		$( '.sb-tab-panel' ).hide();
		$( target ).show();
	} );

	// Font file uploader
	$( '#sb-font-upload' ).on( 'click', function( e ) {
		e.preventDefault();

		var frame = wp.media( {
			title:    'Upload Font File',
			button:   { text: 'Use this font' },
			multiple: true,
			library:  { type: [ 'font/woff2', 'font/woff', 'font/ttf', 'font/otf' ] }
		} );

		frame.on( 'select', function() {
			var attachments = frame.state().get( 'selection' ).toJSON();
			var snippets    = [];

			var weightMap = {
				'thin': 100, 'hairline': 100,
				'extralight': 200, 'ultralight': 200,
				'light': 300,
				'regular': 400, 'normal': 400, 'book': 400,
				'medium': 500,
				'semibold': 600, 'demibold': 600,
				'bold': 700,
				'extrabold': 800, 'ultrabold': 800,
				'black': 900, 'heavy': 900
			};

			attachments.forEach( function( a ) {
				var url      = a.url;
				var ext      = url.split( '.' ).pop().toLowerCase();
				var format   = { woff2: 'woff2', woff: 'woff', ttf: 'truetype', otf: 'opentype' }[ ext ] || ext;
				var basename = ( a.filename || url.split( '/' ).pop() ).replace( /\.[^.]+$/, '' );

				// Detect italic
				var isItalic = /italic|oblique/i.test( basename );

				// Detect weight from filename keywords
				var weight = 400;
				Object.keys( weightMap ).forEach( function( keyword ) {
					if ( new RegExp( '(?:^|[-_ ])' + keyword + '(?:$|[-_ ])', 'i' ).test( basename ) ) {
						weight = weightMap[ keyword ];
					}
				} );

				// Strip weight/style keywords to get the base family name
				var familyName = basename
					.replace( /[-_ ]?(thin|hairline|extralight|ultralight|light|regular|normal|book|medium|semibold|demibold|bold|extrabold|ultrabold|black|heavy|italic|oblique)/gi, '' )
					.replace( /[-_]/g, ' ' )
					.trim()
					.replace( /\s+/g, ' ' );

				snippets.push(
					"@font-face {\n" +
					"  font-family: '" + familyName + "';\n" +
					"  src: url('" + url + "') format('" + format + "');\n" +
					"  font-weight: " + weight + ";\n" +
					"  font-style: " + ( isItalic ? 'italic' : 'normal' ) + ";\n" +
					"}"
				);
			} );

			var $textarea = $( '#sb-custom-font-css' );
			var current   = $textarea.val().trim();
			$textarea.val( current ? current + '\n\n' + snippets.join( '\n\n' ) : snippets.join( '\n\n' ) );
		} );

		frame.open();
	} );

} );
