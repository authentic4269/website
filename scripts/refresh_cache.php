#!/usr/bin/php
<?php

/**
 * Refresh the cache of brothers photos to the current FB state.
 */

require_once('includes/config.php');
require_once('includes/util.php');
require_once('scripts/util.php');

if (!verify_cli($argv[0])) {
  die("Error: must run this script from the root directory.");
}

printf("Clearing cache.\n");
array_map('unlink', glob($root.'brothers/*'));

$result = $mysqli->query("SELECT * FROM brothers");
while($row = $result->fetch_assoc()) {
  if ($row["fbid"]) {
    $len = 70 - (strlen($row["name"]) + strlen($row["fbid"]));
    printf("%s (%s) %s ", $row["name"], $row["fbid"], str_repeat('.', $len));
    $errno = save_image($row["fbid"]);
    if ($errno == 0) {
      printf("OK\n");
    } else {
      printf("Failed (%d)\n", $errno);
    }
  }
}

printf("\nDone!\n");