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
<script src=depart0.js?rev=123></script>
<script src=depart1.js?rev=123></script>
<script src=depart2.js?rev=123></script>
<script src=depart3.js?rev=123></script>
-->
</head>
<body id=mBody>
<script src=globals.js?rev=123></script>
<DIV id=mainSection>
<Script>
document.write('<form autocomplete=1><fieldset name="set" id=fset></fieldset></form>');
document.write('<Table width=100% border=0 id=mainTab>'+hdrStr+'</Table>');
</Script>
</DIV>

</body>
</html>