$(document).ready(function() {

  $('.approve').click(function(event) {
    var element = $(this);
    $.ajax({
      type: 'POST',
      url: '/update_bro',
      data: 'fbid=' + event.target.id,
      dataType: 'text',
      success: function(reply) {
        element.hide();
      }
    });
  });

});
