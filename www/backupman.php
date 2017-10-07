<?php
// v.10.a.2::backupman revision
// include('menu.php');
echo "<h4>Выбирите раздел для отката</h4>";
$xfile="depart0000.a";
$lines = file($xfile, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
$i=0;
echo "<label>Отдел <select id=dps Onchange='depMod=this.selectedIndex'>\r\n";
foreach($lines as $v) {
	list($mVal[$i], $mLable[$i])=explode("=", $lines[$i]);
	if ($i>0) {
		$resStr[$i]="<option value=".$mVal[$i].">[".$mVal[$i]."] ".$mLable[$i]."</option>\r\n";
	} else {
		$resStr[$i]="<option value=".$mVal[$i].">".$mLable[$i]."</option>\r\n";
	}
	echo $resStr[$i];
	$i=$i+1;
}
echo "</select></label>\r\n";
// список файлов... директории <- дропдаун меню
?>