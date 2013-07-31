<?php

require_once("global_header.php");

function get_years() {
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

function send_email() {
  $to = RUSH_CHAIR;
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

function verify_captcha() {
  $req = new HttpRequest(
    "http://www.google.com/recaptcha/api/verify",
    HttpRequest::METH_POST
  );
  $req->addPostFields(array(
    'privatekey' => CAPTCHA_PRI,
    'remoteip' => $_SERVER['REMOTE_ADDR'],
    'challenge' => $_POST['recaptcha_challenge_field'],
    'response' => $_POST['recaptcha_response_field'],
  ));

  $req->send();
  $response = explode("\n", $req->getResponseBody());

  return ($response[0] == "true");
}

?>
<div id="main" role="main">
  <div class="content_left pull-left">
  <?php if (ADS_SWITCH > 1): ?>
    <br />
    <script type="text/javascript"><!--
      google_ad_client = "ca-pub-0186606151188253";
      /* Delt5 */
      google_ad_slot = "7322301678";
      google_ad_width = 468;
      google_ad_height = 60;
      //-->
    </script>
    <script type="text/javascript"
      src="http://pagead2.googlesyndication.com/pagead/show_ads.js">
    </script>
  <?php endif; ?>
  <h1 class="gold">Recruitment</h1>
    <div class="purple-pull">
      <h2>Why Delt?</h2>
      <a href="./whydelt_curr.pdf">Click here to learn about the many advantages
        of becoming a Cornell Delt.</a>
      <span id="clogosm"></span>
    </div>
    <?php
      if (isset($_POST['submit']) && $_POST['submit'] == 'Submit') {
        if (verify_captcha()) {
          send_email();
          echo '<h2 class="gold">Thanks! The form was submitted.</h2>';
        } else {
          echo '<h2 class="gold">Incorrect CAPTCHA value entered.</h2>';
        }
      }
    ?>
    <h2 class="gold">Sign up for more information about Delta Tau Delta.</h2>
    <form
      action="<? echo $_SERVER['PHP_SELF'] ?>"
      method="POST"
      id="ss-form"
      style="position:relative;">
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
          <ul class="inputs-list">
          <? foreach (get_years() as $year) { ?>
          <li>
            <label>
              <input type="radio" name="year" value="<?php echo $year ?>">
              <span><?php echo $year ?></span>
            </label>
          </li>
          <? } ?>
          </ul>
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
        <script type="text/javascript">
          var RecaptchaOptions = {
            theme : 'blackglass'
          };
        </script>
        <script type="text/javascript"
          src="http://google.com/recaptcha/api/challenge?k=<?=CAPTCHA_PUB?>">
        </script>
      </div>
      <div class="actions">
        <input type="submit" name="submit" value="Submit" />
      </div>
      <?php if (ADS_SWITCH > 1): ?>
        <div style="position:absolute; right:0; top:0;">
          <iframe
            src="http://rcm.amazon.com/e/cm?t=cornel-20&o=1&p=29&l=ur1&category=computers_accesories&banner=1BK9N3RQP7DBH29WRV02&f=ifr"
            width="120"
            height="600"
            scrolling="no"
            border="0"
            marginwidth="0"
            style="border:none;"
            frameborder="0">
          </iframe>
        </div>
      <?php endif; ?>
    </form>
  </div>
  <div class="content_right pull-right">
    <?php
      include("upcoming_events.php");
      if (IS_RUSH_WEEK) include("rush_events.php");
    ?>
    <?php if (ADS_SWITCH > 1): ?>
    <br /><br />
    <iframe
      src="http://rcm.amazon.com/e/cm?t=cornel-20&o=1&p=14&l=ur1&category=school&banner=01VZNG2ST81NJ10BNGR2&f=ifr"
      width="160"
      height="600"
      scrolling="no"
      border="0"
      marginwidth="0"
      style="border:none;"
      frameborder="0">
    </iframe>
    <?php endif; ?>
  </div>
</div>

<?php

require_once("global_footer.php");

?>
