
// Max Length
$('#title_post').maxlength({
  threshold: 10,
  warningClass: "label label-success",
  limitReachedClass: "label label-danger"
});
$('#description').maxlength({
  alwaysShow: true,
  threshold: 10,
  warningClass: "label label-success",
  limitReachedClass: "label label-danger"
});

// Button Toggle
$('#fileinput-part').hide();

$('#btn-toggle').click(function(){
  var btn = $('#btn-toggle').text();
  if (btn !== ' Скрыть') {
    $('#btn-toggle').html('<i class="glyphicon glyphicon-minus"></i> Скрыть');
  } else {
    $('#btn-toggle').html('<i class="glyphicon glyphicon-plus"></i> Больше');
  };
  $('#fileinput-part').toggle();
});