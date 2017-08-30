<?php
$tmp1=$_POST['param'];
list($d, $act, $oldStr, $newStr) = explode("##", $tmp1);
// $handler = fopen('newtmp.txt', 'w');
// fwrite($handler, $_POST['param']);
// fclose($handler);
$xfile = 'depart'.$d.'.js';
$lines = file($xfile, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
$i=0;
foreach($lines as $v) {
		echo $v."<br>";
}
?>