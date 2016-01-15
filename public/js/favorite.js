$(document).ready(function () {
	$('.favorite').click(function () {
		var star = $(this);

		if(star.hasClass('active')) {
			star.removeClass('active');
			deleteFavorite(star);
		} else {
			star.addClass('active');
			addFavorite(star);
		}

		return false;
	});

	function addFavorite(star) {
		var post_id = star.data('id');

		if(!post_id) return;

		var address = window.location.origin + '/profiles/add-favorite?post_id=' + post_id;

		$.ajax({
			url: address,
			success: function() {
				console.log('favorite added!');
			}
		});
	}

	function deleteFavorite(star) {
		var post_id = star.data('id');

		if(!post_id) return;

		var address = window.location.origin + '/profiles/delete-favorite?post_id=' + post_id;

		$.ajax({
			url: address,
			success: function() {
				console.log('favorite added!');
			}
		});
	}

});