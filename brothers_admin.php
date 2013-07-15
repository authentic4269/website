<?php
session_start();

if ($_SESSION["logged_in"] != true) {
  header("Location: ./login.php");
  die();
}

require_once("global_header.php");

$info = array();

$result = $mysqli->query("SELECT * FROM brothers ORDER BY o, year, name");
while($row = $result->fetch_assoc()) {
  if ($row["fbid"]) {
    $newimage = get_web_page(
      "https://graph.facebook.com/".$row["fbid"]."/picture?type=large");
    if ($row["image"] != $newimage) {
      $row["new_image"] = $newimage;
    }
  }
  $info[] = $row;
}

function render_bros($info) {
  $n = 0;

  foreach ($info as $bro) {
    $img = $bro["new_image"] == "" ? $bro["image"] : $bro["new_image"];
    if ($bro["fbid"] == "") {
      $link = "#";
    } else {
      $link = "http://www.facebook.com/people/@/".$bro["fbid"];
    }
    if ($n % 5 == 0) {
      echo "</tr><tr>";
    }

    if ($bro["new_image"] == "") {
      $update_link = "";
    } else {
      $update_link =
        "<a class='approve' href='update_bro.php?fbid=".$bro["fbid"] .
        "'>&#x2713;</a>";
    }

    echo 
      "<td><div class='cdiv'><div class='pimg'><a href='$link'>" .
      "<img src='$img' width='110px' /></a></div><br />" .
      "<span class='bname gold'><a href='$link'>".$bro['name']."</a></span>" .
      "<br /><span class='position'>".$bro['title']." ".$bro['year']."</span>" .
      "<br />".$update_link."</div></td>";
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
