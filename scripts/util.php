<?php

$root = "/var/www/CornellDelts/";

/**
 * Check that the script is being run from the command line, e.g.:
 * $ php ./scripts/blah.php
 * @return boolean Whether the execution is admissible.
 */
function verify_cli($name) {
  if (php_sapi_name() != 'cli') {
    return false;
  }
  if (!preg_match('/^\.\/scripts\/.+\.php$/', $name)) {
    return false;
  }
  return true;
}