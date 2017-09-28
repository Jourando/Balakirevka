<?php
// v.10.a.4::write revision
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
		if (($act=="BEFORE") || ($act=="AFTER") || ($act=="ERASE")) {
			if (trim($lines[$i]) == trim($oldStr)) {
				if ($act=="BEFORE") {
					$aStr[]=$newStr;
					$aStr[]=$oldStr;
				} elseif ($act=="AFTER") {
					$aStr[]=$oldStr;
					$aStr[]=$newStr;
				} else {
					$j=$j-2;
				}
				$j=$j+1;
			} else {
				$sArr = explode('|', $lines[$i]);
				$sArr[0]=$j;
				$aStr[]=join("|", $sArr);
			}
		}
		$i=$i+1;
		$j=$j+1;
}
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
usleep(100);
$lines = file($xfile, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
echo json_encode($lines);
// отдать json!
// ну отдали json, полегчало?
?>