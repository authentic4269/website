$(".approve").click(function() {
  var d = $(this);
  jQuery.get($(this).attr("href"), function(data) {
    d.hide();
    d.siblings('.pimg').find('img').src = data.new;
  });
});
