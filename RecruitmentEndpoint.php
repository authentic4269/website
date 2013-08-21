<?php

class RecruitmentEndpoint extends AjaxEndpoint {

  private function sendEmail() {
    $to = Config::RUSH_CHAIR;
    $from = "recruitment@cornelldelts.org";
    $subject = "CornellDelts.org Recruitment Submission";
    $headers = "From:" . $from . "\r\n";

    // Required to send HTML tags in email.
    $headers .= 'MIME-Version: 1.0' . "\r\n";
    $headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";

    $data = array(
      'Name'  => $_POST['entry_0_single'] . ' ' . $_POST['entry_1_single'],
      'Year'  => $_POST['year'],
      'NetID' => $_POST['entry_3_single'],
      'Phone' => $_POST['entry_4_single'],
      'Dorm'  => $_POST['entry_5_single'],
      'Room'  => $_POST['entry_6_single'],
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
   * Validates the form, dispatches the email, and renders the payload.
   * @return string The inner content markup.
   */
  public function getPayload() {
    if (!isset($_POST['recaptcha_challenge_field']) ||
        !isset($_POST['recaptcha_response_field'])) {
      return null;
    }

    if (!$this->verifyCaptcha()) {
      return <h2 class="gold txt">Incorrect CAPTCHA value entered.</h2>;
    }

    $this->sendEmail();

    return <h2 class="gold txt">Thanks! The form was submitted.</h2>;
  }

}
