<?php

require_once("global_header.php");

$params = array(
  'method'    => 'flickr.groups.pools.getPhotos',
  'group_id'  => '2184955@N22',
  'format'    => 'php_serial',
  'extras'    => 'url_sq, url_s, url_m, url_l, description'
);
$params['api_key'] = FLICKR_API_KEY;

$encoded_params = array();

foreach ($params as $k => $v){
  $encoded_params[] = urlencode($k).'='.urlencode($v);
}

$url = "http://api.flickr.com/services/rest/?".implode('&', $encoded_params);

$options = array(
  CURLOPT_RETURNTRANSFER => true,     // return web page
  CURLOPT_FOLLOWLOCATION => true,     // follow redirects
  CURLOPT_ENCODING       => "",       // handle all encodings
  CURLOPT_AUTOREFERER    => true,     // set referer on redirect
  CURLOPT_CONNECTTIMEOUT => 120,      // timeout on connect
  CURLOPT_TIMEOUT        => 120,      // timeout on response
  CURLOPT_MAXREDIRS      => 10,       // stop after 10 redirects
);

$ch = curl_init( $url );
curl_setopt_array( $ch, $options );
$rsp = curl_exec( $ch );
curl_close( $ch );

$arr = unserialize($rsp);

?>

<div id="main" role="main">
  <div class="content_full center text_center">
    <?php
      foreach($arr['photos']['photo'] as $p) {
        $m = $p["url_l"];
        $sq = $p["url_s"];
        $d = $p["description"]["_content"];
        echo "<a class='fancybox' rel='gallery1' href='$m' title='$d'>" .
          "<img src='$sq' alt='' height='150' /></a>";
      }
    ?>
    <div class="clearfix"></div>
  </div>
</div>

<?php

require_once("global_footer.php");

?>
