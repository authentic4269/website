<?php

class WebCalendarController extends WebBaseController {

  /**
   * Renders the inner content markup for the page.
   * @return string The inner content markup.
   */
  protected function renderContent() {
    $src = "http://www.google.com/calendar/embed?height=600&amp;wkst=1" .
      "&amp;bgcolor=%2399c&amp;src=2hdfnb9k7p2d3bo1l4aqseo8vs%40group." .
      "calendar.google.com&amp;color=%23000&amp;ctz=America%2FNew_York";

    return
      <div id="main">
        <h1 class="gold">Calendar</h1>
        <div class="content_full calendar">
          <iframe
            src={$src}
            style="border-width:0 "
            width="940"
            height="600">
          </iframe>
          {WebAdController::showAd(0, 'google')}
        </div>
      </div>;
  }

}
