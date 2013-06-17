<?php

require_once("global_header.php");

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
    <h2 class="gold">Sign up for more information about Delta Tau Delta.</h2>
    <form
      action="https://spreadsheets.google.com/formResponse?formkey=dGFfTUYxVXJlYnNFcTkzcUVNNHlpN0E6MA&amp;theme=0AX42CRMsmRFbUy1iOGYwN2U2Mi1hNWU0LTRlNjEtYWMyOC1lZmU4ODg1ODc1ODI&amp;ifq"
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
            <li>
              <label>
                <input type="radio" name="year" value="2014" class="ss-q-radio">
                <span>2014</span>
              </label>
            </li>
            <li>
              <label>
                <input type="radio" name="year" value="2013" class="ss-q-radio">
                <span>2013</span>
              </label>
            </li>
            <li>
              <label>
                <input type="radio" name="year" value="2012" class="ss-q-radio">
                <span>2012</span>
              </label>
            </li>
            <li>
              <label>
                <input type="radio" name="year" value="2011" class="ss-q-radio"> 
                <span>2011</span>
              </label>
            </li>
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
