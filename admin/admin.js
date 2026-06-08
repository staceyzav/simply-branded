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

} );
