<?php
require_once("global_header.php");
?>
<div id="main" role="main">
  <div id="featured">
    <div class="pull-left">
      <h2 class="gold">WELCOME!</h2>
      <p>Delta Tau Delta at Cornell is the premier fraternity for any man
        looking to have a great social experience, develop life long friends,
        and acquire a career after college. Our mission statement is "Committed
        to Lives of Excellence".</p>
      <a href="chapter.php" class="button">
        <strong>More Info &raquo;</strong>
      </a>
    </div>
    <div class="theme-default">
      <div id="slider" class="nivoSlider">
        <img src="img/slides/7.jpeg" alt="" />
        <img src="img/slides/2.jpeg" alt="" />
        <img src="img/slides/3.jpeg" alt="" />
        <img src="img/slides/4.jpeg" alt="" />
        <img src="img/slides/5.jpeg" alt="" />
        <img src="img/slides/6.jpeg" alt="" />
      </div>
    </div>
    <span id="clogo"></span>
    <!--<span id="bgletters">&Delta;&Tau;&Delta;</span>-->
  </div>
  <div class="content_left pull-left">
    <h1 class="gold">Delts at Cornell</h1>
    <p>Welcome to the online headquarters for Delta Tau Delta at Cornell
      University!</p>
    <p>Our fraternity dedicates itself to improving the lives of Cornellians as
      well as the greater Ithaca community.</p>
    <p>
      <a class="mapbtn" href="#">
        <img class="imgshad"
          src="http://maps.googleapis.com/maps/api/staticmap?center=Delta+Tau+Delta,+Ithaca,+NY&zoom=12&size=600x120&maptype=roadmap&markers=color:red|Delta+Tau+Delta,+Ithaca,+NY&sensor=false" />
      </a>
    </p>
    <?php if (ADS_SWITCH > 0): ?><br />
      <iframe
        src="http://rcm.amazon.com/e/cm?t=cornel-20&o=1&p=13&l=ur1&category=textbooks&banner=1RQK7WBPFE6ANNRN0302&f=ifr"
        width="468"
        height="60"
        scrolling="no"
        border="0"
        marginwidth="0"
        style="border:none;"
        frameborder="0">
      </iframe>
    <?php endif; ?>
  </div>
  <div class="content_right pull-right">
    <a href="recruitment.php" class="button">
      <strong>Sign Up Today!</strong><br />
      <small>Become a man of excellence</small>
    </a>
    <?php if (IS_RUSH_WEEK) include("rush_events.php"); ?>
    <div
      class="fb-like"
      data-href="https://www.facebook.com/cornelldelts"
      data-send="true"
      data-width="280"
      data-show-faces="true"
      data-colorscheme="dark"
      data-font="arial">
    </div>
  </div>
  <div id="mapbg">
    <iframe
      id="map_canvas"
      width="640"
      height="480"
      frameborder="0"
      scrolling="no"
      marginheight="0"
      marginwidth="0"
      src="http://maps.google.com/maps?f=q&amp;source=s_q&amp;hl=en&amp;geocode=&amp;q=Delta+Tau+Delta,+Ithaca,+NY&amp;aq=t&amp;sll=37.0625,-95.677068&amp;sspn=52.505328,85.429688&amp;vpsrc=6&amp;t=m&amp;ie=UTF8&amp;hq=&amp;hnear=Delta+Tau+Delta,+Ithaca,+New+York+14850&amp;ll=42.455524,-76.503074&amp;spn=0.030398,0.054932&amp;z=15&amp;iwloc=A&amp;output=embed">
    </iframe><br />
    <a
      href="http://maps.google.com/maps?f=q&amp;source=embed&amp;hl=en&amp;geocode=&amp;q=Delta+Tau+Delta,+Ithaca,+NY&amp;aq=t&amp;sll=37.0625,-95.677068&amp;sspn=52.505328,85.429688&amp;vpsrc=6&amp;t=m&amp;ie=UTF8&amp;hq=&amp;hnear=Delta+Tau+Delta,+Ithaca,+New+York+14850&amp;ll=42.452405,-76.488791&amp;spn=0.030398,0.054932&amp;z=14&amp;iwloc=A"
      style="color:#ffffff;text-align:left">
        View Larger Map
    </a>
  </div>
</div>
<?php if (IS_RUSH_WEEK): ?>
<div id="rush_overlay" style="display:none">
  <h2>It's DELT RUSH WEEK!</h2>
  <p>Come check out the Delt House during one of our events:</p>
  <?php include("rush_events.php"); ?>
</div>
<?php elseif(isset($_GET['like'])): ?>
<div id="like_overlay">
  <div>
    <h2>Like this page!</h2>
    <a href="#" class="close x">x</a>
    <a href="#" class="close">Close this box</a><br />
    <div
      class="fb-like"
      data-href="https://www.facebook.com/cornelldelts"
      data-send="true"
      data-width="280"
      data-show-faces="true"
      data-font="arial">
    </div>
  </div>
</div>
<?php endif; ?>
<?php

require_once("global_footer.php");

?>