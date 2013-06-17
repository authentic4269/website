<?

require_once('./includes/config.php');

if (sizeof($events) > 0):
?>

<h2 class="gold">Upcoming Events</h2>
<ul>
  <?php

  foreach ($upcoming_events as $e) {
    echo "<li><strong>".$e['title']."</strong><br />".$e['date']."</li>";
  }

  ?>
</ul>

<?php endif; ?>