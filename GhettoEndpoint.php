<?php

class GhettoEndpoint extends AjaxEndpoint {

  /**
   * Returns the Gizoogled versions of the GET params.
   * @return string
   */
  public function getPayload() {
    $options = array(
      CURLOPT_RETURNTRANSFER => true,     // return web page
      CURLOPT_FOLLOWLOCATION => true,     // follow redirects
      CURLOPT_ENCODING       => "",       // handle all encodings
      CURLOPT_AUTOREFERER    => true,     // set referer on redirect
      CURLOPT_CONNECTTIMEOUT => 120,      // timeout on connect
      CURLOPT_TIMEOUT        => 120,      // timeout on response
      CURLOPT_MAXREDIRS      => 10,       // stop after 10 redirects
      CURLOPT_POST           => 1,
    );

    $url = 'http://www.gizoogle.net/textilizer.php';
    $curls = array();
    for ($i = 0; $i < count($_POST); $i++) {
      $curls[] = curl_init($url);
      $param = 'translatetext=' . urlencode($_POST[$i]);
      curl_setopt_array($curls[$i], $options);
      curl_setopt($curls[$i], CURLOPT_POSTFIELDS, $param);
    }

    $mh = curl_multi_init();
    foreach ($curls as $ch) {
      curl_multi_add_handle($mh, $ch);
    }

    $results = array();
    $running = NULL;
    do {
      curl_multi_exec($mh, $running);
    } while ($running > 0);

    for ($i = 0; $i < count($curls); $i++) {
      $matches = array();
      $rsp = curl_multi_getcontent($curls[$i]);
      preg_match('/<textarea.*>(.*?)<\/textarea>/', $rsp, $matches);

      $results[$i] = count($matches) < 2 ? "" : $matches[1];
    }

    foreach ($curls as $ch) {
      curl_multi_remove_handle($mh, $ch);
    }
    curl_multi_close($mh);

    return json_encode($results);
  }

}
