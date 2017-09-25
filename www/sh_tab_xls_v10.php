<?php
// v.10.a.1::about revision
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
.upLayer {background: rgba(202, 202, 202, 0.5); width: 100%; height: 100%; position: fixed; top: 0; left: 0; z-index: 3;}
.xxLayer {width: 100%; height: 100%; position: fixed; top: 0; left: 0; z-index: 5; display: table; text-align: center; vertical-align: middle;}
.xeLayer {width: 100%; height: 100%; display: table-cell; text-align: center; vertical-align: middle;}
.bdLayer {display: block; background: #fff; border: 1px solid #000;}
.hdLayer {background: lightblue; font-weight: bold; padding-left: 50px; height: 20px;}
.ctLayer {background: snow;}
.visible {display: inline-block;}
.invisible {display: none;}
#unplug {display: block;}
</style>
<script>
function insertAfter(elem, refElem) {
  return refElem.parentNode.insertBefore(elem, refElem.nextSibling);
}
function reNew(xArr, xmid) {
exploder=function(str, delim) {
	return str.toString().split(delim.toString());
}
killRows=function(tids) {
	var elx = new Array();
	var elx=document.getElementById('mainTab').getElementsByTagName("tr");
	var s;
	for (var j = 0; j<elx.length; j++) {
		s=elx[j].id;
		if (s.indexOf(tids+'line') != -1) {
			while (s.indexOf(tids+'line') != -1) {
				(element=document.getElementById(s)).parentNode.removeChild(element);
				s=elx[j].id;
			}
		}
	}
}
addRows=function(tids, pids, pArr, rw) {
	var elx=document.getElementById(pids);
	var newEl=document.createElement('tr');
	newEl.id=tids+'line'+rw;
	newEl.className='T1';
	newEl.setAttribute('name', 'skip');
	newEl.setAttribute('onclick', 'modalEdit(\''+newEl.id+'\')');
	var trdw = exploder(tids, 'sec');
	trdw[1]='s'+trdw[1]+'r'+rw+'c';
	for (var i=0; i<16; i++) {
			trdw[0]=trdw[0]+'<td id="'+trdw[1]+(i+1)+'">'+pArr[i]+'</td>';
	}
	newEl.innerHTML=trdw[0];
	insertAfter(newEl, elx);
return newEl.id;
}
var dataJs = new Array();
for (var i = 0; i < xArr.length; i++) {
	dataJs[i]=exploder(xArr[i], '|');
}
var tmpId=exploder(xmid, 'line');
killRows(tmpId[0]);
for (var k = 0; k<xArr.length; k++) {
	if (k==0) {
		tmpId[1]=addRows(tmpId[0], tmpId[0]+'hdr', dataJs[k], k); // вставляемый, папа, контент, номер элемента п/п; 1 раз вставляем за папой, остальные - за предыдущим вставленным id
	} else {
		tmpId[1]=addRows(tmpId[0], tmpId[1], dataJs[k], k);
	}
}
modalClose('none');
}
</script>
</head>
<body id=mBody>
<script src=globals2.js?rev=122></script>
<script>
function getXmlHttp(){
    try {
        return new ActiveXObject("Msxml2.XMLHTTP");
    } catch (e) {
        try {
            return new ActiveXObject("Microsoft.XMLHTTP");
        } catch (ee) { }
    }
    if (typeof XMLHttpRequest!='undefined') {
        return new XMLHttpRequest();
    }
}
function postUrl(xurl, cb, xmd) {
	var backdata = new Array();
	var xmlhttp = getXmlHttp();
	var param;
	xmlhttp.open("POST", datStr, true);
	param=xurl;
	xmlhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
	xmlhttp.onreadystatechange = function(){      
		if (xmlhttp.readyState==4 && xmlhttp.status==200) {
			// alert(xmlhttp.responseText);
			backdata = JSON.parse(xmlhttp.responseText);
			reNew(backdata, xmd);
		}
    }
	xmlhttp.send("param="+param);
}
function getUrl(xurl, cb, xmd) {
	var Rtxt='';
    var xmlhttp = getXmlHttp();
	var dc=document.getElementById('fset');
    xmlhttp.open("GET", xurl+'&r='+Math.random());
    xmlhttp.onreadystatechange = function() {
        if (xmlhttp.readyState == 4) {
			var Rtxt=xmlhttp.responseText;
			Rtxt=decodeURIComponent(Rtxt);
			if (parseInt(xmd)==1) {
				if (Rtxt[0] == '+') {
					var j=parseInt(Rtxt);
					document.getElementById('dps').selectedIndex=j;
					document.getElementById('dps').disabled=true;
					document.getElementById('lusr').disabled=true;
					document.getElementById('pusr').disabled=true;
					document.getElementById('b1').className='invisible';
					document.getElementById('b2').className='visible';
					depMod=j;
				} else {
					document.getElementById('fset').innerHTML='<label>Ошибка авторизации: '+Rtxt+' <input type=button value=Отправить Onclick=Auth(1) class=invisible id=b1><input type=button value=Перелогиниться Onclick=Auth(2) class=visible id=b2></label>';		
				}
			}
            // xmlhttp.status,
            // xmlhttp.getAllResponseHeaders(),
            // xmlhttp.responseText
            // );
        }
    }
    xmlhttp.send(null);
}
function LogIt(qStr) {
var xb;
// формат: Время, юзер, с какой стр., c какого объекта, какое действие, тип, успех или код ошибки
// формат: Ф-ция, имя переменной, знач. переменной
getUrl(logStr+qStr, xb, '0');
}
function a4b(atext) {
//charCodeAt
var btext='';
var ctext='';
for (i=0; i<atext.length; i++) {
	ctext=''+atext.charCodeAt(i);
	if (ctext.length==1) { btext=btext+'000'+ctext; }
	else if (ctext.length==2) { btext=btext+'00'+ctext; }
	else if (ctext.length==3) { btext=btext+'0'+ctext; }
	else {btext=btext+ctext;}
}
return btext;
}
function b4a(atext) {
//fromCharCode
var btext='';
var ctext='';
var j=0;
for (i=0; i<atext.length-3; i++) {
	ctext=atext.substr(i, 4);
	j=parseInt(ctext);
	btext=btext+String.fromCharCode(j);
	i+=3;
}
return btext;
}
function modalEdit(tid) {
if (document.getElementById('dps') !== null) {
	if (document.getElementById('dps').disabled==true) {
		var mid='sec'+document.getElementById('dps').selectedIndex+'line';
		if (tid.indexOf(mid) !== -1) {
			var mdWin=document.createElement('div');
			mdWin.className='upLayer';
			mdWin.id='ModalBack';
			document.body.appendChild(mdWin);
			var ssWin=document.createElement('div');
			ssWin.className='xxLayer';
			ssWin.id='ModalFore';
			document.body.appendChild(ssWin);
			var seWin=document.createElement('div');
			seWin.className='xeLayer';
			seWin.id='ModalCell';
			ssWin.appendChild(seWin);
			var sxWin=document.createElement('div');
			sxWin.className='bdLayer';
			sxWin.id='ModalBody';
			seWin.appendChild(sxWin);
			var stWin=document.createElement('div');
			var spWin=document.createElement('div');
			stWin.className='hdLayer';
			stWin.id='ModalHead';
			stWin.innerHTML='Режим редактирования';
			spWin.className='ctLayer';
			spWin.id='ModalCont';
			spWin.innerHTML='<Table width=100% border=0 id=subTab>'+hdrStr+edtStr+'</Table>';
			sxWin.appendChild(stWin);
			sxWin.appendChild(spWin);
			var trx=document.getElementById(tid);
			trx.setAttribute('name', 'edit');
			for (j=0; j<16; j++) {
				document.getElementById('ext'+j).value=trx.childNodes[j].innerHTML;
			}
			document.getElementById('hid').value=tid;
		}
	}
}
}
function modalClose(tid) {
var sxWin=document.getElementById('ModalBody');
sxWin.removeChild(sxWin.childNodes[1]);
sxWin.removeChild(sxWin.childNodes[0]);
var seWin=document.getElementById('ModalCell');
seWin.removeChild(seWin.childNodes[0]);
var ssWin=document.getElementById('ModalFore');
ssWin.removeChild(ssWin.childNodes[0]);
var mdWin=document.getElementById('ModalFore');
document.body.removeChild(mdWin);
mdWin=document.getElementById('ModalBack');
document.body.removeChild(mdWin);
var trx=document.getElementById(tid);
if (trx !== null) {
	trx.setAttribute('name', 'skip');
}
}
function Auth(px) {
var xb;
if (px==1) {
	var xnewStr1=encodeURIComponent(document.getElementById('lusr').value);
	var xnewStr2=encodeURIComponent(document.getElementById('pusr').value);
	if (depMod>0) {
		var qStr='act=C&u='+xnewStr1+'&p='+xnewStr2+'&d='+depMod;
	} else {
		if ((depMod==0) && (a4b(document.getElementById('lusr').value)=='006500680077')) {
			var qStr='act=C&u='+xnewStr1+'&p='+xnewStr2+'&d=999';
		} else {
			var qStr='';
		}
	}
	getUrl(urlStr+qStr, xb, '1');
} else {
	var vxtp;
	var fst=document.getElementById('fset');
	vxtp='<label>Отдел <select id=dps Onchange="depMod=this.selectedIndex">';
<?
$xfile="depart0000.a";
$lines = file($xfile, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
$i=0;
$defStr=' 0||||||||||||||||';
$ptmp="";
foreach($lines as $v) {
	list($mVal[$i], $mLable[$i])=explode("=", $lines[$i]);
	if ($i>0) {
		$ptmp=$ptmp."vxtp=vxtp+'<option value=".$mVal[$i].">[".$mVal[$i]."] ".$mLable[$i]."</option>';\r\n";
	} else {
		$ptmp=$ptmp."vxtp=vxtp+'<option value=".$mVal[$i].">".$mLable[$i]."</option>';\r\n";
	}
	$i=$i+1;
}
$ptmp=$ptmp."vxtp=vxtp+'</select></label>';\r\n";
echo $ptmp;
?>
	fst.innerHTML=vxtp+'<label> оператор <input type=text id=lusr value="Фамилия и инициалы" OnFocus=this.value="" OnBlur="if (this.value==\'\') {this.value=\'Фамилия и инициалы\';}"> пароль <input id=pusr type=password value=\'Пароль\' OnFocus=this.value="" OnBlur="if (this.value==\'\') {this.value=\'Пароль\';}"> <input type=button value=Отправить Onclick=Auth(1) class=visible id=b1> <input type=button value=\'Перелогиниться\' Onclick=Auth(2) class=invisible id=b2> <input type=button value=Обновить OnClick="location.reload()"></label>';
}	
}
function Prw() {
<?
echo "var alg=".$autologin.";\r\n";
echo "var adpt=".$lx1.";\r\n";
echo "var ausr='".$lx2."';\r\n";
echo "var apwd='".$lx3."';\r\n";
?>
document.getElementById('dps').selectedIndex=adpt;
document.getElementById('lusr').value=ausr;
document.getElementById('pusr').value=apwd;
if (alg>0) { depMod=adpt; }
}
function ItmInsBefore() {
var xb;
var delim='##';
var act = 'BEFORE';
var sect=document.getElementById('dps').selectedIndex;
var oldStrID = document.getElementById('hid').value;
var newStr = '';
var oldStr = '';
var trx=document.getElementById(oldStrID);
for (j=0; j<16; j++) {
	oldStr+=trx.childNodes[j].innerHTML; // old
	newStr+=document.getElementById('ext'+j).value; // new
	if (j<15) {
		newStr+='|';
		oldStr+='|';
	} 
}
var ResStr=act+delim+sect+delim+encodeURIComponent(oldStr)+delim+encodeURIComponent(newStr);
postUrl(ResStr, xb, document.getElementById('hid').value);
}
function ItmInsAfter() {
	var xb;
var delim='##';
var act = 'AFTER';
var sect=document.getElementById('dps').selectedIndex;
var oldStrID = document.getElementById('hid').value;
var newStr = '';
var oldStr = '';
var trx=document.getElementById(oldStrID);
for (j=0; j<16; j++) {
	oldStr+=trx.childNodes[j].innerHTML; // old
	newStr+=document.getElementById('ext'+j).value; // new
	if (j<15) {
		newStr+='|';
		oldStr+='|';
	} 
}
var ResStr=act+delim+sect+delim+encodeURIComponent(oldStr)+delim+encodeURIComponent(newStr);
postUrl(ResStr, xb, document.getElementById('hid').value);		
}
function ItmReplace() {
	var xb;
var delim='##';
var act = 'REPLACE';
var sect=document.getElementById('dps').selectedIndex;
var oldStrID = document.getElementById('hid').value;
var newStr = '';
var oldStr = '';
var trx=document.getElementById(oldStrID);
for (j=0; j<16; j++) {
	oldStr+=trx.childNodes[j].innerHTML; // old
	newStr+=document.getElementById('ext'+j).value; // new
	if (j<15) {
		newStr+='|';
		oldStr+='|';
	} 
}
var ResStr=act+delim+sect+delim+encodeURIComponent(oldStr)+delim+encodeURIComponent(newStr);
postUrl(ResStr, xb, document.getElementById('hid').value);
}
function ItmDelete() {
	var xb;
var delim='##';
var act = 'ERASE';
var sect=document.getElementById('dps').selectedIndex;
var oldStrID = document.getElementById('hid').value;
var newStr = '';
var oldStr = '';
var trx=document.getElementById(oldStrID);
for (j=0; j<16; j++) {
	oldStr+=trx.childNodes[j].innerHTML; // old
	newStr+=document.getElementById('ext'+j).value; // new
	if (j<15) {
		newStr+='|';
		oldStr+='|';
	} 
}
var ResStr=act+delim+sect+delim+encodeURIComponent(oldStr)+delim+encodeURIComponent(newStr);
postUrl(ResStr, xb, document.getElementById('hid').value);
}
</script>
<?
function mkMenu() {
$xfile="depart0000.a";
$lines = file($xfile, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
$i=0;
$defStr=' 0||||||||||||||||';
echo "<form autocomplete=1><fieldset name=set id=fset>\r\n";
echo "<label>Отдел <select id=dps Onchange='depMod=this.selectedIndex'>\r\n";
foreach($lines as $v) {
	list($mVal[$i], $mLable[$i])=explode("=", $lines[$i]);
	if ($i>0) {
		$resStr[$i]="<option value=".$mVal[$i].">[".$mVal[$i]."] ".$mLable[$i]."</option>\r\n";
	} else {
		$resStr[$i]="<option value=".$mVal[$i].">".$mLable[$i]."</option>\r\n";
	}
	echo $resStr[$i];
	if ((!FILE_EXISTS('depart'.str_pad($i, 4, "0", STR_PAD_LEFT).'.a')) || (filesize('depart'.str_pad($i, 4, "0", STR_PAD_LEFT).'.a')<10)) {
		$handle = fopen('depart'.str_pad($i, 4, "0", STR_PAD_LEFT).'.a', 'w');
		fwrite($handle, $defStr."\r\n");
		fclose($handle);
	}
	$i=$i+1;
}
echo "</select></label>\r\n";
echo "<label> оператор <input type=text id=lusr value=\"Фамилия и инициалы\" OnFocus=this.value=\"\" OnBlur=\"if (this.value=='') {this.value='Фамилия и инициалы';}\"> пароль <input id=pusr type=password value=Пароль OnFocus=this.value=\"\" OnBlur=\"if (this.value=='') {this.value='Пароль';}\"> <input type=button value=Отправить Onclick=\"Auth(1)\" class=visible id=b1> <input type=button value=Перелогиниться Onclick=\"Auth(2)\" class=invisible id=b2> <input type=button value=Обновить OnClick=\"location.reload()\"></label>\r\n";
echo "</fieldset></form>\r\n";
return $mLable;
}
function getContent($a1, $m1) {
$i=0;
foreach (glob("depart*.a") as $filename) {
    $fArray[$i]=$filename; 
	$j=0;
	if ($fArray[$i] !== "depart0000.a") {
		$lines[$i] = file($fArray[$i], FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
		$rx[$i]="<tr id=sec".$i."hdr class=T2><td id=hdr".$i." colspan=16 class=depHdr>Отдел: ".$m1[$i]."</td></tr>\r\n";
		echo $rx[$i];
		foreach($lines[$i] as $v) {
			list($n, $dt, $vd, $acType, $acOwner, $acName, $acPlace, $oType, $oAud, $oSeer, $oPrt, $hostDep, $hostHead, $hostLd, $fin, $adInfo) = explode("|", $lines[$i][$j]);
			$rs[$i][$j]="<tr id=sec".$i."line".$j." class=T1 name=skip Onclick='modalEdit(\"sec".$i."line".$j."\")'><td id=s".$i."r".$j."c1>".$n."</td><td id=s".$i."r".$j."c2>".$dt."</td><td id=s".$i."r".$j."c3>".$vd."</td><td id=s".$i."r".$j."c4>".$acType."</td><td id=s".$i."r".$j."c5>".$acOwner."</td><td id=s".$i."r".$j."c6>".$acName."</td><td id=s".$i."r".$j."c7>".$acPlace."</td><td id=s".$i."r".$j."c8>".$oType."</td><td id=s".$i."r".$j."c9>".$oAud."</td><td id=s".$i."r".$j."c10>".$oSeer."</td>";
			$rs[$i][$j]=$rs[$i][$j]."<td id=s".$i."r".$j."c11>".$oPrt."</td><td id=s".$i."r".$j."c12>".$hostDep."</td><td id=s".$i."r".$j."c13>".$hostHead."</td><td id=s".$i."r".$j."c14>".$hostLd."</td><td id=s".$i."r".$j."c15>".$fin."</td><td id=s".$i."r".$j."c16>".$adInfo."</td></tr>\r\n";
			echo $rs[$i][$j];
			$j=$j+1;
		}
	}
	$i=$i+1;
}
}
?>
<DIV id=mainSection>
<? $tA=mkMenu() ?>
<script>
Prw();
</script>
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