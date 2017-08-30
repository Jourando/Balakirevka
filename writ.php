<?php
$handler = fopen('newtmp.txt', 'w');
fwrite($handler, $_POST['param']);
fclose($handler);
?>