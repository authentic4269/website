$(window).load(function() {
  $('#slider').nivoSlider({
    effect: 'fade', // Specify sets like: 'fold,fade,sliceDown'
    animSpeed: 500, // Slide transition speed
    pauseTime: 7000, // How long each slide will show
    startSlide: 0, // Set starting Slide (0 index)
    directionNav: false, // Next & Prev navigation
    controlNav: false, // 1,2,3... navigation
    keyboardNav: true, // Use left & right arrows
    pauseOnHover: true, // Stop animation while hovering
    captionOpacity: 0.8, // Universal caption opacity
    prevText: 'Prev', // Prev directionNav text
    nextText: 'Next', // Next directionNav text
    beforeChange: function(){}, // Triggers before a slide transition
    afterChange: function(){}, // Triggers after a slide transition
    slideshowEnd: function(){}, // Triggers after all slides have been shown
    lastSlide: function(){}, // Triggers when last slide is shown
    afterLoad: function(){} // Triggers when slider has loaded
  });
});

$(document).ready(function(){
  setTimeout('$("#promobar").slideDown(1000,"easeOutBounce")', 2500);

  $(".fancybox").fancybox({
    openEffect  : 'elastic',
    closeEffect : 'elastic',
    helpers : {
      title : {
        type : 'over'
      }
    }
  });

  if ($("#rush_overlay").length > 0) {
    var d = $("#rush_overlay");
    $.fancybox.open(d, {content:d, width:600, autoSize:false});
  }

  var a = false;
  var kkeys = [];
  var konami = "38,38,40,40,37,39,37,39,66,65";

  $(window).keydown(function(e) {
    kkeys.push( e.keyCode );
    if ( kkeys.toString().indexOf( konami ) >= 0 && !a ) {
      a = true;
      var w = Math.floor(Math.random() * 350) + 150;
      var h = Math.floor(Math.random() * 350) + 150;
      $("#kitten").attr("src", "http://placekitten.com/"+w+"/"+h);
      $("#h8rz").fadeIn(200); 
    } else if (e.keyCode == 27) {
      if (a) {
        $("#h8rz").fadeOut(200);
        $("#mapbg").fadeOut(200);
        a = false;
        kkeys = [];
      }
    }
  });
  
  $(".mapbtn").click(function() {
    $("#mapbg").fadeIn(200);    
  });
  $("#mapbg").click(function() {
    $("#mapbg").fadeOut(200);   
  });
  $("#like_overlay").click(function() {
    $("#like_overlay").fadeOut(200);
  });
  $("#like_overlay .close").click(function() {
   $("#like_overlay").fadeOut(200);
  });
  $("#h8rz").click(function() {
    $("#h8rz").fadeOut(200);
    a = false;
    kkeys = [];
  });

  $(".pimg img").load(function() {
    var imageHeight = $(this).height();
    $(this).attr("height", imageHeight);
    if (imageHeight < 85) {
      $(this).parent().parent().height(imageHeight);
    }
  });

  $(".cdiv").hover(function() {
    var h = $(this).children(".pimg").find("img").height();
    $(this).children(".pimg").animate({height:h});
  }, function() {
    if ($(this).children(".pimg").find("img").height() > 85) {
      $(this).children(".pimg").animate({height:"85px"});
    }
  });

  //When page loads...
  $(".tab_content").hide(); //Hide all content
  $("ul.tabs li:first").addClass("active").show(); //Activate first tab
  $(".tab_content:first").show(); //Show first tab content

  //On Click Event
  $("ul.tabs li").click(function() {
    $("ul.tabs li").removeClass("active"); //Remove any "active" class
    $(this).addClass("active"); //Add "active" class to selected tab
    $(".tab_content").hide(); //Hide all tab content

    // Find the href attribute value to identify the active tab + content
    var activeTab = $(this).find("a").attr("href");
    $(activeTab).fadeIn(); //Fade in the active ID content
    return false;
  });
});
