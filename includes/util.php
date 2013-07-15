<?php

function require_login() {
  if ($_SESSION["logged_in"] != true) {
    header("Location: ./login.php");
  }
}

/**
 * Follow the redirect at the brother's FB URL to their profile picture.
 * @return the true image URL.
 */
function get_web_page($url) {
  $options = array(
    CURLOPT_RETURNTRANSFER => true,     // return web page
    CURLOPT_HEADER         => true,     // return headers
    CURLOPT_FOLLOWLOCATION => true,     // follow redirects
    CURLOPT_ENCODING       => "",       // handle all encodings
    CURLOPT_NOBODY         => true,
    CURLOPT_AUTOREFERER    => true,     // set referer on redirect
    CURLOPT_CONNECTTIMEOUT => 120,      // timeout on connect
    CURLOPT_TIMEOUT        => 120,      // timeout on response
    CURLOPT_MAXREDIRS      => 10,       // stop after 10 redirects
  );

  $ch      = curl_init( $url );
  curl_setopt_array( $ch, $options );
  $content = curl_exec( $ch );
  $err     = curl_errno( $ch );
  $errmsg  = curl_error( $ch );
  $header  = curl_getinfo( $ch );
  curl_close( $ch );

  return $header["url"];
}

/**
 * Cache the brother's FB picture on the server so that if they delete it on FB
 * we can still show it.
 * @return boolean indicating whether it was successful.
 */
function save_image($fbid) {
  $image = get_web_page(
    "https://graph.facebook.com/".$fbid."/picture?type=large");

  $fp = fopen('/var/www/CornellDelts/brothers/'.$fbid.'.jpg', 'w');
  $options = array(
    CURLOPT_FILE    => $fp,
    CURLOPT_TIMEOUT => 5 * 60,
    CURLOPT_URL     => $image,
  );
  $ch = curl_init();
  curl_setopt_array($ch, $options);
  curl_exec($ch);
  fclose($fp);

  return curl_errno($ch);
}

@$mysqli = new mysqli($db_host, $db_user, $db_pass, $db_name);

if (mysqli_connect_errno()) {
  die('<h1>Could not connect to the database</h1>' .
      '<h2>Please try again after a few moments.</h2>');
}

$mysqli->set_charset("utf8");

?>
