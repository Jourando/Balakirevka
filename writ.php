<?php
$tmp1=$_POST['param'];
list($d, $act, $oldStr, $newStr) = explode("##", $tmp1);
$xfile = 'depart'.$d.'.js';
$lines = file($xfile, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
$handle = fopen($xfile, 'w');
$i=0;
foreach($lines as $v) {
		// echo $lines[$i]."<br>";
		if (strtoupper($act)=="REPLACE") {
			if ($lines[$i] == "d".$d."[".$i."]='".$oldStr."';") {
				fwrite($handle, "d".$d."[".$i."]='".$newStr."';\r\n");
			} else {
				fwrite($handle, $lines[$i]."\r\n");
			}
		}
		$i=$i+1;
}
fclose($handle);
?>