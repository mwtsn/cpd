(function( $ ) {
	'use strict';

	jQuery(document).ready(function ($) {
		if (
			$( '#post_type' ).val() === 'page' ||
			$( '#post_type' ).val() === 'post' ||
			$( '#post_type' ).val() === 'ppd' ||
			$( '#post_type' ).val() === 'assessment'
		) {
			$( '#title' ).attr( 'disabled', 'disabled' );
			$( '#excerpt' ).attr( 'disabled', 'disabled' );
			$( '#post-formats-select input').attr( 'disabled', 'disabled' );
			$( '#categorydiv input').attr( 'disabled', 'disabled' );
			$( '#tagsdiv-post_tag input').attr( 'disabled', 'disabled' );
			$( '#postimagediv').hide();

			setTimeout( function() {
				tinyMCE.get( 'content' ).getBody().setAttribute( 'contenteditable', false );
				$('#content-tmce').click();
				$('#content-html').remove();
		}, 250);
		}
	});

})( jQuery );
