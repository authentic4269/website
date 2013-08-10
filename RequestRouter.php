<?php

class RequestRouter extends WebObject {

  public function __construct() {} // Do not create a MySQL connection.

  private static $routes = array(
    // Main controllers (the second item indicates whether login is required).
    '/'             => array('WebHomepageController',    false),
    '/alumni'       => array('WebAlumniController',      false),
    '/brothers'     => array('WebBrothersController',    false),
    '/calendar'     => array('WebCalendarController',    true),
    '/chapter'      => array('WebChapterController',     false),
    '/contact'      => array('WebContactController',     false),
    '/gallery'      => array('WebGalleryController',     false),
    '/recruitment'  => array('WebRecruitmentController', false),

    // Endpoints for AJAX requests.
    '/submit_rec'   => array('RecruitmentEndpoint',      false),
    '/update_bro'   => array('UpdateBrotherEndpoint',    true),
  );

  public static function isSecureRoute($route) {
    return self::$routes[$route][1];
  }

  /**
    * Routes a given web request to a controller.
    * @param string The requested URI.
    * @return WebObject An endpoint controller.
    */
  public function route($request) {
    $request = rtrim($request, '/'); // Remove all trailing slashes.
    if (!$request) {
      $request = '/';
    }

    if (array_key_exists($request, self::$routes)) {
      if (self::$routes[$request][1] && !$this->isLoggedIn()) {
        return new Web404Controller($request);
      } else {
        $controller = self::$routes[$request][0];
        return new $controller($request);
      }
    } else {
      // The request does not exist in the routes.
      return new Web404Controller($request);
    }   
  }
}
