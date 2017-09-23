<?php
function xlsBOF() {
    echo pack("ssssss", 0x809, 0x8, 0x0, 0x10, 0x0, 0x0);
    return;
}
function xlsEOF() {
    echo pack("ss", 0x0A, 0x00);
    return;
}
function xlsWriteNumber($Row, $Col, $Value) {
    echo pack("sssss", 0x203, 14, $Row, $Col, 0x0);
    echo pack("d", $Value);
    return;
} 
function xlsWriteLabel($Row, $Col, $Value ) {
    $L = strlen($Value);
    echo pack("ssssss", 0x204, 8 + $L, $Row, $Col, 0x0, $L);
    echo $Value;
    return;
}
function chCode($inStr) {
	return mb_convert_encoding($inStr,"Windows-1251","UTF-8");
}
//где-то тут создаем массив $array[$i][$j] или читаем из файла (из базы данных), после чего начинаем формировать excel-файл
$pre='';
if (ISSET($_GET['mode'])) {
	if ($_GET['mode']=='xls') {$md=1;}
	elseif ($_GET['mode']=='csv') {$md=2;}
	elseif ($_GET['mode']=='a') {$md=3;}
	elseif ($_GET['mode']=='show') {$md=0;}
	else {die('wrong qwery');}
}
if ($md==1) {
if ((ISSET($_GET['f'])) || (ISSET($_GET['d']))) {
	if (ISSET($_GET['f'])) {
		$fn=$pre.$_GET['f'];
		IF (!FILE_EXISTS($fn)) {$fn=$fn.".a";}
		IF (!FILE_EXISTS($fn)) {die('no file(s) found');}
	} else {
		$fn='depart'.str_pad($_GET['d'], 4, "0", STR_PAD_LEFT);
		if ((ISSET($_GET['old'])) && (ISSET($_GET['back']))) {$pre='oldata/'.str_pad($_GET['d'], 4, "0", STR_PAD_LEFT).'/';}
		else {$pre='';}
		if (($pre !== '') && (ISSET($_GET['back']))) {
			$fn=$pre.$fn.'['.str_pad($_GET['back'], 4, "0", STR_PAD_LEFT).']';
		}
		IF (!FILE_EXISTS($fn)) {$fn=$fn.".a";}
		IF (!FILE_EXISTS($fn)) {die('no file(s) found');}
	}
	$ax = file($fn, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
	for ($i=0; $i<count($ax); $i++) {
		$array[$i]=explode("|", $ax[$i]);
	}
	if (ISSET($_GET['out'])) {
			$filename=$_GET['out'];
	} else {
			$filename='';
	}
    header("Content-Type: application/force-download");
    header("Content-Type: application/octet-stream");
    header("Content-Type: application/download");;
    header("Content-Disposition: attachment;filename=".($filename!=''?$filename:'file.xls'));
    header("Content-Transfer-Encoding: binary");
    xlsBOF(); //пишем начало файла
    for($i=0,$counti=count($array);$i<$counti;$i++){ //количество строк
        for($j=0,$countj=count($array[$i]);$j<$countj;$j++){ //количество ячеек
			// если колонка = [список колонок, которые отдаются как числовые], то xlsWriteNumber
			// иначе...
            xlsWriteLabel($i,$j, chCode($array[$i][$j])); 
			//в строку $i, в ячейку $j, записываем конвертированное в 1251 содержимое $array[$i][$j]
        }
    }
    xlsEOF(); // закрываем файл
}
}
if ($md==2) {
	
}
if ($md==3) {
	
}
if ($_GET['me']=='self') {
?>
<SCRIPT>
location.href='rollback_man3.php?mode=show';
</SCRIPT>
<?
}
if ($md==0) {
?>
<HTML><HEAD>
<meta http-equiv="X-UA-Compatible" content="IE=edge"><meta charset="utf-8">
<TITLE>XLS CONVERT / ROLLBACK</TITLE>
</HEAD>
<BODY>
<SCRIPT>
function toXls(a){
if (a>0) {
	var dp='depart_'+a+'.xls';
	location.href='rollback_man3.php?d='+a+'&out='+dp+'&me=self&mode=xls';
}
}
</SCRIPT>
<FORM>
<H4></H4>
<?
$xfile="depart0000.a";
$lines = file($xfile, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
$i=0;
$ptmp="<label>Укажите раздел <select id=dps>";
foreach($lines as $v) {
	list($mVal[$i], $mLable[$i])=explode("=", $lines[$i]);
	if ($i>0) {
		$ptmp=$ptmp."<option value=".$mVal[$i].">[".$mVal[$i]."] ".$mLable[$i]."</option>";
	} else {
		$ptmp=$ptmp."<option value=".$mVal[$i].">".$mLable[$i]."</option>";
	}
	$i=$i+1;
}
$ptmp=$ptmp."</select> <input type=button value=toXLS OnClick='toXls(document.getElementById(\"dps\").selectedIndex)'><input type=button value=toCSV></label>\r\n";
echo $ptmp;
include('toolmen.php');
?>
</FORM>
</BODY></HTML>
<?
}
$stf=0;
?>