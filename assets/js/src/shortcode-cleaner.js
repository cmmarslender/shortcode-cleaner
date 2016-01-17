(function($, undefined) {
	if ( ShortcodeCleaner === undefined ) {
		return;
	}

	var $form = $( document.getElementById( 'shortcode-cleaner-form' )),
		$submit = $( document.getElementById( 'shortcode-submit' ) );

	$form.on( 'submit', function(e) {
		e.preventDefault();

		$submit.attr('disabled', true);

		var data = {
			action: ShortcodeCleaner.action,
			nonce: ShortcodeCleaner.nonce
		};

		$form.serializeArray().map(function(item) {
			if ( data[ item.name ] !== undefined ) {
				if ( typeof( data[ item.name ] ) === "string" ) {
					data[ item.name ] = [ data[ item.name ] ];
				}
				data[ item.name ].push( item.value );
			} else {
				data[ item.name ] = item.value;
			}
		});

		$.post(
			ajaxurl,
			data,
			function(response) {
				$submit.attr('disabled', false);

				if ( response.data !== undefined && response.data.message !== undefined ) {
					window.console.log( response.data.message );
				}
			}
		);

	});

})(jQuery);