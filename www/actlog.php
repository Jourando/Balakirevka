<?php
// формат: Время, юзер, с какой стр., c какого объекта, какое действие, тип, успех или код ошибки
// формат: Ф-ция, имя переменной, знач. переменной
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
if ($_GET['act']=='ACTL') {
	$tm = date("d m Y H:i:s");
	if (ISSET($_GET['u'])) {
		$usr = $_GET['u'];
	}
	if (ISSET($_GET['doc'])) {
		$pg = $_GET['doc'];
	}
	if (ISSET($_GET['obj'])) {
		$obj = $_GET['obj'];
	}
	if (ISSET($_GET['e'])) {
		$exc = $_GET['e'];
	}
	if (ISSET($_GET['t'])) {
		$type = $_GET['t'];
	}
	if (ISSET($_GET['c'])) {
		$code = $_GET['c'];
	}
	$a = $usr." @ ".$tm." from ".$pg." : action ".$exc." on obj ".$obj." via ".$type."... Result code is ".$code."\r\n";
	$handle = fopen($xfile, 'a');
	fwrite($handle, $a);
	fclose($handle);
}
if ($_GET['act']=='VARL') {
	if (ISSET($_GET['f'])) {
		$fnc = $_GET['f'];
	}
	if (ISSET($_GET['v1'])) {
		$u_var = $_GET['v1'];
	}
	if (ISSET($_GET['v2'])) {
		$u_val = $_GET['v2'];
	}
	$a = "{variable ".$u_var."=".$u_val." --- from function ".$fnc."}\r\n";
}
$handle = fopen($xfile, 'a');
fwrite($handle, $a);
fclose($handle);
?>