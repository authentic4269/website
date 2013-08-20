<?php

class WebGalleryController extends WebBaseController {

  private function getPhotos() {
    $params = array(
      'method'    => 'flickr.groups.pools.getPhotos',
      'group_id'  => '2184955@N22',
      'format'    => 'php_serial',
      'extras'    => 'url_sq, url_s, url_m, url_l, description'
    );
    $params['api_key'] = Config::FLICKR_API_KEY;

    $encoded_params = array();

    foreach ($params as $k => $v){
      $encoded_params[] = urlencode($k).'='.urlencode($v);
    }

    $url = "http://api.flickr.com/services/rest/?";
    $url = $url.implode('&', $encoded_params);

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

    $photos = array();
    $response = unserialize($rsp);
    foreach ($response['photos']['photo'] as $p) {
      $photos[] = array(
        'url_l' => $p['url_l'],
        'url_m' => $p['url_m'],
        'description' => $p['description']['_content'],
        'width' => $p['width_m'],
        'height' => $p['height_m'],
      );
    }

    return $photos;
  }

  private function getLayout($photos) {
    $target_height = 300;
    $gallery_width = 800;
    $total_width = 0;
    foreach ($photos as $p) {
      $total_width += ($p['width'] / $p['height'] * $target_height);
    }
    $rows = floor($total_width / $gallery_width);

    $table = array();
    for ($i = 0; $i < count($photos); $i++) {
      $prev = $i == 0 ? 0 : $table[$i-1][0];
      $table[$i] = array($photos[$i]['width'] / $photos[$i]['height'] + $prev);
    }
    for ($i = 0; $i < $rows; $i++) {
      $table[0][$i] = $photos[0]['width'] / $photos[0]['height'];
    }
    for ($i = 1; $i < count($photos); $i++) {
      for ($j = 1; $j < $rows; $j++) {
        $list = array();
        for ($k = 0; $k < $i; $k++) {
          $list[] = array(max($table[$k][$j-1], $table[$i][0] - $table[$k][0]), $k);
        }
        list($table[$i][$j], $solution[$i-1][$j-1]) = min($list);
      }
    }

    $rows -= 2;
    $count = count($photos) - 1;
    $layout = array();
    while ($rows >= 0) {
      $row = array();
      for ($i = $solution[$count-1][$rows]+1; $i < $count + 1; $i++) {
        //$row[] = $photos[$i]['width'] / $photos[$i]['height'];
        $row[] = $photos[$i];
      }
      array_unshift($layout, $row);
      $count = $solution[$count-1][$rows];
      $rows--;
    }

    $row = array();
    for ($i = 0; $i < $count + 1; $i++) {
      //$row[] = $photos[$i]['width'] / $photos[$i]['height'];
      $row[] = $photos[$i];
    }
    array_unshift($layout, $row);

    return $layout;
    /*$idx = 0;
    $grid = array();
    foreach ($layout as $row) {
      $list = array();
      $ratio_sum = 0;
      foreach ($row as $p) {
        $ratio_sum += $photos[$idx]['width'] / $photos[$idx]['height'];
        $list[] = $photos[$idx++];
      }
     */
  }

  /**
   * Renders the inner content markup for the page.
   * @return string The inner content markup.
   */
  protected function renderContent() {
    $layout = $this->getLayout($this->getPhotos());
    $gallery = <div class="content_ful center text_center" />;
    foreach ($layout as $row) { foreach ($row as $p) {
      $gallery->appendChild(
        <a
          rel="gallery1"
          href={$p["url_l"]}
          title={$p["description"]}>
          <img src={$p["url_m"]} height={$p["height"]/1.5} width={$p["width"]/1.5} />
        </a>
      );
    } $gallery->appendChild(<br />); }
    $gallery->appendChild(
      <div class="clearfix"></div>
    );

    return <div id="main">{$gallery}</div>;
  }

}
