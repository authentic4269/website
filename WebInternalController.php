<?php

class WebInternalController extends WebBaseController {

  /**
   * Renders the inner content markup for the page.
   * @return string The inner content markup.
   */
  protected function renderContent() {
    $social_block = WebEventsController::renderSocialEvents($this->mysqli);

    $tools_block =
      <div class="tools">
        <h2 class="gold">Tools</h2>
        <ul>
          <li><a href="/calendar">Calendar</a></li>
        </ul>
      </div>;

    return
      <div class="main">
        <h1 class="gold">Internal Section</h1>
        <div class="content_left pull-left">
          {$tools_block}
        </div>
        <div class="content_right pull-right">
          {$social_block}
        </div>
      </div>;
  }

}
