<?php
$facts = file($_SERVER['DOCUMENT_ROOT']."/facts.txt", FILE_IGNORE_NEW_LINES);
echo $facts[array_rand($facts)];
?>
