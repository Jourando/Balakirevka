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
$j=$i;
$act=strtoupper($act);
foreach($lines as $v) {
		// echo $lines[$i]."<br>";
		if ($act=="REPLACE") {
			if ($lines[$i] == "d".$d."[".$i."]='".$oldStr."';") {
				fwrite($handle, "d".$d."[".$i."]='".$newStr."';\r\n");
			} else {
				fwrite($handle, $lines[$i]."\r\n");
			}
		}
		if (($act=="BEFORE") || ($act=="AFTER")) {
			if ($lines[$i] == "d".$d."[".$j."]='".$oldStr."';") {
					if ($act=="BEFORE") {
						fwrite($handle, "d".$d."[".$j."]='".$newStr."';\r\n");
						fwrite($handle, "d".$d."[".($j+1)."]='".$oldStr."';\r\n");
					} else {
						fwrite($handle, "d".$d."[".$j."]='".$oldStr."';\r\n");
						fwrite($handle, "d".$d."[".($j+1)."]='".$newStr."';\r\n");
					}
					$j=$j+1;
			} else {
				fwrite($handle, $lines[$i]."\r\n");
			}			
		}
		$i=$i+1;
		$j=$j+1;
}
fclose($handle);
// добавить MoveUp, MoveDwn, Erase, Create;
echo "done";
// rm
?>