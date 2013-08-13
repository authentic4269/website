<?php

require_once('facebook/src/facebook.php');
require_once('xhp/php-lib/init.php');

function __autoload($class_name) {
  // Autoload the required PHP class.
  include $class_name . '.php';
}

$req = isset($_GET['req']) ? $_GET['req'] : null;

// Reroute invalid requests back to the homepage.
if (!$req) {
  error_log("An invalid request was received.");
  header("Location: /");
}

$router = new RequestRouter();

$controller = $router->route($req);

if ($controller instanceof WebBaseController) {
  echo $controller->render();
} else if ($controller instanceof AjaxEndpoint) {
  echo $controller->getPayload();
}
