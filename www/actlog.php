<?php
// v.10.a.1::log revision
$mc=0;
// формат: Время, юзер, с какой стр., c какого объекта, какое действие, тип, успех или код ошибки
// формат: Ф-ция, имя переменной, знач. переменной
// ------ // 
$a="";
$xfile = 'actlog.txt';
$usr = 'guest';
$pg = '-';
$obj = '-';
$exc = '-';
$type = 'ajax';
$code = '0';
$fnc = 'noname';
$u_var = 'undefined';
$u_val = 'undefined';
if ($_GET['act']=='ACTL') {		// act log
	$tm = date("d m Y H:i:s");	// act time
	if (ISSET($_GET['u'])) {	// actor (user)
		$usr = $_GET['u'];
	}
	if (ISSET($_GET['doc'])) {	// page
		$pg = $_GET['doc'];
	}
	if (ISSET($_GET['obj'])) {	// object
		$obj = $_GET['obj'];
	}
	if (ISSET($_GET['e'])) {	// action
		$exc = $_GET['e'];
	}
	if (ISSET($_GET['t'])) {	// type
		$type = $_GET['t'];
	}
	if (ISSET($_GET['c'])) {	// code : 0=success else errorCode
		$code = $_GET['c'];
	}
	$a = $usr." @ ".$tm." from ".$pg." : action ".$exc." on obj ".$obj." via ".$type."... Result code is ".$code."\r\n";
	$handle = fopen($xfile, 'a');
	fwrite($handle, $a);
	fclose($handle);
}
if ($_GET['act']=='VARL') {		// var log
	if (ISSET($_GET['f'])) {	// function name
		$fnc = $_GET['f'];
	}
	if (ISSET($_GET['v1'])) {	// var name
		$u_var = $_GET['v1'];
	}
	if (ISSET($_GET['v2'])) {	// var value
		$u_val = $_GET['v2'];
	}
	$a = "{variable ".$u_var."=".$u_val." -- from function ".$fnc."}\r\n";
}
$handle = fopen($xfile, 'a');
fwrite($handle, $a);
fclose($handle);
// с форматом лажа...
?>