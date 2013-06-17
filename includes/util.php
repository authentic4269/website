<?php

function require_login() {
  if ($_SESSION["logged_in"] != true) {
    header("Location: ./login.php");
  }
}

?>
