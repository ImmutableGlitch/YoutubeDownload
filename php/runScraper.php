<?php

// Receive video id array
$videoID = $_POST['id_list'];

// Run python script with array passed as argument
// Implode will split array into space separated string
// Example: python scraper.py id_1 id_2 id_3
// Store the results within $output
exec("python /var/www/html/py/scrape_youtube.py " . implode(' ',$videoID), $output);

// Print python results which are read by sender of POST data
// Which in this case is magic.js
foreach ($output as $link) {
    echo($link.",");
}

?>