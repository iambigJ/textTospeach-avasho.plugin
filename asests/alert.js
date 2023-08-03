

jQuery( document ).ready( function( $ ) {
    $( '.components-button' ).click( function( e ) {
        e.preventDefault();
        $.ajax({
            url: my_ajax_object.ajax_url,
            type: 'POST',
            data: {
                'action': my_ajax_object.action,
            },
            success: function( response ) {
                alert( 'Success: ' + response );
            },
            error: function( error ) {
                alert( 'Error: ' + error.responseText );
            },
        } );
    } );
} );