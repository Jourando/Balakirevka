﻿<?php
// v.10.a.2::backupman revision
$m1='';
?>
<style>
.show {position: relative; top: -360; left: 0; z-index: 3; background: rgba(128, 128, 128, 0.6); width: 660px; height: 360px;}
</style>
<?
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
echo "<br><br>\r\n";
echo "<h4>Доступные варианты:</h4>\r\n";
echo "<div id=selrb>\r\n";
echo "<div style='overflow: scroll; width: 650px; height: 350px; padding: 5px;'>&nbsp;</div>";
echo "<div id=hs class=hid> </div>\r\n";
echo "</div>\r\n";
echo "<!-- <input type=button value=1 onclick='document.getElementById(\"hs\").className=\"show\";'><input type=button value=2 onclick='document.getElementById(\"hs\").className=\"hid\";'> -->";
// div --> radio | filename | filedate
// список файлов... директории <- дропдаун меню
?>