<?php
if (ISSET($_GET['us'])==true) {
	list($lx1, $lx2, $lx3)=explode("___0_", $_GET['us']);
	$autologin=1;
} else {
	$autologin=0;
	$lx1=0;
	$lx2='Фамилия и инициалы';
	$lx3='Пароль';
}
?>	
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html lang="ru">
<head>
<meta http-equiv="X-UA-Compatible" content="IE=edge"><meta charset="utf-8">
<Title>Main Tab Editor</Title>
<style>
body {margin: 0px; padding: 0px}
th {border: 1px solid #000; background: silver}
input[type=text] {resize:both;}
.T1 {background: snow}
.T1:hover {background: lightblue;}
.T2 {font-weight: bold}
.depHdr {color: white; background: black; padding-left: 150px;}
.upLayer {background: rgba(202, 202, 202, 0.5); width: 100%; height: 100%; position: absolute; top: 0; left: 0; z-index: 3;}
.xxLayer {width: 100%; height: 100%; position: absolute; top: 0; left: 0; z-index: 5; display: table; text-align: center; vertical-align: middle;}
.xeLayer {width: 100%; height: 100%; display: table-cell; text-align: center; vertical-align: middle;}
.bdLayer {display: block; background: #fff; border: 1px solid #000;}
.hdLayer {background: lightblue; font-weight: bold; padding-left: 50px; height: 20px;}
.ctLayer {background: snow;}
.visible {display: inline-block;}
.invisible {display: none;}
</style>
</head>
<body id=mBody>
<script src=globals2.js?rev=123></script>
<?
function mkMenu() {
$xfile="depart0.a";
$lines = file($xfile, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
$i=0;
$defStr='1||||||||||||||||';
echo "<form autocomplete=1><fieldset name=set id=fset>\r\n";
echo "<label>Отдел <select>\r\n";
foreach($lines as $v) {
	list($mVal[$i], $mLable[$i])=explode("=", $lines[$i]);
	if ($i>0) {
		$resStr[$i]="<option value=".$mVal[$i].">[".$mVal[$i]."] ".$mLable[$i]."</option>\r\n";
	} else {
		$resStr[$i]="<option value=".$mVal[$i].">".$mLable[$i]."</option>\r\n";
	}
	echo $resStr[$i];
	if (!FILE_EXISTS('depart'.$i.'.a')) {
		$handle = fopen('depart'.$i.'.a', 'w');
		fwrite($handle, $defStr."\r\n");
		fclose($handle);
	}
	$i=$i+1;
}
echo "</select></label>\r\n";
echo "<label> оператор <input type=text id=lusr value=\"Фамилия и инициалы\" OnFocus=this.value=\"\" OnBlur=\"if (this.value=='') {this.value='Фамилия и инициалы';}\"> пароль <input id=pusr type=password value=Пароль OnFocus=this.value=\"\" OnBlur=\"if (this.value=='') {this.value='Пароль';}\"> <input type=button value=Отправить Onclick=f8() class=visible id=b1> <input type=button value=Перелогиниться Onclick=f9() class=invisible id=b2> <input type=button value=Обновить OnClick=\"location.reload()\"></label>\r\n";
echo "</fieldset></form>\r\n";
return $mLable;
}
function getContent($a1, $m1) {
// $dir = __DIR__;
// $f=scandir($dir);
$i=0;
foreach (glob("depart*.a") as $filename) {
    $fArray[$i]=$filename;
	$lines[$i] = file($fArray[$i], FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
	$j=0;
	if ($fArray[$i] !== "depart0.a") {
		$rx[$i]="<tr id=sec".$i."hdr class=T2><td id=hdr".$i." colspan=16 class=depHdr>Отдел: ".$m1[$i]."</td></tr>\r\n";
		echo $rx[$i];
		foreach($lines[$i] as $v) {
			list($n, $dt, $vd, $acType, $acOwner, $acName, $acPlace, $oType, $oAud, $oSeer, $oPrt, $hostDep, $hostHead, $hostLd, $fin, $adInfo) = explode("|", $lines[$i][$j]);
			$rs[$i][$j]="<tr id=sec".$i."line".$j." class=T1><td id=s".$i."r".$j."c1>".$n."</td><td id=s".$i."r".$j."c2>".$dt."</td><td id=s".$i."r".$j."c3>".$vd."</td><td id=s".$i."r".$j."c4>".$acType."</td><td id=s".$i."r".$j."c5>".$acOwner."</td><td id=s".$i."r".$j."c6>".$acName."</td><td id=s".$i."r".$j."c7>".$acPlace."</td><td id=s".$i."r".$j."c8>".$oType."</td><td id=s".$i."r".$j."c9>".$oAud."</td><td id=s".$i."r".$j."c10>".$oSeer."</td>";
			$rs[$i][$j]=$rs[$i][$j]."<td id=s".$i."r".$j."c11>".$oPrt."</td><td id=s".$i."r".$j."c12>".$hostDep."</td><td id=s".$i."r".$j."c13>".$hostHead."</td><td id=s".$i."r".$j."c14>".$hostLd."</td><td id=s".$i."r".$j."c15>".$fin."</td><td id=s".$i."r".$j."c16>".$adInfo."</td></tr>\r\n";
			echo $rs[$i][$j];
			$j=$j+1;
		}
	}
	$i=$i+1;
}
// print_r($m1);
}
?>
<DIV id=mainSection>
<? $tA=mkMenu() ?>
<Table width=100% border=0 id=mainTab>
<tr>
	<th rowspan=2>номер</th><th rowspan=2>дата</th><th rowspan=2>вид деятельности</th><th colspan=3>мероприятие</th><th rowspan=2>место проведения</th><th colspan=4>охват</th><th colspan=3>проводящие</th><th rowspan=2>организационно-<br>финансовое</th><th rowspan=2>доп.<br>информация</th>
</tr><tr>
	<th>тип</th><th>внутренние/сторонние</th><th>название</th><th>тип</th><th>целевая аудитория</th><th>зрители</th><th>выступающие/участники</th><th>отделение</th><th>нач.отделения</th><th>ответственный</th>
</tr>
<? getContent('all', $tA) ?>
</Table>
</DIV>

</body>
</html>