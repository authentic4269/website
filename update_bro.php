<?php

require("./includes/config.php");
require("./includes/util.php");

require_login();

function get_web_page( url)  {
  $options = array( 
    CURLOPT_RETURNTRANSFER => true,   // return web page 
    CURLOPT_HEADER         => true,   // return headers 
    CURLOPT_FOLLOWLOCATION => true,   // follow redirects 
    CURLOPT_ENCODING       => "",     // handle all encodings
    CURLOPT_NOBODY         => true,
    CURLOPT_AUTOREFERER    => true,   // set referer on redirect 
    CURLOPT_CONNECTTIMEOUT => 120,    // timeout on connect 
    CURLOPT_TIMEOUT        => 120,    // timeout on response 
    CURLOPT_MAXREDIRS      => 10,     // stop after 10 redirects
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

$mysqli->set_charset("utf8");

$stmt2 = $mysqli->prepare("UPDATE brothers SET image = ? WHERE fbid = ?");

$id = filter_var($_GET['fbid'], FILTER_SANITIZE_STRING);
if (!$id) {
  header("Location: ./brothers.php");
}

$newimage = get_web_page(
  "https://graph.facebook.com/".$id."/picture?type=large");
$stmt2->bind_param("ss", $newimage, $id);
$stmt2->execute();

$stmt2->close();

echo json_encode(array(
  'id' => $id,
  'new' => $newimage,
  'success' => true
));

?>