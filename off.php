<?php
$cmd = escapeshellcmd('/var/www/html/off.py');
$output = shell_exec($cmd);
echo "<pre>$output</pre>";
?>
