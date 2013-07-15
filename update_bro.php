<?php

require("./includes/config.php");
require("./includes/util.php");

require_login();

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

error_log("doing save image");
save_image($id);
error_log("save complete");

echo json_encode(array(
  'id' => $id,
  'new' => $newimage,
  'success' => true
));

?>