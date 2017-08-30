<?php
$tmp1=$_POST['param'];
list($d, $act, $oldStr, $newStr) = explode("##", $tmp1);
// $handler = fopen('newtmp.txt', 'w');
// fwrite($handler, $_POST['param']);
// fclose($handler);
$xfile = 'depart'.$d.'.js';
$lines = file($xfile, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
$handle = fopen($xfile, 'w');
$i=0;
foreach($lines as $v) {
		// echo $v."<br>";
		echo $lines[$i]."<br>";
		if (strtoupper($act)=="REPLACE") {
			if ($lines[$i] == $oldStr) {
				fwrite($handle, $newStr);
			} else {
				fwrite($handle, $lines[$i]);
			}
		}
		$i++;
}
fclose($handle);
?>