<?php
header("Cache-Control: no-store, no-cache, must-revalidate");
header("Expires: " . date("r"));
$tmp1=$_POST['param'];
list($d, $act, $oldStr, $newStr) = explode("##", $tmp1);
$xfile = 'depart'.$d.'.js';
$lines = file($xfile, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
// chmod 0744 
if (!file_exists('oldata/'.$d)) { mkdir('oldata/'.$d, 0744, true); }
$newfile='oldata/'.$d.'/depart'.$d;
$f = scandir('oldata/'.$d);
$j=count($f)-1;
$newfile=$newfile."[".$j."]";
copy($xfile, $newfile);
$i=0;
$j=$i;
$act=strtoupper($act);
foreach($lines as $v) {
		echo $act."<br>".$oldStr."<br>".$newStr."<br>";
		if ($act=="REPLACE") {
			if ($lines[$i] == "d".$d."[".$i."]='".$oldStr."';") {
				$aStr[] = "d".$d."[".$i."]='".$newStr."';\r\n";
			} else {
				$aStr[] = $lines[$i]."\r\n";
			}
		}
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
		if ($act=="ERASE") {
			if ($lines[$i] == "d".$d."[".$j."]='".$oldStr."';") {
				// skip
				$j=$j-1;
			} else {
				list($s1, $s2) = explode('[', $lines[$i]);
				list($s3, $s4) = explode(']', $s2);
				$aStr[]=$s1."[".$j."]".$s4."\r\n";				
			}
		}
		$i=$i+1;
		$j=$j+1;
}
// объединить InsBefore и InsAfter, повыкидывать "\r\n" из предварит. сборок $aStr
$handle = fopen($xfile, 'w');
for ($i=0; $i<count($aStr); $i++) {
	if ($i>0) {
		list($p1, $p2) = explode("=", $aStr[$i]);
		// номер дата вид деят.	мероприятие[тип, наши/сторонние, название] место_проведения охват[тип, аудитория, зрители, выст/участники] проводящие[отдел, нач.отдел, ответств] орг-фин доп.информация
		list($n, $dt, $vd, $acType, $acOwner, $acName, $acPlace, $oType, $oAud, $oSeer, $oPrt, $hostDep, $hostHead, $hostLd, $fin, $adInfo) = explode("|", $p2);
		$n=" ".$i;
		$adInfo=str_replace("';\r\n", "", $adInfo);
		$a1 = array($n, $dt, $vd, $acType, $acOwner, $acName, $acPlace, $oType, $oAud, $oSeer, $oPrt, $hostDep, $hostHead, $hostLd, $fin, $adInfo);
		$aStr[$i]=$p1."='".join("|", $a1)."';\r\n";
	}
	fwrite($handle, $aStr[$i]);
}
fclose($handle);
// добавить MoveUp, MoveDwn, Create;
echo "done";
// отдать json?
?>