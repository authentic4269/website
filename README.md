# Cornell Delta Tau Delta web site

This is the web site for Delta Tau Delta, Beta Omicron chapter at Cornell
University. It is live at <a href="http://cornelldelts.org">
http://cornelldelts.org</a>.

## Stack and Operation

This site is implemented in PHP. It uses
<a href="http://github.com/facebook/xhp">Facebook's XHP extension</a> to render
the markup for each page. The code is organized into a request router and
separate controllers for each page, as well as several endpoints that are
hit via AJAX POST requests. Data is stored on a MySQL backend. JavaScript and
<a href="https://github.com/jquery/jquery">jQuery</a> are used on the frontend.

## Contributors

* William Schurman
* Bryan Cuccioli
* Mitch Vogel
* Andy Wolfers
