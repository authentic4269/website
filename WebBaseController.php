<?php

abstract class WebBaseController extends WebObject {

  private $request;

  private $pages = array(
    '/'            => 'Home',
    '/chapter'     => 'Chapter',
    '/calendar'    => 'Calendar',
    '/gallery'     => 'Gallery',
    '/brothers'    => 'Brothers',
    '/alumni'      => 'Alumni',
    '/recruitment' => 'Recruitment',
  );

  public function __construct($request) {
    $this->request = $request;
    parent::__construct();
  }

  protected function getHtmlTitle() {
    return $this->pages[$this->request];
  }

  private function getHtmlHeader() {
    return
      <head>
        <meta charset="utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
        <title>
          Delta Tau Delta | &Delta;&Tau;&Delta; Beta Omicron |
          Cornell University | {$this->getHtmlTitle()}
        </title>
        <meta
          name="description"
          content="Visit our site to learn more about Cornell Delts" />
        <meta name="viewport" content="width=device-width,initial-scale=1" />
        <link
          href="http://fonts.googleapis.com/css?family=Mate|Fjord+One"
          rel="stylesheet"
          type="text/css" />
        <link rel="stylesheet" href="/css/style.css" />
        <link
          rel="stylesheet"
          href="fancybox/source/jquery.fancybox.css?v=2.0.4"
          type="text/css" media="screen" />
        <script src="//ajax.googleapis.com/ajax/libs/jquery/1/jquery.min.js">
        </script>
      </head>;
  }

  private function renderTopLinks() {
    $tabs = <ul />;
    foreach ($this->pages as $key => $val) {
      if (!$this->isLoggedIn() && RequestRouter::isSecureRoute($key)) {
        continue;
      }
      $sel = $key == $this->request ? "selected" : "";
      $tabs->appendChild(
        <li class={$sel}>
          <a href={$key}>{$val}</a>
        </li>
      );
    }

    return $tabs;
  }

  private function getFooter() {
    return
      <footer>
        {WebAdController::showAd(1, 'amazon')}
        {WebAdController::showAd(0, 'amazon')}
        <h3 class="tcfp gold">Truth, Courage, Faith, Power</h3>
        Email: <a class="designer" href="mailto:delts@cornell.edu">
        delts@cornell.edu</a><br />
        {WebAdController::showAd(1, 'google')}
        &copy; Delta Tau Delta Beta Omicron {date("Y")}<br />
        Site made by <a href="http://wschurman.com" class="designer">
        William Schurman</a><br /><br />
        &#x21E1; &#x21E1; &#x21E3; &#x21E3; &#x21E0; &#x21E2; &#x21E0;
        &#x21E2; b a
        <div id="h8rz" style="display:none;">
          <div class="imgb"><img id="kitten" alt="meow" /></div>
        </div>
      </footer>;
  }
 
  /**
    * Renders the markup for a page, including the surrounding header and
    * footer.
    * @return string The markup for the page.
    */
  public function render() {
    $promo_bar = null;
    if (Config::PROMO_BAR) {
      $promo_bar =
        <div id="promobar">
          Check out our new Turntable.fm room
          <a href="http://turntable.fm/deltfm" class="button">Delt.fm</a>
        </div>;
    }

    return
      <x:doctype>
        <html lang="en">
          {$this->getHtmlHeader()}
          <body>
            {$promo_bar}
            <div id="container">
              <div class="header">
                {WebAdController::showAd('google', 1)}
                <a href="/" id="logo" class="pull-left"></a>
                <nav class="pull-right">
                  {$this->renderTopLinks()}
                </nav>
                <div class="clearfix"></div>
              </div>
              {$this->renderContent()}
              {$this->getFooter()}
            </div>
            <script src="js/plugins.js"></script>,
            <script src="fancybox/source/jquery.fancybox.pack.js?v=2.0.4">
            </script>
            <script src="js/script.js?v=1"></script>,
            <script src="js/analytics.js"></script>,
            <div id="fb-root"></div>,
            <script src="js/facebook.js"></script>,
          </body>
        </html>
      </x:doctype>;
  }

  /**
   * Renders the inner content markup for the page.
   * @return string The inner content markup.
   */
  abstract protected function renderContent();

}
