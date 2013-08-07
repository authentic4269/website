<?php

require_once("global_header.php");

?>
<div id="main" role="main">
  <h1 class="gold">Calendar</h1>
  <div class="content_full calendar">
    <iframe
      src="http://www.google.com/calendar/embed?height=600&amp;wkst=1&amp;bgcolor=%2399c&amp;src=2hdfnb9k7p2d3bo1l4aqseo8vs%40group.calendar.google.com&amp;color=%23000&amp;ctz=America%2FNew_York"
      style="border-width:0 "
      width="940"
      height="600"
      frameborder="0"
      scrolling="no">
    </iframe>
    <? echo show_ad(0, 'google'); ?>
  </div>
</div>

<?php

require_once("global_footer.php");

?>