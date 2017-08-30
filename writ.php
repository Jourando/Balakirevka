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
// $handle = fopen($xfile, 'w');
$i=0;
$j=$i;
// $aStr;
$act=strtoupper($act);
foreach($lines as $v) {
		echo $act."<br>".$oldStr."<br>".$newStr."<br>";
		if ($act=="REPLACE") {
			if ($lines[$i] == "d".$d."[".$i."]='".$oldStr."';") {
				// fwrite($handle, "d".$d."[".$i."]='".$newStr."';\r\n");
				$aStr[] = "d".$d."[".$i."]='".$newStr."';\r\n";
			} else {
				// fwrite($handle, $lines[$i]."\r\n");
				$aStr[] = $lines[$i]."\r\n";
			}
		}
/*		if (($act=="BEFORE") || ($act=="AFTER")) {
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
*/
		if ($act=="BEFORE") {
			if ($lines[$i] == "d".$d."[".$i."]='".$oldStr."';") {
				$aStr[]="d".$d."[".$j."]='".$newStr."';\r\n";
				$aStr[]="d".$d."[".($j+1)."]='".$oldStr."';\r\n";
				$j=$j+1;
			} else {
				list($s1, $s2) = explode('[', $lines[$i]);
				list($s3, $s4) = explode(']', $s2);
				$aStr[]=$s1."[".$j."]".$s4."\r\n";
			}
		}
		if ($act=="AFTER") {
			if ($lines[$i] == "d".$d."[".$j."]='".$oldStr."';") {
				$aStr[]="d".$d."[".$j."]='".$oldStr."';\r\n";
				$aStr[]="d".$d."[".($j+1)."]='".$newStr."';\r\n";
				$j=$j+1;
			} else {
				list($s1, $s2) = explode('[', $lines[$i]);
				list($s3, $s4) = explode(']', $s2);
				$aStr[]=$s1."[".$j."]".$s4."\r\n";				
			}
		}
		$i=$i+1;
		$j=$j+1;
}
// fclose($handle);
$handle = fopen($xfile, 'w');
for ($i=0; $i<count($aStr); $i++) {
	fwrite($handle, $aStr[$i]);
}
fclose($handle);
// добавить MoveUp, MoveDwn, Erase, Create;
echo "done";
// откат
?>