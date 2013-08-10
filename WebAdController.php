<?php

class WebAdController {

  /**
   * Shows a random ad of type $type if $threshold is less than ADS_SWITCH
   * @param int the threshold for showing the ad
   * @param string the type of ad to show (e.g. amazon, google)
   * @return markup for ads
   */
  public static function showAd($threshold, $type) {
    if ($threshold >= Config::ADS_SWITCH) {
      return null;
    }

    $google_ads = array(
      array(
        'slot' => '1267708999',
        'width' => 728,
        'height' => 15,
      ),
      array(
        'slot' => '7915561872',
        'width' => 120,
        'height' => 600,
      ),
      array(
        'slot' => '8402671919',
        'width' => 468,
        'height' => 60,
      ),
      array(
        'slot' => '7322301678',
        'width' => 468,
        'height' => 60,
      ),
    );

    $amazon_ads = array(
      array(
        'slot' => 'http://rcm.amazon.com/e/cm?t=cornel-20&o=1&p=13&l=ur1' .
                  '&category=electronics&f=ifr',
        'width' => 468,
        'height' => 60,
      ),
      array(
        'slot' => 'http://rcm.amazon.com/e/cm?t=cornel-20&o=1&p=14&l=ur1' .
                  '&category=school&banner=01VZNG2ST81NJ10BNGR2&f=ifr',
        'width' => 160,
        'height' => 600,
      ),
      array(
        'slot' => 'http://rcm.amazon.com/e/cm?t=cornel-20&o=1&p=29&l=ur1' .
                  '&category=computers_accesories&banner=1BK9N3RQP7DBH29WRV02',
        'width' => 120,
        'height' => 600,
      ),
      array(
        'slot' => 'http://rcm.amazon.com/e/cm?t=cornel-20&o=1&p=14&l=ur1' .
                  '&category=school&banner=01VZNG2ST81NJ10BNGR2&f=ifr',
        'width' => 160,
        'height' => 600,
      ),
    );

    if ($type == 'google') {
      $i = rand(0, count($google_ads) - 1);
      $google_script =
        'google_ad_client = "ca-pub-0186606151188253";
        google_ad_slot = '.$google_ads[$i]['slot'].';
        google_ad_width = '.$google_ads[$i]['width'].';
        google_ad_height = '.$google_ads[$i]['height'].';';
      $ad =
        <span>
          <script type="text/javascript">
            {$google_script}
          </script>
          <script
            type="text/javascript"
            src="http://pagead2.googlesyndication.com/pagead/show_ads.js">
          </script>
        </span>;
    } else if ($type == 'amazon') {
      $i = rand(0, count($amazon_ads) - 1);
      $ad =
        <iframe
          src={$amazon_ads[$i]['slot']}
          width={$amazon_ads[$i]['width']}
          height={$amazon_ads[$i]['height']}
          scrolling="no"
          border="0"
          marginwidth="0"
          style="border:none;">
        </iframe>;
    }

    return
      <div class="advertisement">
        {$ad}
      </div>;
  }

}
