<?php

class WebBrothersController extends WebBaseController {

  /**
   * Follow the redirect at the brother's FB URL to their profile picture.
   * @return the true image URL.
   */
  public static function getProfilePicture($fbid) {
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

    $url = "https://graph.facebook.com/".$fbid."/picture?type=large";

    $ch      = curl_init($url);
    curl_setopt_array($ch, $options);
    $content = curl_exec($ch);
    $err     = curl_errno($ch);
    $errmsg  = curl_error($ch);
    $header  = curl_getinfo($ch);
    curl_close( $ch );

    return $header["url"];
  }

  /**
   * Cache the brother's FB picture on the server so that if they delete it on
   * FB we can still show it.
   * @return int the curl errno (0 if success)
   */
  public static function saveImage($fbid) {
    $image = self::getProfilePicture($fbid);

    $fp = fopen(Config::ROOT.'/faces/'.$fbid.'.jpg', 'w');
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

  private function getBrothers() {
    $result = $this->mysqli->query(
      "SELECT *, (SELECT GROUP_CONCAT(title SEPARATOR ', ') FROM positions p ".
      "WHERE find_in_set(pid, b.title) > 0) as pos FROM brothers b ".
      "ORDER BY SUBSTRING_INDEX(title, ',', 1) * 1, year, name"
    );
    while ($row = $result->fetch_assoc()) {
      if ($this->isAdmin()) {
        $newimage = $this->getProfilePicture($row['fbid']);
        if ($row["image"] != $newimage) {
          $row["new_image"] = $newimage;
        } else {
          $row["new_image"] = "";
        }
      }
      $info[] = $row;
    }

    return $info;
  }

  /**
   * Renders the inner content markup for the page.
   * @return string The inner content markup.
   */
  protected function renderContent() {
    $info = $this->getBrothers();
    $nodes = array();

    foreach ($info as $bro) {
      // Try to load the cached image, and fallback to the FB image.
      $update_link = null;
      if ($this->isAdmin() && $bro["new_image"] != "") {
        $img = $bro["new_image"];
        $update_link = <a id={$bro['fbid']} class="approve">&#x2713;</a>;
      } else if (file_exists('faces/'.$bro["fbid"].'.jpg')) {
        $img = '/faces/'.$bro["fbid"].'.jpg';
      } else {
        $img = $bro["image"] == ""
          ? "https://graph.facebook.com/".$bro["fbid"]."/picture?type=large"
          : $bro["image"];
      }
      $link = $bro["fbid"] == ""
        ? "#"
        : "http://www.facebook.com/people/@/".$bro["fbid"];
      if ($bro["name"] == "You") {
        $link = "/recruitment";
      }
      $nodes[] =
        <div class="cdiv">
          <div class="pimg">
            <a href={$link}><img src={$img} width="110px" /></a>
          </div>
          <br />
          <span class="bname gold">
            <a href={$link}>{$bro['name']}</a>
          </span>
          <br />
          <span class="position txt">{$bro['pos'] . ' ' . $bro['year']}</span>
          <br />
          {$update_link}
        </div>;
    }

    $table = <table id="brothers" />;
    $row = <tr />;
    for ($node_idx = 0; $node_idx < count($nodes); $node_idx++) {
      if ($node_idx % 5 == 0 && $node_idx > 0) {
        $table->appendChild($row);
        $row = <tr />;
      }
      $row->appendChild(<td>{$nodes[$node_idx]}</td>);
    }
    $table->appendChild($row);

    return
      <div id="main">
        <script src="js/brothers.js"></script>
        <div class="content_full center">
          <h1 class="gold">Current Brothers</h1>
          {$table}
        </div>
      </div>;
  }

}
