﻿<?php
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
<!--
<script src=globals.js?rev=123></script>
<script src=depart0.js?rev=123></script>
<script src=depart1.js?rev=123></script>
<script src=depart2.js?rev=123></script>
<script src=depart3.js?rev=123></script>
-->
<script>
/* LIB */
function explode(str, delim) {
return str.toString().split (delim.toString());
}
function insertAfter(elem, refElem) {
  return refElem.parentNode.insertBefore(elem, refElem.nextSibling);
}
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
	var xmlhttp = getXmlHttp();
	var param;
	xmlhttp.open("POST", datStr, true);
	param=xurl;
	xmlhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
	xmlhttp.onreadystatechange = function(){      
		if (xmlhttp.readyState==4 && xmlhttp.status==200) {
			// alert(xmlhttp.responseText);
		}
    }
	xmlhttp.send("param="+param);
}
function getUrl(xurl, cb, xmd) {
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
					document.getElementById('sect').selectedIndex=j;
					document.getElementById('sect').disabled=true;
					document.getElementById('lusr').disabled=true;
					document.getElementById('pusr').disabled=true;
					document.getElementById('b1').className='invisible';
					document.getElementById('b2').className='visible';
					curMod=j;
					ShowAll();
				} else {
					document.getElementById('fset').innerHTML='<label>Ошибка авторизации: '+Rtxt+' <input type=button value=Отправить Onclick=f8() class=invisible id=b1><input type=button value=Перелогиниться Onclick=f9() class=visible id=b2></label>';		
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
function modalEdit() {
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
						var trx=document.getElementById('xedit');
						for (j=0; j<16; j++) {
							document.getElementById('ext'+j).value=trx.childNodes[j].innerHTML;
						}
}
/* End LIB */
function ShowAll() {
var tmpArr = new Array();
var el1=document.getElementById('mainTab');
var newTr;
var tmpStr=hdrStr;
el1.innerHTML=tmpStr;
newTr = document.createElement('tr');
newTr.className='T2';
tmpStr='<td colspan=16 class=depHdr>'+d0[1]+'</td>';
newTr.innerHTML=tmpStr;
el1.appendChild(newTr);
for (i=1; i<d1.length; i++) {
	newTr = document.createElement('tr');
	newTr.className='T1';
	newTr.setAttribute('part', '1');
	tmpArr = explode(d1[i], '|');
	tmpStr='<td>'+tmpArr[0]+'</td><td>'+tmpArr[1]+'</td><td>'+tmpArr[2]+'</td><td>'+tmpArr[3]+'</td><td>'+tmpArr[4]+'</td><td>'+tmpArr[5]+'</td><td>'+tmpArr[6]+'</td><td>'+tmpArr[7]+'</td><td>'+tmpArr[8]+'</td><td>'+tmpArr[9]+'</td><td>'+tmpArr[10]+'</td><td>'+tmpArr[11]+'</td><td>'+tmpArr[12]+'</td><td>'+tmpArr[13]+'</td><td>'+tmpArr[14]+'</td><td>'+tmpArr[15]+'</td>';
	newTr.innerHTML=tmpStr;
	if ((curMod==1) || (curMod==999)) {
		newTr.onclick=function() {
			this.id='xedit';
			modalEdit();
		}
	}
	el1.appendChild(newTr);
}
var el2=document.getElementById('mainTab');
newTr = document.createElement('tr');
newTr.className='T2';
tmpStr='<td colspan=16 class=depHdr>'+d0[2]+'</td>';
newTr.innerHTML=tmpStr;
el2.appendChild(newTr);
for (i=1; i<d2.length; i++) {
	newTr = document.createElement('tr');
	newTr.className='T1';
	newTr.setAttribute('part', '2');
	tmpArr = explode(d2[i], '|');
	tmpStr='<td>'+tmpArr[0]+'</td><td>'+tmpArr[1]+'</td><td>'+tmpArr[2]+'</td><td>'+tmpArr[3]+'</td><td>'+tmpArr[4]+'</td><td>'+tmpArr[5]+'</td><td>'+tmpArr[6]+'</td><td>'+tmpArr[7]+'</td><td>'+tmpArr[8]+'</td><td>'+tmpArr[9]+'</td><td>'+tmpArr[10]+'</td><td>'+tmpArr[11]+'</td><td>'+tmpArr[12]+'</td><td>'+tmpArr[13]+'</td><td>'+tmpArr[14]+'</td><td>'+tmpArr[15]+'</td>';
	newTr.innerHTML=tmpStr;
	if ((curMod==2)  || (curMod==999)) {
		newTr.onclick=function() {
			this.id='xedit';
			modalEdit();
		}
	}
	el2.appendChild(newTr);
}
var el3=document.getElementById('mainTab');
newTr = document.createElement('tr');
newTr.className='T2';
tmpStr='<td colspan=16 class=depHdr>'+d0[3]+'</td>';
newTr.innerHTML=tmpStr;
el3.appendChild(newTr);
for (i=1; i<d3.length; i++) {
	newTr = document.createElement('tr');
	newTr.className='T1';
	newTr.setAttribute('part', '3');
	tmpArr = explode(d3[i], '|');
	tmpStr='<td>'+tmpArr[0]+'</td><td>'+tmpArr[1]+'</td><td>'+tmpArr[2]+'</td><td>'+tmpArr[3]+'</td><td>'+tmpArr[4]+'</td><td>'+tmpArr[5]+'</td><td>'+tmpArr[6]+'</td><td>'+tmpArr[7]+'</td><td>'+tmpArr[8]+'</td><td>'+tmpArr[9]+'</td><td>'+tmpArr[10]+'</td><td>'+tmpArr[11]+'</td><td>'+tmpArr[12]+'</td><td>'+tmpArr[13]+'</td><td>'+tmpArr[14]+'</td><td>'+tmpArr[15]+'</td>';
	newTr.innerHTML=tmpStr;
	if ((curMod==3) || (curMod==999)) {
		newTr.onclick=function() {
			this.id='xedit';
			modalEdit();
		}
	}
	el3.appendChild(newTr);
}
}
function MakeMenu() {
var newEl = new Array();
var el0=document.getElementById('sect');
for (i=1; i<d0.length; i++) {
	newEl[i] = document.createElement('option');
	el0.appendChild(newEl[i]);
	newTxt=d0[i];
	newEl[i].appendChild(document.createTextNode(newTxt));
}
}
function f1(a) {
if (a>0) {
	ShowAll();
	depMod=a;
}
}
/*       Эксперимент со скриптом */
function UpdJsData(z) {
if (z=='+') {
var newTr;
newTr = document.createElement('script');
newTr.src='depart0.js?rev='+Math.random()+'0';
newTr.id='scr0';
document.body.appendChild(newTr);
newTr = document.createElement('script');
newTr.src='depart1.js?rev='+Math.random()+'0';
newTr.id='scr1';
document.body.appendChild(newTr);
newTr = document.createElement('script');
newTr.src='depart2.js?rev='+Math.random()+'0';
newTr.id='scr2';
document.body.appendChild(newTr);
newTr = document.createElement('script');
newTr.src='depart3.js?rev='+Math.random()+'0';
newTr.id='scr3';
document.body.appendChild(newTr);
} else {
document.body.removeChild(document.getElementById('scr0'));
document.body.removeChild(document.getElementById('scr1'));
document.body.removeChild(document.getElementById('scr2'));
document.body.removeChild(document.getElementById('scr3'));
}
}
/*       Обновление не через ajax или php */

function f2() {
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
var trx=document.getElementById('xedit');
trx.id='skip';
}
// Action # Раздел[index] # Старая_строка # Новая строка
function f3() {
// вместо
var trx=document.getElementById('xedit');
var ResStr='';
var XStr='';
var trText='';
if ((depMod==0) || (depMod==999)) {
	if (document.getElementById('xedit').hasAttribute('part')) {
		ResStr=document.getElementById('xedit').getAttribute('part');
		XStr=ResStr+'##Replace##';
	} else { alert('fatal error'); }
} else {
	XStr=''+depMod+'##Replace##';
}
ResStr='';
for (j=0; j<16; j++) {
	trText+=trx.childNodes[j].innerHTML+'|';
	trx.childNodes[j].innerHTML=document.getElementById('ext'+j).value;
	ResStr+=document.getElementById('ext'+j).value+'|';
					}
XStr=XStr+encodeURIComponent(trText)+'##'+encodeURIComponent(ResStr);
postUrl(XStr, '1');
// Ajax'овая отправка данных: Replace # строка ResStr
UpdJsData('+');
f2();
}
function f4() {
// перед
var trx=document.getElementById('xedit');
var ResStr='';
var XStr='';
var trText='';
if ((depMod==0) || (depMod==999)) {
	if (document.getElementById('xedit').hasAttribute('part')) {
		ResStr=document.getElementById('xedit').getAttribute('part');
		XStr=ResStr+'##Before##';
	} else { alert('fatal error'); }
} else {
	XStr=''+depMod+'##Before##';
}
ResStr='';
var tmpS='';
for (j=0; j<16; j++) {
	trText+=trx.childNodes[j].innerHTML+'|';
	tmpS+='<td>'+document.getElementById('ext'+j).value+'</td>';
	ResStr+=document.getElementById('ext'+j).value+'|';	// ...а оно еще нужно?
					}
var newNode = document.createElement('tr');
newNode.className='T1';
newNode.setAttribute('part', document.getElementById('xedit').getAttribute('part'));
newNode.innerHTML=tmpS;
	newNode.onclick=function() {
		this.id='xedit';
		modalEdit();
	}
var el0=document.getElementById('mainTab');
el0.insertBefore(newNode, trx);
// Ajax'овая отправка данных: Before # строка ResStr
XStr=XStr+encodeURIComponent(trText)+'##'+encodeURIComponent(ResStr);
postUrl(XStr, '1');
UpdJsData('+');
f2();
}
function f5() {
// после
var trx=document.getElementById('xedit');
var ResStr='';
var XStr='';
var trText='';
if ((depMod==0) || (depMod==999)) {
	if (document.getElementById('xedit').hasAttribute('part')) {
		ResStr=document.getElementById('xedit').getAttribute('part');
		XStr=ResStr+'##After##';
	} else { alert('fatal error'); }
} else {
	XStr=''+depMod+'##After##';
}
ResStr='';
var tmpS='';
for (j=0; j<16; j++) {
	trText+=trx.childNodes[j].innerHTML+'|';
	tmpS+='<td>'+document.getElementById('ext'+j).value+'</td>';
	ResStr+=document.getElementById('ext'+j).value+'|'; // ...а оно нужно?
					}
var newNode = document.createElement('tr');
newNode.className='T1';
newNode.setAttribute('part', document.getElementById('xedit').getAttribute('part'));
newNode.innerHTML=tmpS;
	newNode.onclick=function() {
		this.id='xedit';
		modalEdit();
	}
var el0=document.getElementById('mainTab');
insertAfter(newNode, trx);
// Ajax'овая отправка данных: After # строка ResStr
XStr=XStr+encodeURIComponent(trText)+'##'+encodeURIComponent(ResStr);
postUrl(XStr, '1');
UpdJsData('+');
f2();
}
function f6() {
// del
var trx=document.getElementById('xedit');
var ResStr='';
var XStr='';
if ((depMod==0) || (depMod==999)) {
	if (document.getElementById('xedit').hasAttribute('part')) {
		ResStr=document.getElementById('xedit').getAttribute('part');
		XStr=ResStr+'##Erase##';
	} else { alert('fatal error'); }
} else {
	XStr=''+depMod+'##Erase##';
}
ResStr='';
var trText='';
for (j=0; j<16; j++) {
	trText+=trx.childNodes[j].innerHTML+'|';
	ResStr+='1||||||||||||||||';
					}
XStr=XStr+encodeURIComponent(trText)+'##'+encodeURIComponent(ResStr);
postUrl(XStr, '1');
UpdJsData('+');
f2();
document.getElementById('mainTab').removeChild(trx);
// Ajax'овая отправка данных: Erase #
}
function f7() {
// создать строку
// Ajax'овая отправка данных: Create #
}
function f8() {
var xb;
var xnewStr1=encodeURIComponent(document.getElementById('lusr').value);
var xnewStr2=encodeURIComponent(document.getElementById('pusr').value);
if (depMod>0) {
	// var xnewStr1=a4b(document.getElementById('lusr').value);
	// var xnewStr2=a4b(document.getElementById('pusr').value);
	var qStr='act=C&u='+xnewStr1+'&p='+xnewStr2+'&d='+depMod;
	getUrl(urlStr+qStr, xb, '1');
} else {
	if ((depMod==0) && (a4b(document.getElementById('lusr').value)=='006500680077')) {
		var qStr='act=C&u='+xnewStr1+'&p='+xnewStr2+'&d=999';
		getUrl(urlStr+qStr, xb, '1');
	} else {
		var qStr='';
	}
}
}
function f9() {
curMod=0;
depMod=0;
document.getElementById('fset').innerHTML=fsetStr;
MakeMenu();
}

// нужны будут ф-ции Сместить выше/Сместить ниже
// resize поля text-edit
// почистить и упростить код, избавиться от вагона лишних переменных
// разобраться с передачей данных из js-скриптов без рефреша страницы
</script>
</head>
<body id=mBody>
<DIV id=mainSection>
<Script>
document.write('<form autocomplete=1><fieldset name="set" id=fset></fieldset></form>');
document.write('<Table width=100% border=0 id=mainTab>'+hdrStr+'</Table>');
</Script>
</DIV>
<script>
ShowAll();
f9();
</script>
</body>
</html>