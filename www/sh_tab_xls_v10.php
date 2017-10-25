<?php
// v.10.a.7::main revision
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
body {margin: 0px; padding: 0px;}
th {border: 1px solid #060; background: #599874;}
input[type=text] {resize:both;}
.T1 {background: #efefef;}
.T1:hover {background: lightblue;}
.T2 {font-weight: bold}
.depHdr {color: #000; background: #9c9; padding-left: 150px;}
.upLayer {background: rgba(202, 202, 202, 0.5); width: 100%; height: 100%; position: fixed; top: 0; left: 0; z-index: 3;}
.xxLayer {width: 100%; height: 100%; position: fixed; top: 0; left: 0; z-index: 5; display: table; text-align: center; vertical-align: middle;}
.xeLayer {width: 100%; height: 100%; display: table-cell; text-align: center; vertical-align: middle;}
.bdLayer {display: block; background: #fff; border: 1px solid #000;}
.hdLayer {background: lightblue; font-weight: bold; padding-left: 50px; height: 20px;}
.ctLayer {background: #efefef;}
.visible {display: inline-block;}
.invisible {display: none;}
#stop {background-color: #242; color: #9c9; height: 40px;}
#btnPanel {border: 1px solid #000; background-color: rgb(255, 255, 224);}
#ModalBody1 {overflow-x: scroll;}
.CapsOff{background: #eee;}
.CapsOn{background: #600;}
#CLW {display: inline-block; text-align: center; border: 1px solid #666; width: 20px; height: 20px; color: gold;}
#unplug {display: block;}
#calendar3 {width: 100%;font: monospace;line-height: 1.2em;font-size: 15px;text-align: center;}
#calendar3 thead tr:last-child {font-size: small;color: rgb(85, 85, 85);}
#calendar3 tbody td {color: rgb(44, 86, 122);}
#calendar3 tbody td:nth-child(n+6), #calendar3 .holiday {color: rgb(231, 140, 92);}
#calendar3 tbody td.today {outline: 3px solid red;}
td.norm, td.today, td.holiday {cursor: pointer;}
#clock{font-family:Tahoma, sans-serif; font-size:20px; font-weight:bold; color:#00c;}
table.mainTab {background-color: #fff;}
#allClock {background: navy;padding: 2px;width: 480px;z-index: 9;position: absolute;}
#myCanvas {mardin: 0px;padding: 0px;}
#mTime {text-align: center;position: relative;z-index: 10;left: 0;right: 0;bottom: 5px;background: rgba(235, 235, 255, 0.5);}
#mTime input[type=number] {width: 45px;}
#xtimer1 {width: 140px;border: 1px solid #333;height: 210px;}
form.lgfrm {width: 100%; background: #599874;}
#dps, #lusr, #pusr {background: rgb(255, 255, 224); color: rgb(0, 0, 224);}
.clockHide {display: none;}
.clockShow {display: block;}
.divBtn {display: inline-block; border: 1px solid #000; text-align: center; width: 60px; background: #999; color: #eee; cursor: pointer;}
.xBtn {position: absolute; top: 0; right: 0; z-index: 14; width: 20px; height: 20px; border: 1px solid #333; color: #fff; background-color: #900; font-face: Arial; font-size: 18px; padding: 0; margin: 0; text-align: center; cursor: pointer}
#floatTip {position: absolute; z-index: 3; width: 250px; display: none; border: 1px solid #000; padding: 4px; font-family: sans-serif; font-size: 9pt;color: #333; background: #ffe5ff;}
.btnTab {display: inline-block; background-color: #fff;}
.btnTd {background-color: silver; color: navy; cursor: pointer;}
.btnTd:hover {backgroubd-color: #999; color: #900;}
</style>
<script>
var edMode=1; // расположение полей в modalEdit
function trim(str, charlist) {
charlist = !charlist?' \\s\xA0':charlist.replace(/([\[\]\(\)\.\?\/\*\{\}\+\$\^\:])/g, '\$1');
var re = new RegExp('^[' + charlist + ']+|[' + charlist + ']+$', 'g');
return str.replace(re, '');
}
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
	for (var i=0; i<pArr.length; i++) {
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
function getOffset(c) {
var elem=document.getElementById(c);
if (elem.getBoundingClientRect) {return getOffsetRect(elem);}
else {return getOffsetSum(elem);}
}
function getOffsetSum(elem) {
var top=0, left=0;
while(elem) {
top=top+parseInt(elem.offsetTop); left=left+parseInt(elem.offsetLeft);
elem = elem.offsetParent;
}
return {top: top, left: left}
}
function getOffsetRect(elem) {
    var box = elem.getBoundingClientRect();
    var body = document.body
    var docElem = document.documentElement
    var scrollTop = window.pageYOffset || docElem.scrollTop || body.scrollTop
    var scrollLeft = window.pageXOffset || docElem.scrollLeft || body.scrollLeft
    var clientTop = docElem.clientTop || body.clientTop || 0
    var clientLeft = docElem.clientLeft || body.clientLeft || 0
    var top  = box.top +  scrollTop - clientTop
    var left = box.left + scrollLeft - clientLeft
    return { top: Math.round(top), left: Math.round(left) }
}
function showHint(c) {
var myBox;
if (document.getElementById('allClock').className=='clockHide') {
	document.getElementById('allClock').className='clockShow';
	document.getElementById('caller').value=c;
	myBox=getOffset(c);
	document.getElementById('allClock').style.top=myBox.top+'px';
	document.getElementById('allClock').style.left=myBox.left+'px';
} else {
	document.getElementById('allClock').className='clockHide';
}
}
function finx(b, c) {
if (b==1) {
	document.getElementById(c).value=document.getElementById('curDTx').value;
}
showHint();
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
					modalLogWrn(1, 'Успешная авторизация');
				} else {
					document.getElementById('fset').innerHTML='<label id=lerror>Ошибка авторизации: '+Rtxt+' <input type=button value=Отправить Onclick=Auth(1) class=invisible id=b1><input type=button value=Перелогиниться Onclick=Auth(2) class=visible id=b2></label>';
					modalLogWrn(2, 'Ошибка авторизации');					
				}
			} else if (parseInt(xmd)==0) {
				
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
// формат: тип отдаваемых данных (1), Время, юзер, с какой стр., c какого объекта, какое действие, тип, успех или код ошибки;
// формат: тип отдаваемых данных (2), Ф-ция, имя переменной, знач. переменной;
// формат: тип отдаваемых данных (3), Ф-ция, что пишем, в какой файл .OR. ф-ция, какую файловую манипуляцию делаем, с каким файлом;
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
			for (j=0; j<trx.childNodes.length; j++) {
				document.getElementById('ext'+j).value=trx.childNodes[j].innerHTML;
			}
			document.getElementById('hid').value=tid;
			document.getElementById('ext1').value=depMod;
			document.getElementById('ModalBody1').style.width=document.body.clientWidth+'px';
		}
	}
}
}
function modalWarnP(str1, str2) {
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
			stWin.innerHTML=str2;
			spWin.className='ctLayer';
			spWin.id='ModalCont';
			spWin.innerHTML=str1;
			sxWin.appendChild(stWin);
			sxWin.appendChild(spWin);	
}
function modalLogWrn(a, b) {
// логины, сообщ. об успешном/неуспешном логине и варнинги
if (a==1) {
	if ((document.getElementById('dps') !== null) && (document.getElementById('dps').disabled==true)) {
		modalWarnP('<div class=sq1>Добро пожаловать!<br>Вы вошли как '+document.getElementById('lusr').value+'.<br>Вам доступен для редактирования раздел ['+document.getElementById('dps').selectedIndex+'].<div><input type=button value=OK Onclick=modalClose("none")>', b);
	}
} else if (a==2) {
	modalWarnP('<div class=sq1>Здравствуйте!<br>Системе не удалось авторизовать вас.<br>Попробуйте ввести данные еще раз или обратитесь к администратору.<br>При вводе обратите внимание на правильность выбранного раздела.</div><input type=button value=OK Onclick=modalClose("none")>', b);
} else if (a==3) {
	modalWarnP('<div class=sq1>Здравствуйте!<br>Системе не удалось авторизовать вас.<br>Не все обязательные поля были заполнены:<br>необходимо выбрать раздел, ввести правильные логин и пароль.</div><input type=button value=OK Onclick=modalClose("none")>', b);
} else if (a==4) {
	modalWarnP('<div class=sq1>Внимание! Текущая сессия разорвана.<br>Если вам надо продолжить работу, авторизуйтесь заново.</div><input type=button value=OK Onclick=modalClose("none")>', b);
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
var xnewStr1='';
var xnewStr2='';
if ((document.getElementById('lusr') !== null) && (document.getElementById('pusr') !== null)) {
	xnewStr1=document.getElementById('lusr').value;
	xnewStr2=document.getElementById('pusr').value;
	if ((a4b(xnewStr1)=='106010721084108010831080110300321080003210801085108010941080107210831099') || (trim(xnewStr1)=='') || (trim(xnewStr2)=='')) {
		modalLogWrn(3, 'Ошибка авторизации');
		return false;
	}
}
if (px==1) {
	xnewStr1=encodeURIComponent(xnewStr1);
	xnewStr2=encodeURIComponent(xnewStr2);
	if (depMod>0) {
		qStr='act=C&u='+xnewStr1+'&p='+xnewStr2+'&d='+depMod;
	} else {
		if ((depMod==0) && (a4b(document.getElementById('lusr').value)=='006500680077')) {qStr='act=C&u='+xnewStr1+'&p='+xnewStr2+'&d=999';}
		else {qStr='';}
	}
	getUrl(urlStr+qStr, '1');
} else {
	var vxtp;
	if (!document.getElementById('lerror')) { 
		modalLogWrn(4, 'Предупреждение');
	}
	var fst=document.getElementById('fset');
	vxtp='<nobr><label>Отдел <select id=dps Onchange="depMod=this.selectedIndex">';
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
		$ptmp=$ptmp."vxtp=vxtp+'<option value=".$mVal[$i]." selected>".$mLable[$i]."</option>';\r\n";
	}
	$i=$i+1;
}
$ptmp=$ptmp."vxtp=vxtp+'</select></label>';\r\n";
echo $ptmp;
?>
	fst.innerHTML=vxtp+'<label> оператор <input type=text id=lusr value="Фамилия и инициалы" OnFocus=this.value="" OnBlur="if (this.value==\'\') {this.value=\'Фамилия и инициалы\';}"></label> <label>пароль <input id=pusr type=password value=\'Пароль\' OnFocus=\'this.value=""; checkCapsWarning(event);\' OnBlur=\'if (this.value=="") {this.value="Пароль"}; removeCapsWarning();\' onkeyup=\'checkCapsWarning(event);\'></label> <div id=CLW class=CapsOff ALT="проверьте CapsLock">&nbsp;</div> <input type=button value=Отправить Onclick=Auth(1) class=visible id=b1> <input type=button value=\'Перелогиниться\' Onclick=Auth(2) class=invisible id=b2> <input type=button value=Обновить OnClick="location.reload()"></nobr>';
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
<div id=btnPanel>
<script>
var Str1="Проверка даты и времени<br>Строки, содержащие ошибку, будут выделены цветом";
var Str2="Проверка места проведения<br>Строки, содержащие ошибку, будут выделены цветом"
document.onmousemove = moveTip;
function moveTip(e) {
floatTipStyle = document.getElementById("floatTip").style;
var w=250; // Ширина подсказки
if (document.all)  {x = event.clientX + document.body.scrollLeft; y = event.clientY + document.body.scrollTop;}
else {x=e.pageX; y=e.pageY;}
if ((x + w + 10) < document.body.clientWidth) {floatTipStyle.left=x+'px';} // Показывать слой справа от курсора
else {floatTipStyle.left=x-w+'px';} // Показывать слой слева от курсора
floatTipStyle.top=y+20+'px'; // Положение от  верхнего края окна браузера
}
function toolTip(msg) {
floatTipStyle = document.getElementById("floatTip").style;
if (msg) {
	document.getElementById("floatTip").innerHTML = msg;
	floatTipStyle.display = "block";
} else {
	floatTipStyle.display = "none";
}
}
</Script>
	<Table border=3 onMouseOver="toolTip(Str1)" onMouseOut="toolTip()" class=btnTab><tr><td class=btnTd>Время</td></tr></Table>
	<Table border=3 onMouseOver="toolTip(Str2)" onMouseOut="toolTip()" class=btnTab><tr><td class=btnTd>Место</td></tr></Table>
	<div id="floatTip"></div>
</div>
<Table width=100% border=0 id=mainTab>
<?
include ('tabhead.php'); // формируем столбцы
getContent('all', $tA); // первично считываем, заполняем таблицу
include('linelim.php');
echo "<tr id=stop>";
echo "<td colspan=".$linelimit." class=MainTabFinal>&nbsp;&nbsp;&nbsp;&copy;&nbsp;2017, Msk</td>";
echo "</tr>\r\n";
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
function toNx(eA, eB) {
var tmpStrX=''+eA;
while (tmpStrX.length<eB) {
	tmpStrX='0'+tmpStrX;
}
return tmpStrX;
}
function selectedDT(a, b) {
var YY=toNx(document.getElementById('ThisY').value, 4);
var MM;
if (b==3) {MM=toNx(a, 2);} // switch month
else {MM=toNx(document.getElementById('ThisM').selectedIndex+1, 2);}
var DD;
if (b==1) { // current day
	var els=document.getElementById('calendar3').getElementsByTagName('td');
	for (i=0; i<els.length; i++) {
		if (els[i].className=='today') {
				DD=toNx(els[i].innerHTML, 2);
				document.getElementById('hdate').value=els[i].innerHTML;
				break;
		}
		else {DD=toNx(document.getElementById('hdate').value, 2);}
	}
} else {
	if (b==2) {DD=toNx(a, 2); document.getElementById('hdate').value=a;} // switch day
	else {
		DD=toNx(document.getElementById('hdate').value, 2);
	}
}
els=document.getElementById('mTime').getElementsByTagName('input');
var hh=toNx(els[0].value, 2);
var mn=toNx(els[1].value, 2);
document.getElementById('curDTx').value=YY+'/'+MM+'/'+DD+' '+hh+':'+mn;
}
</script>
<div id='allClock' class="clockHide">
<div Onclick="finx(0, 'caller')" class=xBtn>x</div>
<table border=0 class=mainTab>
<tr><td>
<table id="calendar3" style="width: 282px; border: 1px solid #333; height: 210px">
	<thead>
<tr><td colspan="4">
<select id=ThisM OnChange="selectedDT(this.selectedIndex+1, 3)">
<option value="0">Январь</option>
<option value="1">Февраль</option>
<option value="2">Март</option>
<option value="3">Апрель</option>
<option value="4">Май</option>
<option value="5">Июнь</option>
<option value="6">Июль</option>
<option value="7">Август</option>
<option value="8">Сентябрь</option>
<option value="9">Октябрь</option>
<option value="10">Ноябрь</option>
<option value="11">Декабрь</option>
</select><td colspan="3"><input id=ThisY type="number" value="" min="1990" max="2090" size="4" OnChange="selectedDT('', 4);">
<tr><td width=40px>Пн<td width=40px>Вт<td width=40px>Ср<td width=40px>Чт<td width=40px>Пт<td width=40px>Сб<td width=40px>Вс
<tr><td colspan=7><hr>
	</thead>
	<tbody>
</table>
<script src=calendar.js></script>
</td><td>
<script src=clock.js></script>
<Table id="xtimer1">
<tr><td>
	<div id='clock' style="display: none">Текущее время</div>
	<canvas height='180' width='180' id='myCanvas'></canvas>
<div id=mTime><input type="number" value="0" min="0" max="23" size="2" OnChange="selectedDT('', 4);"> : <input type="number" value="0" min="0" max="59" size="2" OnChange="selectedDT('', 4);"></div></td></tr>
</Table>
</td>
</tr><tr>
<td colspan=2>Выбранное значение: <input type=text id="curDTx" value="0000/00/00 00:00" readonly>&nbsp;&nbsp;&nbsp;<div class=divBtn Onclick="finx(1, document.getElementById('caller').value)">OK</div>&nbsp;<div class=divBtn Onclick="finx(0, 'caller')">Cancel</div></td>
</tr>
</TABLE>
<input type=hidden id=hdate value="0"><input type=hidden id=caller value="">
</div>
</div>
<script>
window.setInterval(
	function(){
	    var d = new Date();
	    document.getElementById("clock").innerHTML = d.toLocaleTimeString();
      displayCanvas();
	}
  , 1000);
selectedDT('', 1);
</script>
</body>
</html>