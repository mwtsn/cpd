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
			$( '#excerpt' ).attr( 'disabled', 'disabled' ).css( 'background', '#eee' );
			$( '#post-formats-select input').attr( 'disabled', 'disabled' );
			$( '#categorydiv input').attr( 'disabled', 'disabled' );
			$( '#tagsdiv-post_tag input').attr( 'disabled', 'disabled' );
			$( '#postimagediv').hide();
			$( '#cpd_meta_box_evidence .cmb-delete-field').remove();
			$( '#cpd_meta_box_evidence .button.repeat-field').remove();

			setTimeout( function() {
				tinyMCE.get( 'content' ).getBody().setAttribute( 'contenteditable', false );
				$('#content-tmce').click();
				$('#content-html').remove();
				$( 'iframe#content_ifr' ).contents().find( 'html' ).css( 'background-color', '#eee' );
				$( 'iframe#content_ifr' ).contents().find( 'html *' ).css( 'background-color', 'transparent' );
				$( 'iframe#content_ifr' ).contents().find( 'html' ).css( 'font-style', 'italic' );
				$( 'iframe#content_ifr' ).contents().find( 'html *' ).css( 'color', 'rgba(51,51,51,.5)' );
		}, 250);
		}
	});

})( jQuery );
