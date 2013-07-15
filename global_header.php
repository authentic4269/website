<?php

session_start();

require("./includes/config.php");
require("./includes/util.php");

$pages = array(
  'index' => array('Home', './'),
  'chapter' => array('Chapter', 'chapter.php'),
  'gallery' => array('Gallery', 'gallery.php'),
  // 'calendar' => array('Calendar', 'calendar.php'),
  'brothers' => array('Brothers', 'brothers.php'),
  'alumni' => array('Alumni', 'alumni.php'),
  'recruitment' => array('Recruitment', 'recruitment.php'),
  //'contact' => array('Contact', 'contact.php'),
);

$curr = str_replace(".php", "", basename($_SERVER['SCRIPT_FILENAME']));

?>

<!doctype html>
<!--[if lt IE 7]> <html class="no-js ie6 oldie" lang="en"> <![endif]-->
<!--[if IE 7]>    <html class="no-js ie7 oldie" lang="en"> <![endif]-->
<!--[if IE 8]>    <html class="no-js ie8 oldie" lang="en"> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js" lang="en"> <!--<![endif]-->
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
  <title>Delta Tau Delta | &Delta;&Tau;&Delta; Beta Omicron | Cornell University | <?php echo $pages[$curr][0]; ?></title>
  <meta name="description" content="Visit our site to learn more about Cornell Delts - Rush Info, events calendar, and more!">
  <meta name="viewport" content="width=device-width,initial-scale=1">
  <link href='http://fonts.googleapis.com/css?family=Mate|Fjord+One' rel='stylesheet' type='text/css'>
  <link rel="stylesheet" href="css/style.css">
  <link rel="stylesheet" href="fancybox/source/jquery.fancybox.css?v=2.0.4" type="text/css" media="screen" />
</head>
<body>
  <?php if(ADS_SWITCH > 1): ?>
  <div id="sky_ad">
    <script type="text/javascript"><!--
    google_ad_client = "ca-pub-0186606151188253";
    /* Delts6 */
    google_ad_slot = "7915561872";
    google_ad_width = 120;
    google_ad_height = 600;
    //-->
    </script>
    <script type="text/javascript"
    src="http://pagead2.googlesyndication.com/pagead/show_ads.js">
    </script>
  </div>
  <?php endif; ?>
  <?php
  if (PROMO_BAR):
  ?>
  <div id="promobar">
    Check out our new Turntable.fm room
    <a href="http://turntable.fm/deltfm" class="button">Delt.fm</a>
  </div>
  <?php endif; ?>
  <div id="container">
    <header>
      <a href="./" id="logo" class="pull-left"></a>
      <nav class="pull-right">
        <ul>
          <?php
          foreach ($pages as $key => $val) {
            $name = $val[0];
            $link = $val[1];
            $sel = $curr == $key ? "selected" : "";
            echo "<li class='$sel'><a href='$link'>$name</a></li>\n";
          }
          ?>
        </ul>
      </nav>
      <div class="clearfix"></div>
    </header>
