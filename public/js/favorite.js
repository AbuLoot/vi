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

		var address = window.location.origin + '/profiles/add-favorite';

		$.ajax({
			url: address,
			success: updateTagList
		});
	}

	function deleteFavorite(star) {
		console.log(star.data('id'));
	}

});