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
$j=0;
$Ars = array();
$act=strtoupper($act);
foreach($lines as $v) {
		echo $act."<br>".$oldStr."<br>".$newStr."<br>".$lines[$i]."<br><hr>";
		if ($act=="REPLACE") {
			if ($lines[$i] == "d".$d."[".$i."]='".$oldStr."';") {
				$Ars[]="d".$d."[".$i."]='".$newStr."';\r\n";
			} else {
				$Ars[]=$lines[$i];
			}
		$i=$i+1;
		}
		if ($act=="BEFORE") {
			if ($lines[$i] == "d".$d."[".$i."]='".$oldStr."';") {				
				// fwrite($handle, "d".$d."[".$j."]='".$newStr."';\r\n");
				// fwrite($handle, "d".$d."[".($j+1)."]='".$oldStr."';\r\n");
				$Ars[]="d".$d."[".$i."]='".$newStr."';\r\n";
				$Ars[]="d".$d."[".($i+1)."]='".$oldStr."';\r\n";
			} else {
				$Ars[]=$lines[$i];  // индекс опять не тот же ж
									// и каунтер j опять надо!
			}
			$i=$i+1;
		}
		if ($act=="AFTER") {
			if ($lines[$i] == "d".$d."[".$j."]='".$oldStr."';") {
				// fwrite($handle, "d".$d."[".$j."]='".$oldStr."';\r\n");
				// fwrite($handle, "d".$d."[".($j+1)."]='".$newStr."';\r\n");
				// $j=$j+1;
				$Ars[]="d".$d."[".$i."]='".$oldStr."';\r\n";				
				$Ars[]="d".$d."[".($i+1)."]='".$newStr."';\r\n";
			} else {
				// list($s1, $s2) = explode('[', $xStr);
				// list($s3, $s4) = explode(']', $xStr);
				// $lines[$i]=$s1."[".$j."]".$s4;				
				// fwrite($handle, $lines[$i]."\r\n");
				$Ars[]=$lines[$i];
				// счетчик в JS-e получится кривым
			}
			$i=$i+1;
			// $j=$j+1;			
		}
}
// fclose($handle);
$handle = fopen($xfile, 'w');
for ($i=0; i<count($Ars); $i++) {
	fwrite($handle, $Ars[$i]);
}
fclose($handle);
// добавить MoveUp, MoveDwn, Erase, Create;
echo "done";
// rm
?>