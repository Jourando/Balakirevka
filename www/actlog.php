<?php
// v.10.a.3::log revision
$mc=0;
$a="";
$xfile = 'log/actlog.txt';
$usr = 'guest';
$pg = '-';
$obj = '-';
$exc = '-';
$type = 'ajax';
$code = '0';
$fnc = 'noname';
$u_var = 'undefined';
$u_val = 'undefined';
$fa = 'ECHO';
// &act=ACTL&u=[username]&doc=[page]&obj=[object]&e=[action]&t=[event]&c=[code] --> actlog
// &act=VARL&f=[function_name]&doc=[page]&v1=[var_name]&v2=[var_value] --> varlog
// &act=FILEL&u=[username]&doc=[page]&fa=[fileact: CreateFile, Read, Write, DeleteFile, MakeDir, ScanDir, RenameFile, RenameDir, Drop, Zip, Echo]
// (CreateFile) CF	&fn1=[filename]
// (ReadFile) RF	&fn1=[filename]&v2=[read_string]
// (WriteFile) WF	&fn1=[filename]&v2=[write_string]
// (DeleteFile) DF	&fn1=[filename]
// (MakeDir) MD		&fn1=[dirname]
// (ScanDir) SD		&fn1=[dirname]
// (MoveFile, RenameFile) MF	&fn1=[old_filename]&fn2=[new_filename]
// (MoveDir, RenameDir) RD		&fn1=[old_dir]&fn2=[new_dir]
// (Drop) DBD		&fn1=[bd_name]
// (Compress) ZIP	&fn1=[filelist]&fn2=[zip.arch]&fn3=[workdir]
// (Comment) ECHO	&v1=[string]
// (Operation Result) OPR		&v1=[result_code]&v2=[result_string]
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
}
if ($_GET['act']=='VARL') {		// var log
	if (ISSET($_GET['f'])) {	// function name
		$fnc = $_GET['f'];
	}
	if (ISSET($_GET['doc'])) {	// page
		$pg = $_GET['doc'];
	}
	if (ISSET($_GET['v1'])) {	// var name
		$u_var = $_GET['v1'];
	}
	if (ISSET($_GET['v2'])) {	// var value
		$u_val = $_GET['v2'];
	}
	$a = "{variable ".$u_var."=".$u_val." -- from function ".$fnc." from ".$pg."}\r\n";
}
if ($_GET['act']=='FILEL') {		// file log
	if (ISSET($_GET['fa'])) {		// file action: CreateFile, Read, Write, DeleteFile, MakeDir, ScanDir, RenameFile, RenameDir, Drop, Zip, Echo
		if (ISSET($_GET['u'])) {	// actor (user)
			$usr = $_GET['u'];
		}
		$tm = date("d m Y H:i:s");	// act time
		if (ISSET($_GET['doc'])) {	// page
			$pg = $_GET['doc'];
		}
		$fa=$_GET['fa'];
		if ((strtoupper($fa)=="CREATEFILE") || (strtoupper($fa)=="CF")) {
			(ISSET($_GET['fn1'])?$a=$_GET['fn1']:$a='?')
			$a=$usr." @ ".$tm." from ".$pg." : action CreateFile [".$a."]\r\n";
		} elseif ((strtoupper($fa)=="READFILE") || (strtoupper($fa)=="READ") || (strtoupper($fa)=="RF")) {
			(ISSET($_GET['fn1'])?$a=$_GET['fn1']:$a='?')
			(ISSET($_GET['v2'])?$u_val=$_GET['u_val']:$u_val='{empty}')
			$a=$usr." @ ".$tm." from ".$pg." : action ReadFile [".$a."], datastring: ".$u_val."\r\n";
		} elseif ((strtoupper($fa)=="WRITEFILE") || (strtoupper($fa)=="WRITE") || (strtoupper($fa)=="WF")) {
			(ISSET($_GET['fn1'])?$a=$_GET['fn1']:$a='?')
			(ISSET($_GET['v2'])?$u_val=$_GET['u_val']:$u_val='{empty}')
			$a=$usr." @ ".$tm." from ".$pg." : action WriteFile [".$a."], datastring: ".$u_val."\r\n";
		} elseif ((strtoupper($fa)=="DELETEFILE") || (strtoupper($fa)=="DELFILE") || (strtoupper($fa)=="DELETE") || (strtoupper($fa)=="DEL") || (strtoupper($fa)=="DF")) {
			(ISSET($_GET['fn1'])?$a=$_GET['fn1']:$a='?')
			$a=$usr." @ ".$tm." from ".$pg." : action DeleteFile [".$a."]\r\n";
		} elseif ((strtoupper($fa)=="ERASEFILE") || (strtoupper($fa)=="ERASE") || (strtoupper($fa)=="EF")) {
			(ISSET($_GET['fn1'])?$a=$_GET['fn1']:$a='?')
			$a=$usr." @ ".$tm." from ".$pg." : action EraseFile [".$a."]\r\n";
		} elseif ((strtoupper($fa)=="MAKEDIR") || (strtoupper($fa)=="MAKE") || (strtoupper($fa)=="MD")) {
			(ISSET($_GET['fn1'])?$a=$_GET['fn1']:$a='?')
			$a=$usr." @ ".$tm." from ".$pg." : action MakeDirectory [".$a."]\r\n";
		} elseif ((strtoupper($fa)=="SCANDIR") || (strtoupper($fa)=="SD")) {
			(ISSET($_GET['fn1'])?$a=$_GET['fn1']:$a='?')
			$a=$usr." @ ".$tm." from ".$pg." : action ScanDirectory [".$a."]\r\n";
		} elseif ((strtoupper($fa)=="MOVEFILE") || (strtoupper($fa)=="MOVE") || (strtoupper($fa)=="RENAMEFILE") || (strtoupper($fa)=="RENAME") || (strtoupper($fa)=="MF")) {
			(ISSET($_GET['fn1'])?$a=$_GET['fn1']:$a='?')
			(ISSET($_GET['fn2'])?$u_val=$_GET['fn2']:$u_val='?')
			$a=$usr." @ ".$tm." from ".$pg." : action MoveFile or RenameFile [".$a."] to [".$u_val."]\r\n";
		} elseif ((strtoupper($fa)=="MOVEDIR") || (strtoupper($fa)=="RENAMEDIR") || (strtoupper($fa)=="RD")) {
			(ISSET($_GET['fn1'])?$a=$_GET['fn1']:$a='?')
			(ISSET($_GET['fn2'])?$u_val=$_GET['fn2']:$u_val='?')
			$a=$usr." @ ".$tm." from ".$pg." : action MoveDir or RenameDir [".$a."] to [".$u_val"]\r\n";
		} elseif ((strtoupper($fa)=="DROP") || (strtoupper($fa)=="DBD")) {
			(ISSET($_GET['fn1'])?$a=$_GET['fn1']:$a='?')
			$a=$usr." @ ".$tm." from ".$pg." : action Drop BD [".$a."] to EmptyRec\r\n";
		} elseif (strtoupper($fa)=="ZIP") {
			(ISSET($_GET['fn1'])?$a=$_GET['fn1']:$a='?')			// массив файлов
			(ISSET($_GET['fn2'])?$u_val=$_GET['fn2']:$u_val='?') 	// имя зипа
			(ISSET($_GET['fn3'])?$u_var=$_GET['fn3']:$u_var='?') 	// директория
			$a=$usr." @ ".$tm." from ".$pg." : action Compress [".$a."] to [".$u_val"], working directory is [".$u_var."]\r\n";
		} elseif (strtoupper($fa)=="ECHO") {
			(ISSET($_GET['v1'])?$a=$_GET['v1']:$a='?')
			$a=$usr." @ ".$tm." from ".$pg." : action Comment [".$a."]\r\n";
		} elseif (strtoupper($fa)=="OPR") {
			(ISSET($_GET['v1'])?$a=$_GET['v1']:$a='0')
			$a="Operation result: [code: ".$a."]";
			(ISSET($_GET['v2'])?$a=$_GET['v2']:$a='')
			$a=$a."[Resolved as '".$a."']\r\n";
		} else {
			$a=$usr." @ ".$tm." from ".$pg." : action Do unknown action, it seems like an error\r\n";
		}
	}
}
if ($_GET['act']=='ERRL') { // error log
	$tm = date("d m Y H:i:s");	// act time
	if (ISSET($_GET['doc'])) {	// page
		$pg = $_GET['doc'];
	}
	$a="@System met an error at ".$tm." at page ".$pg.": ".$_GET['v1']." at line ".$_GET['v2']."; \r\n";
}
$handle = fopen($xfile, 'a');
fwrite($handle, $a);
fclose($handle);
?>