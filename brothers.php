<?php

require_once("global_header.php");

$info = array();

$result = $mysqli->query(
  "SELECT *, (SELECT GROUP_CONCAT(title SEPARATOR ', ') FROM positions p ".
  "WHERE find_in_set(pid, b.title) > 0) as pos FROM brothers b ".
  "ORDER BY SUBSTRING_INDEX(title, ',', 1) * 1, year, name");
while($row = $result->fetch_assoc()) {
  $info[] = $row;
}

function render_bros($info) {
  $n = 0;

  foreach ($info as $bro) {
    // Try to load the cached image, and fallback to the FB image.
    if (file_exists('brothers/'.$bro["fbid"].'.jpg')) {
      $img = '/brothers/'.$bro["fbid"].'.jpg';
    } else {
      $img = $bro["image"] == ""
        ? "https://graph.facebook.com/".$bro["fbid"]."/picture?type=large"
        :  $bro["image"];
    }
    $link = $bro["fbid"] == ""
      ? "#"
      : "http://www.facebook.com/people/@/".$bro["fbid"];
    if ($bro["name"] == "You") {
      $link = "recruitment.php";
    }
    if ($n % 5 == 0) {
      echo "</tr><tr>";
    }
    echo
      "<td><div class='cdiv'><div class='pimg'><a href='$link'>" .
      "<img src='$img' width='110px' /></a></div><br />" .
      "<span class='bname gold'><a href='$link'>".$bro['name']."</a></span>" .
      "<br /><span class='position'>".$bro['pos']." ".$bro['year']."</span>" .
      "<br /></div></td>";
    $n++;
  }
}

?>
<div id="main" role="main">
  <div class="content_full center">
    <h1 class="gold">Current Brothers</h1>

    <table id="brothers" align="center">
      <tr>
        <? render_bros($info); ?>
      </tr>
    </table>
  </div>
</div>

<?php

require_once("global_footer.php");

?>
