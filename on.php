<?php 

$command = escapeshellcmd('on.py');
$output = shell_exec($command);
echo $output;

?>