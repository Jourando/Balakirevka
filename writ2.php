<?php
header("Cache-Control: no-store, no-cache, must-revalidate");
header("Expires: " . date("r"));
$tmp1=$_POST['param'];
list($act, $d, $oldStr, $newStr) = explode("##", $tmp1);
$xfile = 'depart'.str_pad($d, 4, "0", STR_PAD_LEFT).'.a';
$lines = file($xfile, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES); 
if (!file_exists('oldata/'.str_pad($d, 4, "0", STR_PAD_LEFT))) { mkdir('oldata/'.str_pad($d, 4, "0", STR_PAD_LEFT), 0744, true); }
$f=scandir('oldata/'.str_pad($d, 4, "0", STR_PAD_LEFT));
$j=count($f)-1;
$newfile='oldata/'.str_pad($d, 4, "0", STR_PAD_LEFT).'/depart'.str_pad($d, 4, "0", STR_PAD_LEFT).'['.str_pad($j, 4, "0", STR_PAD_LEFT).']';
echo $xfile." to ".$newfile;
copy($xfile, $newfile);
$i=0;
$j=$i;
$act=strtoupper($act);
foreach($lines as $v) {
		if ($act=="REPLACE") {
			if (trim($lines[$i]) == trim($oldStr)) {
				$aStr[] = $newStr;
			} else {
				$aStr[] = $lines[$i];
			}
		}
		if ($act=="BEFORE") {
			if (trim($lines[$i]) == trim($oldStr)) {
				$aStr[]=$newStr;
				$aStr[]=$oldStr;
				$j=$j+1;
			} else {
				$sArr = explode('|', $lines[$i]);
				$sArr[0]=$j;
				$aStr[]=join("|", $sArr);
			}
		}
		if ($act=="AFTER") {
			if (trim($lines[$i]) == trim($oldStr)) {
				$aStr[]=$oldStr;
				$aStr[]=$newStr;
				$j=$j+1;
			} else {
				$sArr = explode('|', $lines[$i]);
				$sArr[0]=$j;
				$aStr[]=join("|", $sArr);
			}
			// потом объединить Before и After
		}
		if ($act=="ERASE") {
			if (trim($lines[$i]) == trim($oldStr)) {
				// skip
				$j=$j-1;
			} else {
				$sArr = explode('|', $lines[$i]);
				$sArr[0]=$j;
				$aStr[]=join("|", $sArr);
			}
		}
		$i=$i+1;
		$j=$j+1;
}
// объединить InsBefore и InsAfter
$handle = fopen($xfile, 'w');
for ($i=0; $i<count($aStr); $i++) {
	// номер дата вид деят.	мероприятие[тип, наши/сторонние, название] место_проведения охват[тип, аудитория, зрители, выст/участники] проводящие[отдел, нач.отдел, ответств] орг-фин доп.информация
  	list($n, $dt, $vd, $acType, $acOwner, $acName, $acPlace, $oType, $oAud, $oSeer, $oPrt, $hostDep, $hostHead, $hostLd, $fin, $adInfo) = explode("|", $aStr[$i]);
  	$n=" ".$i;
 	$a1 = array($n, $dt, $vd, $acType, $acOwner, $acName, $acPlace, $oType, $oAud, $oSeer, $oPrt, $hostDep, $hostHead, $hostLd, $fin, $adInfo);
 	$aStr[$i]=join("|", $a1)."\r\n";
  	fwrite($handle, $aStr[$i]);
}
fclose($handle);
// добавить MoveUp, MoveDwn, Create;
// echo "done: ".$i;
sleep(3);
$lines = file($xfile, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
echo json_encode($lines);
// отдать json!
?>