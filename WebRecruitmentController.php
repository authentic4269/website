<?php

class WebRecruitmentController extends WebBaseController {

  private function getYears() {
    $year = date('Y');
    // Get the number of days since the beginning of the year.
    $days = floor((time() - mktime(null, null, null, 1, 0, date("Y"))) / 86400);

    $years = array();

    if ($days < 31) {
      $years[] = $year;
    }
    $years[] = $year + 1;
    $years[] = $year + 2;
    $years[] = $year + 3;
    // Show the youngest year if we are past Oct. 15.
    if ($days > 288) {
      $years[] = $year + 4;
    }

    return $years;
  }

  private function sendEmail() {
    $to = Config::RUSH_CHAIR;
    $from = "recruitment@cornelldelts.org";
    $subject = "CornellDelts.org Recruitment Submission";
    $headers = "From:" . $from . "\r\n";

    // Required to send HTML tags in email.
    $headers .= 'MIME-Version: 1.0' . "\r\n";
    $headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";

    $data = array(
      'Name' => $_POST['entry_0_single'] . ' ' . $_POST['entry_1_single'],
      'Year' => $_POST['year'],
      'NetID' => $_POST['entry_3_single'],
      'Phone' => $_POST['entry_4_single'],
      'Dorm' => $_POST['entry_5_single'],
      'Room' => $_POST['entry_6_single'],
    );

    $message = "Someone filled out the recruitment form on cornelldelts.org.";
    foreach ($data as $k => $v) {
      $message .= '<br /><br /><b>' . $k . '</b>: ' . $v;
    }

    mail($to, $subject, $message, $headers);
  }

  private function verifyCaptcha() {
    $req = new HttpRequest(
      "http://www.google.com/recaptcha/api/verify",
      HttpRequest::METH_POST
    );
    $req->addPostFields(array(
      'privatekey'  => Config::CAPTCHA_PRI,
      'remoteip'    => $_SERVER['REMOTE_ADDR'],
      'challenge'   => $_POST['recaptcha_challenge_field'],
      'response'    => $_POST['recaptcha_response_field'],
    ));

    $req->send();
    $response = explode("\n", $req->getResponseBody());

    return ($response[0] == "true");
  }

  /**
   * Renders the inner content markup for the page.
   * @return string The inner content markup.
   */
  protected function renderContent() {

    $years = <ul class="inputs-list" />;
    foreach ($this->getYears() as $year) {
      $years->appendChild(
        <li>
          <label>
            <input type="radio" name="year" value={$year} />
            <span>{$year}</span>
          </label>
        </li>
      );
    }

    $captcha_uri = "http://google.com/recaptcha/api/challenge?k=" .
      Config::CAPTCHA_PUB;

    $form =
      <form id="ss-form" style="position:relative;">
        <div class="clearfix">
          <label for="errorInput">First Name</label>
          <div class="input">
            <input class="xlarge" name="entry.0.single" class="ss-q-short" />
          </div>
        </div>
        <div class="clearfix">
          <label for="errorInput">Last Name</label>
          <div class="input">
            <input class="xlarge" name="entry.1.single" class="ss-q-short" />
          </div>
        </div>
        <div class="clearfix">
          <label id="optionsRadio">Year</label>
          <div class="input">
            {$years}
          </div>
        </div>
        <div class="clearfix">
          <label for="errorInput">Net ID</label>
          <div class="input">
            <input class="xlarge" name="entry.3.single" class="ss-q-short" />
          </div>
        </div>
        <div class="clearfix">
          <label for="errorInput">Phone Number</label>
          <div class="input">
            <input class="xlarge" name="entry.4.single" class="ss-q-short" />
          </div>
        </div>
        <div class="clearfix">
          <label for="errorInput">Dorm</label>
          <div class="input">
            <input class="xlarge" name="entry.5.single" class="ss-q-short" />
          </div>
        </div>
        <div class="clearfix">
          <label for="errorInput">Room Number</label>
          <div class="input">
            <input class="xlarge" name="entry.6.single" class="ss-q-short" />
          </div>
        </div>
        <div class="clearfix input">
          <script type="text/javascript" src="js/recruitment.js"></script>
          <script type="text/javascript" src={$captcha_uri}></script>
        </div>
        <div class="actions">
          <input type="button" id="submit" value="Submit" />
        </div>
        {WebAdController::showAd(1, 'amazon')}
      </form>;

    return
      <div id="main">
        <div class="content_left pull-left">
          {WebAdController::showAd(1, 'google')}
          <h1 class="gold">Recruitment</h1>
          <div class="purple-pull">
            <h2>Why Delt?</h2>
            <a class="txt" href="./whydelt_curr.pdf">
              Click here to learn about the many advantages
              of becoming a Cornell Delt.
            </a>
            <span id="clogosm"></span>
          </div>
          <div id="submit-result"></div>
          <h2 class="gold">
            Sign up for more information about Delta Tau Delta.
          </h2>
          {$form}
        </div>
        <div class="content_right pull-right">
          {WebEventsController::renderRushEvents($this->mysqli)}
          {WebAdController::showAd(1, 'amazon')}
        </div>
      </div>;
  }

}
