// Configure Recaptcha.
var RecaptchaOptions = {
  theme : 'blackglass'
};

$(document).ready(function() {

  $('#submit').click(function() {
    var data = $('#ss-form').serialize();
    $.ajax({
      type: 'POST',
      url: '/submit_rec',
      data: data,
      dataType: 'html',
      success: function(reply) {
        $('#submit-result').html(reply);
        $("html, body").animate({ scrollTop: 0 }, 600);
        Recaptcha.reload();
      },
      error: function(obj, reply, ex) {
        $('#submit-result').html(reply);
        $("html, body").animate({ scrollTop: 0 }, 600);
      }
    });
  });

});
