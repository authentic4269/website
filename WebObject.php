<?php

abstract class WebObject {

  protected $mysqli;
  private $loggedIn;
  private $isAdmin;

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

    $facebook = new Facebook(array(
      'appId' => Config::FB_APP_ID,
      'secret' => Config::FB_APP_SECRET,
    ));
    if (!$facebook->getUser()) {
      $this->loggedIn = false;
      $this->isAdmin = false;
      return;
    }
    $profile = $facebook->api('/me', 'GET');

    $stmt = $this->mysqli->prepare(
      "SELECT admin FROM brothers WHERE (fbid = ? OR fbid = ?)"
    );
    $stmt->bind_param("ss", $profile['id'], $profile['username']);
    $stmt->execute();
    $stmt->bind_result($is_admin);
    $stmt->store_result();
    $this->loggedIn = $stmt->num_rows > 0;

    $stmt->fetch();
    $this->isAdmin = (bool)$is_admin;
    $stmt->close();
  }

  protected function isLoggedIn() {
    return $this->loggedIn;
  }

  protected function isAdmin() {
    return $this->isAdmin;
  }

}
