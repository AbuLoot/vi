;$(document).ready(function() {

	function handleCategory() {
		var category = $(this);
		var address = window.location.href + '/?cat_id=' + category.val();

		$.ajax({
			url: address,
			success: updateTagList
		});

	}

	function updateTagList(tags) {
		var tagList = $('#tags');

		tagList.children().remove();
		tagList.multiselect('destroy');

		if( !tags.length ) {
			tagList.multiselect({numberDisplayed: 1});
			return;
		}

		$.each(tags, function() {	
			var child = $('<option value="' + this.id + '">' + this.title + '</option>');
			tagList.append(child);
		});

		tagList.multiselect({numberDisplayed: 1});
	}

	if( $('#category').length ) {
		$('#tags').multiselect({numberDisplayed: 1});
		$('#category').bind("change", handleCategory);
	}

	if( $('#category_tags').length ) {
		$('#category_tags').multiselect({numberDisplayed: 1});
	}

});