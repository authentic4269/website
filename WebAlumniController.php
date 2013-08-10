<?php

class WebAlumniController extends WebBaseController {

  /**
   * Renders the inner content markup for the page.
   * @return string The inner content markup.
   */
  protected function renderContent() {
    return
      <div id="main">
        <div class="content_left pull-left">
          <h1 class="gold">Alumni Relations</h1>
          <p>Beta Omicron prides itself on alumni relations and on encouraging
          the presence of alumni in the house at any opportunity in order to
          maintain a unity amongst different classes of Delt brothers.</p>
          <h2>Alumni Improvement Weekend</h2>
          <p>Alumni Improvement Weekend was a great success. Thanks to the hard
          work of both actives and alumni, Labor Day Weekend was a highly
          productive time in the Shelter. Thanks to our alumni, we have a brand
          new gym! - 104 Mary Anne Wood Drive has never looked so pristine.</p>
        </div>
        <div class="content_right pull-right">
          {WebEventsController::renderUpcomingEvents($this->mysqli)}
        </div>
      </div>;
  }

}
