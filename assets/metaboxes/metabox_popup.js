jQuery(document).ready(function($) {
	// Function to add data to postmeta using the WordPress REST API
	function addToPostMeta(postId, metaKey, metaValue) {
		var data = {
			meta_key: metaKey,
			meta_value: metaValue,
		};

		$.ajax({
			url: '/wp-json/wp/v2/posts/' + 20 + '/meta',
			method: 'POST',
			data: data,

			success: function(response) {
				console.log('Postmeta added successfully:', response);
			},
			error: function(error) {
				console.error('Error adding postmeta:', error.responseText);
			}
		});
	}

	// Example usage:
	var postId = 20; // Replace with the actual post ID
	var metaKey = 'my_custom_meta_key'; // Replace with your desired meta key
	var metaValue = 'my_custom_meta_value'; // Replace with your desired meta value

	addToPostMeta(postId, metaKey, metaValue);
});