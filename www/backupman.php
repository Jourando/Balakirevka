<?php
// v.10.a.5::backupman revision
?>
<!DOCTYPE HTML>
<HTML><HEAD>
<TITLE>ROLLBACK CONTROL</TITLE>
<meta name="viewport" content="width=device-width, initial-scale=0.65, maximum-scale=0.65, user-scalable=no">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta charset="utf-8">
<link rel="shortcut icon" type="image/x-icon" href="/favicon.ico">
<?
if ($_GET['actz']=='rb') {
	echo "<h4>Откат раздела ".$_POST['hidDpr']." к состоянию ".$_POST['rbTxt']."</h4>\r\n";
	$spd = str_pad($_POST['hidDpr'], 4, "0", STR_PAD_LEFT);
	$xfile='depart'.$spd.'.a';
	$newfile='oldata/'.$spd.'/depart'.$spd.'[';
	$f=scandir('oldata/'.$spd);
	$j=count($f)-1;
	$newfile=$newfile.str_pad($j, 4, "0", STR_PAD_LEFT).']';
	echo "<!-- copy ".$xfile." to ".$newfile." -->\r\n";
	copy($xfile, $newfile);
	unlink($xfile);
	echo "<!-- copy ".$_POST['rbTxt']." to ".$xfile." -->\r\n";
	copy($_POST['rbTxt'], $xfile);
	echo "<h4>...успешно выполнен. Нажмите [<a href=backupman.php>сюда</a>] для возврата</h4>\r\n";
} else {
?>
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
	document.getElementById('hDpr').value=a;
	document.getElementById('flist').innerHTML='<PRE>       имя файла             |  дата изменения     |  размер</PRE>';
	for (j=0; j<Drp[a].length; j++) {
		document.getElementById('flist').innerHTML+='<PRE OnClick="appoint(this.innerHTML)">'+Drp[a][j]+'</PRE>';
	}
} else {
	document.getElementById("hs").className="show";
	document.getElementById("ds").className="cshow";
	document.getElementById('flist').innerHTML='&nbsp;';
	document.getElementById('rbText').value='';
	document.getElementById('hDpr').value='';
}
}
function rbRun() {
if (document.getElementById('rbText').value !== '') {
	var el=document.getElementsByTagName('form')[0];
	el.submit();
}
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
echo "<div id=ctrl style='position: relative'><label><input type=hidden id=hDpr name=hidDpr value=''><input type=button onClick='rbRun()' value=RollBack style='width: 120px'> to <input name=rbTxt id=rbText type=text readonly value='' style='width: 220px; background: lightblue;'></label>";
echo "<div id=ds class=cshow> </div></div>";
echo "</form>";
}
include('toolmen.php');
echo "</BODY>\r\n</HTML>";
?>