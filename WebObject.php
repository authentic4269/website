<?php

abstract class WebObject {

  protected $mysqli;

  public function __construct() {
    // Set the default timezone.
    date_default_timezone_set('America/New_York');

    $this->mysqli = new mysqli(
      Config::DB_HOST,
      Config::DB_USER,
      Config::DB_PASS,
      Config::DB_NAME
    );

    if (mysqli_connect_errno()) {
      error_log("DB connection error: " . mysqli_connect_errno());
    }

    $this->mysqli->set_charset("utf8");
  }

  protected function isLoggedIn() {
    return false;
  }

  protected function isAdmin() {
    return false;
  }

}
