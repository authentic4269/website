<?php

class Web404Controller extends WebBaseController {

  protected function getHtmlTitle() {
    return "Not Found";
  }

  /**
   * Renders the inner content markup for the page.
   * @return string The inner content markup.
   */
  protected function renderContent() {
    return
      <div id="main">
        <div class="content_left pull-left">
          <h1 class="gold">Page Not Found</h1>
          <p>Sorry, but the page you were trying to view does not exist. It
          looks like this was the result of either a mistyped address or an
          out-of-date link.</p>
        </div>
      </div>;
  }
}
