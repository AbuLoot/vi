;$(document).ready(function() {

	function handleCategory() {
		var category = $(this);
		var address = window.location.href + '/?cat_id=' + category.val();

		console.log(address);

		$.ajax({
			url: address,
			success: updateTagList
		});

	}

	function updateTagList(tags) {
		var tagList = $('#tags');

		tagList.children().remove();

		if( !tags.length ) {
			tagList.multipleSelect();
			return;
		}

		$.each(tags, function() {	
			var child = $('<option value="' + this.id + '">' + this.title + '</option>');
			tagList.append(child);
		});

		tagList.multipleSelect();
	}

	if( $('#category').length ) {
		$('#tags').multipleSelect();
		$('#category').bind("change", handleCategory);
	}

});