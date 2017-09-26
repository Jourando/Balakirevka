<?php
// v.10.a.1::rollback revision
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
function chCode1($inStr) {
	return mb_convert_encoding($inStr,"Windows-1251","UTF-8");
}
function chCode2($inStr) {
	return mb_convert_encoding($inStr,"UTF-8","ASCII");
}
function chCode3($inStr) {
	return mb_convert_encoding($inStr,"UTF-8", "Windows-1251");
}
//где-то тут создаем массив $array[$i][$j] или читаем из файла (из базы данных), после чего начинаем формировать excel-файл
$pre='';
$md=-1;
if (ISSET($_GET['mode'])) {
	if ($_GET['mode']=='xls') {$md=1;}
	elseif ($_GET['mode']=='csv') {$md=2;}
	elseif ($_GET['mode']=='a') {$md=3;}
	elseif ($_GET['mode']=='upl') {$md=4;}
	elseif ($_GET['mode']=='load') {$md=5;}
	elseif ($_GET['mode']=='die') {$md=6;}
	elseif ($_GET['mode']=='insert') {$md=7;}
	elseif ($_GET['mode']=='show') {$md=0;}
	else {die('<pre>wrong qwery</pre>');}
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
            xlsWriteLabel($i,$j, chCode1($array[$i][$j])); 
			//в строку $i, в ячейку $j, записываем конвертированное в 1251 содержимое $array[$i][$j]
        }
    }
    xlsEOF(); // закрываем файл
}
}
if ($md==2) {
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
    header("Content-Disposition: attachment;filename=".($filename!=''?$filename:'file.csv'));
    header("Content-Transfer-Encoding: binary");
    for($i=0,$counti=count($array);$i<$counti;$i++){
        for($j=0,$countj=count($array[$i]);$j<$countj;$j++){
            echo chCode1($array[$i][$j]).";";
        }
		echo " \r\n";
    }
}
exit;
}
if ($md==3) {
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
    header("Content-Disposition: attachment;filename=".($filename!=''?$filename:'file.a'));
    header("Content-Transfer-Encoding: binary");
    for($i=0,$counti=count($array);$i<$counti;$i++){
		for($j=0,$countj=count($array[$i]);$j<$countj;$j++){
            if ($j<count($array[$i])-1) {
				echo $array[$i][$j]."|";
			} else {
				echo $array[$i][$j]."\r\n";
			}
		}
    }
}
exit;
}
if ($md==4) {
	// импорт 
?>
<HTML><HEAD>
<meta http-equiv="X-UA-Compatible" content="IE=edge"><meta charset="utf-8">
<TITLE>XLS CONVERT / ROLLBACK</TITLE>
<style>
td {border: 1px solid #ccc}
</style>
</HEAD>
<BODY>
<h2>Форма для загрузки csv</h2>
<form action="rollback_man3.php?mode=load&r=2240" method="post" enctype="multipart/form-data">
<Table border=0><tr><td><label>Для выбора файла нажмите <input type="file" name="filename"> <input type="submit" value="Upload CSV"></label></td></tr>
<tr><td><label><input type=radio checked=true name=RB1 value=Windows>WINDOWS</label><br><label><input type=radio name=RB1 value=Dos>DOS</label></td></tr>
<tr><td><h5>поддерживается только csv-формат!</h5></td></tr></Table>
</form>
<? include('toolmen.php'); ?>
</BODY></HTML>
<?
}
if ($_GET['me']=='self') {
?>
<SCRIPT>
location.href='rollback_man3.php?mode=show';
</SCRIPT>
<?
}
if ($md==5) {
	$r0=$_FILES["filename"]["name"];
	$r1 = 'valid csv-file';
	$r2 = 'invalid csv-file';
	$r3 = strtoupper($_POST['RB1']);
?>
<HTML><HEAD><meta charset="utf-8"><TITLE>Parse CSV</TITLE>
<Style>
th {border: 1px solid #000; background: silver}
</Style>
<Script>
function genlnk() {
<?
echo "var a1='".$r3."'; // Dos|Win\r\n";
echo "var a2='".$r0."'; // filename\r\n";
echo "var a3='2'; // args\r\n";
echo "var a4=document.getElementById('dps').selectedIndex; // раздел\r\n";
echo "var a5=document.getElementById('dfs').selectedIndex+1; // способ\r\n";
echo "a1='/test2.ru/rollback_man3.php?mode=insert&ft='+a1;\r\n";
echo "a2=a1+'&fn='+a2+'&arg='+a3+'&dp='+a4+'&method='+a5+'&r=928762';\r\n";
?>
location.href='http:/'+a2+"'";	
}
</Script>
</HEAD><BODY>
<?	
    if(is_uploaded_file($_FILES["filename"]["tmp_name"])) {
        // Если файл загружен успешно, перемещаем его из временной директории в конечную
        move_uploaded_file($_FILES["filename"]["tmp_name"], __DIR__ . DIRECTORY_SEPARATOR . $_FILES["filename"]["name"]);
		echo "<div>[".$r0." is ".((strtoupper(pathinfo($r0, PATHINFO_EXTENSION))=='CSV')?$r1:$r2)."]&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;".$_POST['RB1']."</div>";
		if (strtoupper(pathinfo($r0, PATHINFO_EXTENSION))=='CSV') {
				$flines = file($r0);
				$xfile="depart0000.a";
				$lines = file($xfile, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
				$i=0;
				$ptmp="<label>Укажите раздел, куда направить данные <select id=dps>";
				foreach($lines as $v) {
					list($mVal[$i], $mLable[$i])=explode("=", $lines[$i]);
					if ($i>0) {
						$ptmp=$ptmp."<option value=".$mVal[$i].">[".$mVal[$i]."] ".$mLable[$i]."</option>";
					} else {
						$ptmp=$ptmp."<option value=".$mVal[$i].">".$mLable[$i]."</option>";
					}
					$i=$i+1;
				}
				$ptmp=$ptmp."</select>&nbsp;&nbsp;&nbsp;";
				echo $ptmp;
				$ptmp="<select id=dfs><option value=1>Добавить в начало</option><option value=2>Заменить существующие</option><option value=3>Добавить в конец</option></select>";
				echo $ptmp;
				echo "<div>Если кодировка русского языка отображается некорректно, попробуйте вернуться <input type=button value=Назад Onclick='location.href=\"http://test2.ru/rollback_man3.php?mode=upl&r=2240\"'> и прочитать как ".(($r3=='DOS')?'Windows':'Dos')."-файл; если всё отображается корректно - нажмите <input type=button value=OK Onclick='genlnk()'> для запуска вставки данных</div><hr>";
				echo "<Table border=1>";
?>
<tr>
<th rowspan=2>номер</th><th rowspan=2>дата</th><th rowspan=2>вид деятельности</th><th colspan=3>мероприятие</th><th rowspan=2>место проведения</th><th colspan=4>охват</th><th colspan=3>проводящие</th><th rowspan=2>организационно-<br>финансовое</th><th rowspan=2>доп.<br>информация</th>
</tr><tr>
<th>тип</th><th>внутренние/сторонние</th><th>название</th><th>тип</th><th>целевая аудитория</th><th>зрители</th><th>выступающие/участники</th><th>отделение</th><th>нач.отделения</th><th>ответственный</th>
</tr>
<?
				for($i=0; $i<count($flines); $i++){
					$array[$i]=explode(";", $flines[$i]);
					echo "<tr>";
					for ($j=0; $j<count($array[$i])-1; $j++) {
						if ($r3=='WINDOWS') {
							echo "<td>".chCode3($array[$i][$j])."</td>";
						} else {
							echo "<td>".chCode2($array[$i][$j])."</td>";
						}
					}
					echo "</tr>";
				}
				echo "</Table>";
		}
		include('toolmen.php');
    } else {
        echo("<p>Ошибка загрузки файла<br>[<a href='http://test2.ru/rollback_man3.php?mode=upl&r=2111'>Перейти обратно</a>]</p>");
    }
		echo "</BODY></HTML>";
}
if ($md==6) {
	echo "<PRE>Please, choose one:
- <a href=http://test2.ru/rollback_man3.php?mode=show>Export</a>
- <a href=http://test2.ru/rollback_man3.php?mode=upl&r=9879890709>Import</a></PRE>";
	include('toolmen.php');
}
if ($md==7) {
echo "<HTML><HEAD><meta charset=\"utf-8\"><TITLE>Parse CSV</TITLE>";
echo "</HEAD><BODY>";
echo "<hr><hr><hr>";
// скопировать старый *.а в олд
$d=$_GET['dp'];
$method=$_GET['method'];
$xfile = 'depart'.str_pad($d, 4, "0", STR_PAD_LEFT).'.a';
if (!file_exists('oldata/'.str_pad($d, 4, "0", STR_PAD_LEFT))) { mkdir('oldata/'.str_pad($d, 4, "0", STR_PAD_LEFT), 0744, true); }
$f=scandir('oldata/'.str_pad($d, 4, "0", STR_PAD_LEFT));
$j=count($f)-1;
$newfile='oldata/'.str_pad($d, 4, "0", STR_PAD_LEFT).'/depart'.str_pad($d, 4, "0", STR_PAD_LEFT).'['.str_pad($j, 4, "0", STR_PAD_LEFT).']';
copy($xfile, $newfile);
$newfile=$_GET['fn'];
if (file_exists($newfile)) {
	$lines1=file($newfile);
	$lines2=file($xfile);
	(strtoupper($_GET['ft'])=='DOS'?$chtype='2':$chtype='3');
	for ($i=0; $i<count(lines1); $i++) {
		if ($chtype==2) {
			$lines1[$i]=chCode2($lines1[$i]);
		} elseif ($chtype==3) {
			$lines1[$i]=chCode3($lines1[$i]);
		} else {
			echo 'ERROR CHARSET';
		}
	}
	for ($i=0; $i<count($lines1); $i++) {
		list($n1[$i], $date1[$i], $vd1[$i], $acType1[$i], $acOwner1[$i], $acName1[$i], $acPlace1[$i], $oType1[$i], $oAud1[$i], $oSeer1[$i], $oPrt1[$i], $hostDep1[$i], $hostHead1[$i], $hostLd1[$i], $fin1[$i], $adInfo1[$i]) = explode(";", $lines1[$i]);
	}
	for ($i=0; $i<count($lines2); $i++) {
		list($n2[$i], $date2[$i], $vd2[$i], $acType2[$i], $acOwner2[$i], $acName2[$i], $acPlace2[$i], $oType2[$i], $oAud2[$i], $oSeer2[$i], $oPrt2[$i], $hostDep2[$i], $hostHead2[$i], $hostLd2[$i], $fin2[$i], $adInfo2[$i]) = explode(";", $lines2[$i]);
	}
	// здесь надо разбивать массив lines1, полученный из csv, не автоматом в другой абстрактный массив, а через list, чтобы отсечь, если в csv были лишние поля или их не хватало
	// вар.2 - используем array_splice($inputArray, 16); - убить все элементы массива, после 16 позиции
	// +проверка, если массив короче, то наоборот увеличиваем массив:  array_fill (0, 16-count($inputArray), " "); - дополнить нехватающую длину, забив ячейки пробелами
	$handle=fopen($xfile, 'w');
	if ($method=="1") {
		echo "<!-- добавить в начало -->";
		for ($i; $i<count($lines1); $i++) {
			fwrite($handle, " ".trim($n1[$i])."|".$date1[$i]."|".$vd1[$i]."|".$acType1[$i]."|".$acOwner1[$i]."|".$acName1[$i]."|".$acPlace1[$i]."|".$oType1[$i]."|".$oAud1[$i]."|".$oSeer1[$i]."|".$oPrt1[$i]."|".$hostDep1[$i]."|".$hostHead1[$i]."|".$hostLd1[$i]."|".$fin1[$i]."|".$adInfo1[$i]."\r\n");
		}
		for ($i; $i<count($lines2); $i++) {
			fwrite($handle, " ".trim($n2[$i])."|".$date2[$i]."|".$vd2[$i]."|".$acType2[$i]."|".$acOwner2[$i]."|".$acName2[$i]."|".$acPlace2[$i]."|".$oType2[$i]."|".$oAud2[$i]."|".$oSeer2[$i]."|".$oPrt2[$i]."|".$hostDep2[$i]."|".$hostHead2[$i]."|".$hostLd2[$i]."|".$fin2[$i]."|".$adInfo2[$i]."\r\n");
		}
	} elseif ($method=="2") {
		echo "<!-- заменить -->";
		for ($i; $i<count($lines1); $i++) {
			fwrite($handle, " ".trim($n1[$i])."|".$date1[$i]."|".$vd1[$i]."|".$acType1[$i]."|".$acOwner1[$i]."|".$acName1[$i]."|".$acPlace1[$i]."|".$oType1[$i]."|".$oAud1[$i]."|".$oSeer1[$i]."|".$oPrt1[$i]."|".$hostDep1[$i]."|".$hostHead1[$i]."|".$hostLd1[$i]."|".$fin1[$i]."|".$adInfo1[$i]."\r\n");
		}
	} elseif ($method=="3") {
		echo "<!-- добавить в конец -->";
		for ($i; $i<count($lines2); $i++) {
			fwrite($handle, " ".trim($n2[$i])."|".$date2[$i]."|".$vd2[$i]."|".$acType2[$i]."|".$acOwner2[$i]."|".$acName2[$i]."|".$acPlace2[$i]."|".$oType2[$i]."|".$oAud2[$i]."|".$oSeer2[$i]."|".$oPrt2[$i]."|".$hostDep2[$i]."|".$hostHead2[$i]."|".$hostLd2[$i]."|".$fin2[$i]."|".$adInfo2[$i]."\r\n");
		}
		for ($i; $i<count($lines1); $i++) {
			fwrite($handle, " ".trim($n1[$i])."|".$date1[$i]."|".$vd1[$i]."|".$acType1[$i]."|".$acOwner1[$i]."|".$acName1[$i]."|".$acPlace1[$i]."|".$oType1[$i]."|".$oAud1[$i]."|".$oSeer1[$i]."|".$oPrt1[$i]."|".$hostDep1[$i]."|".$hostHead1[$i]."|".$hostLd1[$i]."|".$fin1[$i]."|".$adInfo1[$i]."\r\n");
		}
	} else {
		echo "<!-- игнорить, ибо ".$method." -->";
	}
	fclose($handle);
}
	// удалить временный файл, загружаемый на сервер
echo "</BODY></HTML>";
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
function toCsv(a) {
if (a>0) {
	var dp='depart_'+a+'.csv';
	location.href='rollback_man3.php?d='+a+'&out='+dp+'&me=self&mode=csv';
}	
}
function toAbs(a) {
	var dp='depart_'+a+'.a';
	location.href='rollback_man3.php?d='+a+'&out='+dp+'&me=self&mode=a';
}
</SCRIPT>
<FORM>
<H4>Экспорт</H4>
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
$ptmp=$ptmp."</select> <input type=button value=toXLS OnClick='toXls(document.getElementById(\"dps\").selectedIndex)'><input type=button value=toCSV OnClick='toCsv(document.getElementById(\"dps\").selectedIndex)'><input type=button value=toABS OnClick='toAbs(document.getElementById(\"dps\").selectedIndex)'></label>\r\n";
echo $ptmp;
include('toolmen.php');
// импорт в этот же файл!!!
?>
</FORM>
</BODY></HTML>
<?
}
$stf=0;
// не объединить ли ф-ции toAbs, toXls, toCsv
?>
