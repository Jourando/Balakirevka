<?php
// v.10.a.4::backupman revision
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
PRE {border: 0px solid #333; border-bottom: 1px dotted #333; background: snow;}
PRE:hover {cursor: pointer; background: lightblue;}
</style>
<script>
var depMod=0;
function appoint(a) {
exploder=function(str, delim) {
	return str.toString().split(delim.toString());
}
var trdw = exploder(a, ' | ');
document.getElementById('rbText').value=trdw[0];
}
function xAct(a) {
if (a>0) {
	document.getElementById("hs").className="hid";
	document.getElementById("ds").className="chid";
	document.getElementById('flist').innerHTML='<PRE>      имя файла              |  дата изменения     |  размер</PRE>';
	for (i=1; i<Drp.length; i++) {
		for (j=0; j<Drp[i].length; j++) {
				document.getElementById('flist').innerHTML+='<PRE OnClick="appoint(this.innerHTML)">'+Drp[i][j]+'</PRE>';
		}
	}
} else { document.getElementById("hs").className="show"; document.getElementById("ds").className="cshow";}
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
echo "<script>\r\n";
echo "var Drp=new Array();\r\n";
for ($i=1; $i<count($prE)+1; $i++) {
	echo "Drp[".$i."]=new Array();\r\n";
	$fdir = 'oldata/'.str_pad($i, 4, '0', STR_PAD_LEFT)."/";
	$f = glob($fdir."*");
// echo "В последний раз файл $filename был изменен: " . date ("F d Y H:i:s.", filemtime($filename));
	for ($j=0; $j<count($f); $j++) {
		echo "Drp[".$i."][".$j."]='".$f[$j]." | ".date("Y/m/d H:i:s", filemtime($f[$j]))." | ".filesize($f[$j])."';\r\n";
	}
}
echo "</script>\r\n";
echo "<br><br>\r\n";
echo "<h4>Доступные варианты:</h4>\r\n";
echo "<div id=selrb style='position: relative;'>\r\n";
echo "<div id=flist style='overflow: scroll; width: 650px; height: 350px; padding: 5px;'>&nbsp;</div>";
echo "<div id=hs class=show> </div>\r\n";
echo "</div>\r\n";
echo "<form action='?actz=rb' method=post>\r\n";
echo "<div id=ctrl style='position: relative'><label><input type=button value=RollBack style='width: 100px'> to <input id=rbText type=text readonly value='' style='width: 220px; background: lightblue;'></label>";
echo "<div id=ds class=cshow> </div></div>";
echo "</form>";
?>
<DIV></DIV>
</BODY>
</HTML>
<?
$m1='q';
?>