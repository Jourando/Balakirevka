<?php
header("Cache-Control: no-store, no-cache, must-revalidate");
header("Expires: " . date("r"));
$tmp1=$_POST['param'];
list($d, $act, $oldStr, $newStr) = explode("##", $tmp1);
$xfile = 'depart'.$d.'.js';
$lines = file($xfile, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
// 0744
if (!file_exists('oldata/'.$d)) { mkdir('oldata/'.$d, 0744, true); }
$newfile='oldata/'.$d.'/depart'.$d;
$f = scandir('oldata/'.$d);
$j=count($f)-1;
$newfile=$newfile."[".$j."]";
copy($xfile, $newfile);
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
echo "done";
// rm
?>