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

    return unserialize($rsp);
  }

  /**
   * Renders the inner content markup for the page.
   * @return string The inner content markup.
   */
  protected function renderContent() {
    $arr = $this->getPhotos();
    $gallery = <div class="content_ful center text_center" />;
    foreach ($arr['photos']['photo'] as $p) {
      $gallery->appendChild(
        <a
          class="fancybox"
          rel="gallery1"
          href={$p["url_l"]}
          title={$p["description"]["_content"]}>
          <img src={$p["url_s"]} height={150} />
        </a>
      );
    }
    $gallery->appendChild(
      <div class="clearfix"></div>
    );

    return <div id="main">{$gallery}</div>;
  }

}
