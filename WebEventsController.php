<?php

class WebEventsController extends WebObject {

  private static function renderEvents($type, $mysqli) {
    $rush = $type == "Rush" ? 1 : 0;
    $events = array();
    $result = $mysqli->query(
      "SELECT title, DATE(time) as date, TIME(time) as time FROM events " .
      "WHERE rush = " . $rush . " ORDER BY time"
    );
    // Bucketize the events by date.
    while ($row = $result->fetch_assoc()) {
      if (array_key_exists($row['date'], $events)) {
        $events[$row['date']][] = $row;
      } else {
        $events[$row['date']] = array($row);
      }
    }

    $event_block = <ul />;
    foreach ($events as $day) {
      $day_block = <ul />;
      foreach ($day as $e) {
        $time = date('h:i:s A', strtotime($e['time']));
        $day_block->appendChild(
          <li>{$time}{': '}{$e['title']}</li>
        );
      }
      $date = date('l F j', strtotime($day['date']));
      $event_block->appendChild(
        <li>
          <strong class="gold">{$date}</strong>
          <br />
          {$day_block}
        </li>
      );
    }

    return
      <div>
        <h2 class="gold">{$type} Events</h2>
        {$event_block}
      </div>;
  }

  public static function renderUpcomingEvents($mysqli) {
    return self::renderEvents('Upcoming', $mysqli);
  }

  public static function renderRushEvents($mysqli) {
    if (!Config::IS_RUSH_WEEK) {
      return null;
    }

    return self::renderEvents('Rush', $mysqli);
  }

  public static function renderRushBlock($mysqli) {
    if (!Config::IS_RUSH_WEEK) {
      return null;
    }

    return
      <div id="rush_overlay" style="display:none">
        <h2>It&apos;s DELT RUSH WEEK!</h2>
        <p>Come check out the Delt House during one of our events:</p>
        {self::renderEvents('Rush', $mysqli)}
      </div>;
  }

}
