<?php
// v.10.a.5::main revision
if (ISSET($_GET['us'])==true) {
	list($lx1, $lx2, $lx3)=explode("___0_", $_GET['us']);
	$autologin=1;
} else {
	$autologin=0;
	$lx1=0;
	$lx2='Фамилия и инициалы';
	$lx3='Пароль';
}
include ('menu.php');
?>
<!DOCTYPE html>
<html lang="RU-ru">
<head>
<meta name="viewport" content="width=device-width, initial-scale=0.65, maximum-scale=0.65, user-scalable=no">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta charset="utf-8">
<link rel="shortcut icon" type="image/x-icon" href="/favicon.ico">
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
#ModalBody1 {overflow-x: scroll;}
.CapsOff{background: #fff}
.CapsOn{background: #600;}
#CLW {display: inline-block; text-align: center; border: 1px solid #666; width: 20px; height: 20px; color: gold;}
#unplug {display: block;}
</style>
<script>
var edMode=1; // расположение полей в modalEdit
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
for (var i=0; i<pArr.length; i++) {trdw[0]=trdw[0]+'<td id="'+trdw[1]+(i+1)+'">'+pArr[i]+'</td>';}
newEl.innerHTML=trdw[0];
insertAfter(newEl, elx);
return newEl.id;
}
var dataJs = new Array();
for (var i = 0; i < xArr.length; i++) {dataJs[i]=exploder(xArr[i], '|');}
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
<script src=globals2.js?rev=125></script>
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
function postUrl(xurl, xmd) {
	var backdata = new Array();
	var xmlhttp = getXmlHttp();
	var param;
	xmlhttp.open("POST", datStr, true);
	param=xurl;
	xmlhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
	xmlhttp.onreadystatechange = function(){      
		if (xmlhttp.readyState==4 && xmlhttp.status==200) {
			backdata = JSON.parse(xmlhttp.responseText);
			reNew(backdata, xmd);
		}
    }
	xmlhttp.send("param="+param);
}
function getUrl(xurl, xmd) {
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
// формат: тип отдаваемых данных (1), Время, юзер, с какой стр., c какого объекта, какое действие, тип, успех или код ошибки
// формат: тип отдаваемых данных (2), Ф-ция, имя переменной, знач. переменной
// формат: тип отдаваемых данных (3), Ф-ция, что пишем, в какой файл .OR. ф-ция, какую файловую манипуляцию делаем, с каким файлом
getUrl(logStr+qStr, '0');
}
function repStr(d) {
d=d.replace(/</g, "[");
d=d.replace(/>/g, "]");
d=d.replace(/&/g, " and ");
d=d.replace(/\|/g, " or ");
d=d.replace(/;/g, ",");
return d;
}
function a4b(atext) {
//charCodeAt
var btext='';
var ctext='';
for (i=0; i<atext.length; i++) {
	ctext=''+atext.charCodeAt(i);
	if (ctext.length==1) {btext=btext+'000'+ctext;}
	else if (ctext.length==2) {btext=btext+'00'+ctext;}
	else if (ctext.length==3) {btext=btext+'0'+ctext;}
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
			sxWin.id='ModalBody1';
			seWin.appendChild(sxWin);
			var stWin=document.createElement('div');
			var spWin=document.createElement('div');
			stWin.className='hdLayer';
			stWin.id='ModalHead';
			stWin.innerHTML=b4a('10561077107810801084003210881077107610721082109010801088108610741072108510801103');
			spWin.className='ctLayer';
			spWin.id='ModalCont';
			spWin.innerHTML='<Table width=100% border=0 id=subTab>'+hdrStr+edtStr+'</Table>';
			sxWin.appendChild(stWin);
			sxWin.appendChild(spWin);
			var trx=document.getElementById(tid);
			trx.setAttribute('name', 'edit');
			for (j=0; j<trx.childNodes.length; j++) { // NOT 16 !!!
				document.getElementById('ext'+j).value=trx.childNodes[j].innerHTML;
			}
			document.getElementById('hid').value=tid;
			document.getElementById('ModalBody1').style.width=document.body.clientWidth+'px';
		}
	}
}
}
function modalClose(tid) {
var sxWin=document.getElementById('ModalBody1');
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
if (trx !== null) {trx.setAttribute('name', 'skip');}
}
function Auth(px) {
var qStr='';
if (px==1) {
	var xnewStr1=encodeURIComponent(document.getElementById('lusr').value);
	var xnewStr2=encodeURIComponent(document.getElementById('pusr').value);
	if (depMod>0) {
		qStr='act=C&u='+xnewStr1+'&p='+xnewStr2+'&d='+depMod;
	} else {
		if ((depMod==0) && (a4b(document.getElementById('lusr').value)=='006500680077')) {qStr='act=C&u='+xnewStr1+'&p='+xnewStr2+'&d=999';}
		else {qStr='';}
	}
	getUrl(urlStr+qStr, '1');
} else {
	var vxtp;
	var fst=document.getElementById('fset');
	vxtp='<label>Отдел <select id=dps Onchange="depMod=this.selectedIndex">';
<?
$xfile="depart0000.a";
$lines = file($xfile, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
$i=0;
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
	fst.innerHTML=vxtp+'<label> оператор <input type=text id=lusr value="Фамилия и инициалы" OnFocus=this.value="" OnBlur="if (this.value==\'\') {this.value=\'Фамилия и инициалы\';}"> пароль <input id=pusr type=password value=\'Пароль\' OnFocus=\'this.value=""; checkCapsWarning(event);\' OnBlur=\'if (this.value=="") {this.value="Пароль"}; removeCapsWarning();\' onkeyup=\'checkCapsWarning(event);\'> <div id=CLW class=CapsOff ALT="проверьте CapsLock">&nbsp;</div> <input type=button value=Отправить Onclick=Auth(1) class=visible id=b1> <input type=button value=\'Перелогиниться\' Onclick=Auth(2) class=invisible id=b2> <input type=button value=Обновить OnClick="location.reload()"></label>';
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
if (alg>0) {depMod=adpt;}
}
function ItmInsert(px) {
var delim='##';
var act = px.toUpperCase();
var sect=document.getElementById('dps').selectedIndex;
var oldStrID = document.getElementById('hid').value;
var newStr = '';
var oldStr = '';
var trx=document.getElementById(oldStrID);
for (j=0; j<trx.childNodes.length; j++) {
	oldStr+=trx.childNodes[j].innerHTML; // old
	newStr=newStr+repStr(document.getElementById('ext'+j).value); // new
	if (j<(trx.childNodes.length-1)) {
		newStr+='|'; oldStr+='|';
	}
}
var ResStr=act+delim+sect+delim+encodeURIComponent(oldStr)+delim+encodeURIComponent(newStr);
postUrl(ResStr, document.getElementById('hid').value);
}
</script>
<DIV id=mainSection>
<? $tA=mkMenu() ?>
<script>
Prw();
</script>
<Table width=100% border=0 id=mainTab>
<?
include ('tabhead.php'); // формируем столбцы
getContent('all', $tA); // первично считываем, заполняем таблицу
?>
</Table>
</DIV>
<script>
var capsLockEnabled = null;
function getChar(event) {
if (event.which == null) {
	if (event.keyCode < 32) return null;
	return String.fromCharCode(event.keyCode) // IE
}
if (event.which != 0 && event.charCode != 0) {
	if (event.which < 32) return null;
	return String.fromCharCode(event.which) // остальные
}
return null; // специальная клавиша
}
if (navigator.platform.substr(0, 3) != 'Mac') { // событие для CapsLock глючит под Mac
	document.onkeydown = function(e) {
		if (e.keyCode == 20 && capsLockEnabled !== null) {capsLockEnabled = !capsLockEnabled;}
	}
}
document.onkeypress = function(e) {
	e = e || event;
	var chr = getChar(e);
	if (!chr) return // special key
	if (chr.toLowerCase() == chr.toUpperCase()) {return;} // символ, не зависящий от регистра, например пробел не может быть использован для определения CapsLock
	capsLockEnabled = (chr.toLowerCase() == chr && e.shiftKey) || (chr.toUpperCase() == chr && !e.shiftKey);
}
function checkCapsWarning() {
	if (capsLockEnabled) {
		document.getElementById('CLW').innerHTML="!";
		document.getElementById('CLW').className='CapsOn';
	} else {
		document.getElementById('CLW').innerHTML="&nbsp;";
		document.getElementById('CLW').className='CapsOff';
	}
}
function removeCapsWarning() {
	document.getElementById('CLW').innerHTML = '&nbsp;';
	document.getElementById('CLW').className='CapsOff';
}
</script>
</body>
</html>
