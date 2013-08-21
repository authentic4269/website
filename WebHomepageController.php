<?php

class WebHomepageController extends WebBaseController {

  private function renderMap() {
    $isrc = "http://maps.googleapis.com/maps/api/staticmap?center=Delta+Tau+" .
      "Delta,+Ithaca,+NY&zoom=12&size=600x120&maptype=roadmap&markers=" .
      "color:red|Delta+Tau+Delta,+Ithaca,+NY&sensor=false";

    $base = "http://maps.google.com/maps?f=q&amp;source=%s&amp;hl=en&amp;" .
      "geocode=&amp;q=Delta+Tau+Delta,+Ithaca,+NY&amp;aq=t&amp;sll=37.0625," .
      "-95.677068&amp;sspn=52.505328,85.429688&amp;vpsrc=6&amp;t=m" .
      "&amp;ie=UTF8&amp;hq=&amp;hnear=Delta+Tau+Delta,+Ithaca,+New+York+14850" .
      "&amp;ll=42.452405,-76.488791&amp;spn=0.030398,0.054932" .
      "&amp;z=14&amp;iwloc=A%s";

    $iframe_src = sprintf($base, "s_q", "&amp;output=embed");
    $iframe_href = sprintf($base, "embed", "");

    $iframe =
      <div id="mapbg">
        <iframe
          id="map_canvas"
          width="640"
          height="480"
          src={$iframe_src}>
        </iframe><br />
        <a
          href={$iframe_href}
          style="color:#ffffff;text-align:left">
          View Larger Map
        </a>
      </div>;

    return array(
      <p><a class="mapbtn" href="#"><img class="imgshad" src={$isrc} /></a></p>,
      $iframe,
    );
  }

  /**
   * Renders the inner content markup for the page.
   * @return string The inner content markup.
   */
  protected function renderContent() {
    $info =
      <div class="pull-left">
        <h2 class="gold">WELCOME!</h2>
        <p>Delta Tau Delta at Cornell is the premier fraternity for any man
          looking to have a great social experience, develop life long friends,
          and acquire a career after college. Our mission statement is
          &quot;Committed to Lives of Excellence&quot;.</p>
        <a href="/chapter" class="button">
          <strong>More Info &raquo;</strong>
        </a>
      </div>;

    $slider =
      <div class="theme-default">
        <div id="slider" class="nivoSlider">
          <img src="/img/slides/7.jpeg" alt="" />
          <img src="/img/slides/2.jpeg" alt="" />
          <img src="/img/slides/3.jpeg" alt="" />
          <img src="/img/slides/4.jpeg" alt="" />
          <img src="/img/slides/5.jpeg" alt="" />
          <img src="/img/slides/6.jpeg" alt="" />
        </div>
      </div>;

    list($map_image, $map_iframe) = $this->renderMap();

    $welcome =
      <div class="content_left pull-left">
        <h1 class="gold">Delts at Cornell</h1>
        <p>Welcome to the online headquarters for Delta Tau Delta at Cornell
        University!</p>
        <p>Our fraternity dedicates itself to improving the lives of Cornellians
        as well as the greater Ithaca community.</p>
        {$map_image}
        {WebAdController::showAd(0, 'amazon')}
      </div>;

    $signup_button =
      <a href="/recruitment" class="button">
        <strong class="txt">Sign Up Today!</strong><br />
        <small class="txt">Become a man of excellence</small>
      </a>;

    $like_button =
      <div
        class="fb-like"
        data-href="https://www.facebook.com/cornelldelts"
        data-send="true"
        data-width="280"
        data-show-faces="true"
        data-colorscheme="dark"
        data-font="arial">
      </div>;

    $like_overlay = null;
    if (isset($_GET['like'])) {
      $like_overlay =
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
        </div>;
    }

    return
      <div>
        <div id="main">
          <div id="featured">
            {$info}
            {$slider}
            <span id="clogo"></span>
          </div>
          {$welcome}
          <div class="content_right pull-right">
            {$signup_button}
            {WebEventsController::renderRushEvents($this->mysqli)}
            {$like_button}
          </div>
          {$map_iframe}
        </div>
        {WebEventsController::renderRushBlock($this->mysqli)}
        {$like_overlay}
      </div>;
  }
}
