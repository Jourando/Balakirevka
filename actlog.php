<?php
// actlog
// формат: Время, юзер, с какой стр., c какого объекта, какое действие, тип, успех или код ошибки
$xfile = 'actlog.txt';
$usr = 'guest';
$pg = '-';
$obj = '-';
$exc = '-';
$type = 'ajax';
$code = '0';
if ($_GET['act']=='WL') {
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
	$a = $usr." @ ".$tm." from ".$pg." : action ".$exc." on obj ".$obj." via ".$type."... Result is ".$code."\r\n";
	$handle = fopen($xfile, 'a');
	fwrite($handle, $a);
	fclose($handle);
}
?>