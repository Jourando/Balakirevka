<?php
// v.10.a.3::backupman revision
$m1='';
?>
<!DOCTYPE HTML>
<HTML><HEAD>
<TITLE>ROLLBACK CONTROL</TITLE>
<meta charset="utf-8">
<style>
.show {position: absolute; top: 0; left: 0; z-index: 3; background: rgba(128, 128, 128, 0.6); width: 660px; height: 360px;}
.hid {}
.cshow {position: absolute; top: 0; left: 0: z-index: 5; background: rgba(128, 128, 128, 0.6); width: 660px; height: 25px;}
.chid{}
</style>
<script>
var depMod=0;
function xAct(a) {
if (a>0) { document.getElementById("hs").className="hid"; document.getElementById("ds").className="chid";}
else { document.getElementById("hs").className="show"; document.getElementById("ds").className="cshow";}
}
</script>
</HEAD><BODY>
<?
echo "<h4>Выбирите раздел для отката</h4>";
$xfile="depart0000.a";
$lines = file($xfile, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
$i=0;
$mVal[0]='0';
echo "<label>Отдел <select id=dps Onchange='depMod=this.selectedIndex; xAct(this.selectedIndex);'>\r\n";
foreach($lines as $v) {
	list($mVal[$i], $mLable[$i])=explode("=", $lines[$i]);
	if ($i>0) {
		$resStr[$i]="<option value=".$mVal[$i].">[".$mVal[$i]."] ".$mLable[$i]."</option>\r\n";
		$prE[] = $mVal[$i];
	} else {
		$resStr[$i]="<option value=".$mVal[$i].">".$mLable[$i]."</option>\r\n";
	}
	echo $resStr[$i];
	$i=$i+1;
}
echo "</select></label>\r\n";
echo "<br><br>\r\n";
echo "<script>\r\n";
echo "var Drp=new Array();\r\n";
for ($i=1; $i<count($prE); $i++) {
	echo "var Dpr[".$i."]=new Array();\r\n";
	$fdir = 'oldata/'.str_pad($i.'', 4, '0', STR_PAD_LEFT)."/";
	// сканим через glob для вкатки в JS-array
	// $f = glob("depart*.a");
}
// echo "Dpr[
echo "</script>\r\n";
echo "<h4>Доступные варианты:</h4>\r\n";
echo "<div id=selrb style='position: relative;'>\r\n";
echo "<div style='overflow: scroll; width: 650px; height: 350px; padding: 5px;'>&nbsp;</div>";
echo "<div id=hs class=show> </div>\r\n";
echo "</div>\r\n";
echo "<!-- <input type=button value=1 onclick='document.getElementById(\"hs\").className=\"show\";'><input type=button value=2 onclick='document.getElementById(\"hs\").className=\"hid\";'> -->";
echo "<div id=ctrl style='position: relative'><label><input type=button value=RollBack> to <input type=text readonly value=''></label>";
echo "<div id=ds class=cshow> </div></div>";
// div --> radio | filename | filedate
// список файлов... директории <- дропдаун меню
?>
<DIV></DIV>
</BODY>
</HTML>
<?
$m1='q';
?>