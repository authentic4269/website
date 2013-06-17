<h2 class="gold">Rush Events</h2>
<ul>
  <?php
    foreach ($rush_events as $e) {
      echo "<li><strong class='gold'>".$e['date']."</strong><br />";
      echo "<ul>";
      foreach ($e['events'] as $event) {
        echo "<li>".$event['time'].": ".$event['title']."</li>";
      }
      echo "</ul></li>";
    }
  ?>
</ul>
