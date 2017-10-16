<?php
// v.10.a.6::write revision
header("Cache-Control: no-store, no-cache, must-revalidate");
header("Expires: " . date("r"));
$tmp1=$_POST['param'];
list($act, $d, $oldStr, $newStr) = explode("##", $tmp1);
$spd = str_pad($d, 4, "0", STR_PAD_LEFT);
$ospd = 'oldata/'.$spd;
$xfile = 'depart'.$spd.'.a';
$lines = file($xfile, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES); 
if (!file_exists($ospd)) { mkdir($ospd, 0744, true); }
$f=scandir($ospd);
$j=count($f)-1;
$newfile=$ospd.'/depart'.$spd.'['.str_pad($j, 4, "0", STR_PAD_LEFT).']';
copy($xfile, $newfile);
$i=0;
$j=$i;
$act=strtoupper($act);
foreach($lines as $v) {
		if ($act=="REPLACE") {
			if (trim($lines[$i]) == trim($oldStr)) {
				$aStr[] = $newStr;
			} else {$aStr[] = $lines[$i];}
		}
		if (($act=="BEFORE") || ($act=="AFTER") || ($act=="ERASE")) {
			if (trim($lines[$i]) == trim($oldStr)) {
				if ($act=="BEFORE") {
					$aStr[]=$newStr;
					$aStr[]=$oldStr;
				} elseif ($act=="AFTER") {
					$aStr[]=$oldStr;
					$aStr[]=$newStr;
				} else {$j=$j-2;}
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
	list($n, $depart, $dStart, $dEnd, $vd, $acType, $acOwner, $acName, $acPlace, $oLvl, $oAud, $oSeer, $oPrt, $OOP, $hostHead, $hostLd, $hostOrg, $fin, $adInfo) = explode("|", $aStr[$i]);
  	$n=" ".$i;
 	$a1 = array($n, $depart, $dStart, $dEnd, $vd, $acType, $acOwner, $acName, $acPlace, $oLvl, $oAud, $oSeer, $oPrt, $OOP, $hostHead, $hostLd, $hostOrg, $fin, $adInfo);
 	$aStr[$i]=join("|", $a1)."\r\n";
  	fwrite($handle, $aStr[$i]);
}
fclose($handle);
// добавить MoveUp, MoveDwn, Create;
usleep(120);
$lines = file($xfile, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
echo json_encode($lines);
?>