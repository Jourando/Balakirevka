<?php
// v.10.a.4::bdman revision
$retr=false;
$dir = __DIR__;
$flag=1;
?>
<!DOCTYPE html>
<html lang="ru-RU">
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=0.65, maximum-scale=0.65, user-scalable=no">
<link rel="shortcut icon" type="image/x-icon" href="/favicon.ico">
<style>
input[type=submit]#ContSub, input[type=button] {width: 140px;}
</style>
<title>BD-man</title>
</head>
<body>
<?
if (($_GET['act']=="R") && ($_GET['p']=="show")) {
	echo "<p>Workdir is $dir</p>";
	$str1='<div>';
	$str2='<label>1. <input type=button value="Drop User BD" Onclick=location.href="bd_man.php?act=W&p=ubd&from=self"> Сбросить список пользователей</label><br>';
	$str3='<label>2. <input type=button value="Drop DP BD" Onclick=location.href="bd_man.php?act=W&p=dbd&from=self"> Сбросить список разделов</label><br>';
	$str4='<label>3. <input type=button value="Drop Data BD" Onclick=location.href="bd_man.php?act=W&p=xbd&from=self"> Сбросить список пользовательских документов</label><br>';
	$str5='<label>4. <input type=button value="Drop Settings" Onclick=location.href="bd_man.php?act=W&p=ds&from=self"> Сбросить список настроек</label><br>';
	$str6='<label>5. <input type=button value="Edit Departments" Onclick=location.href="bd_man.php?act=W&p=itmr&from=me"> Редактировать список разделов</label>';
	$str7='</div>';
	echo $str1.$str2.$str3.$str4.$str5.$str6.$str7;
	include('toolmen.php');
}
if ($_GET['act']=="W") {
	if ($_GET['p']=="ubd") {
		$tmpStr="999:ADM:".md5('ADM').":";
		$tmpStr=$tmpStr.crc32($tmpStr)."\r\n";
		$handle = fopen('username.a', 'w');
		fwrite($handle, $tmpStr);
		fclose($handle);
	}
	if ($_GET['p']=="dbd") {
		$d="0";
		$xfile = 'depart'.str_pad($d, 4, "0", STR_PAD_LEFT).'.a';
		if (!file_exists('oldata/'.str_pad($d, 4, "0", STR_PAD_LEFT))) { mkdir('oldata/'.str_pad($d, 4, "0", STR_PAD_LEFT), 0744, true); }
		$f=scandir('oldata/'.str_pad($d, 4, "0", STR_PAD_LEFT));
		$j=count($f)-1;
		$newfile='oldata/'.str_pad($d, 4, "0", STR_PAD_LEFT).'/depart'.str_pad($d, 4, "0", STR_PAD_LEFT).'['.str_pad($j, 4, "0", STR_PAD_LEFT).']';
		copy($xfile, $newfile);
		$handle = fopen($xfile, 'w');
		fwrite($handle, "0= \r\n");
		fclose($handle);
	}
	if ($_GET['p']=="xbd") {
		$f = glob("depart*.a");
		for ($i=1; $i<count($f); $i++) {
				$handle = fopen($f[$i], 'w');
				fwrite($handle, " 0|||||||||||||||\r\n"); // проверить кол-во полей. А лучше - скопировать из файла-образца!
				fclose($handle);
		}
	}
	if ($_GET['p']=="ds") {
		list($tmpStr, $trash)=file('wrkspace.a');
		$rd="rd='sh_tab_xls_v';";
		$urlStr="urlStr='".$tmpStr."/auth.php?';";
		$datStr="datStr='".$tmpStr."/writ2.php?';";
		$logStr="logStr='".$tmpStr."/actlog.php?';";
		$dm="depMod=0;";
		$cm="curMod=0;";
		$s1="hdrStr='<tr><th rowspan=2>номер</th><th rowspan=2>дата</th><th rowspan=2>вид деятельности</th><th colspan=3>мероприятие</th><th rowspan=2>место проведения</th><th colspan=4>охват</th><th colspan=3>проводящие</th><th rowspan=2>организационно-<br>финансовое</th><th rowspan=2>доп.<br>информация</th>';\r\nhdrStr+='</tr><tr><th>тип</th><th>внутр./сторонние</th><th>название</th><th>тип</th><th>целевая аудитория</th><th>зрители</th><th>выступающие/участники</th><th>отделение</th><th>нач.отделения</th><th>ответственный</th></tr>';";
		$s2="edtStr='<tr><td id=et0><input type=text id=ext0 value=0 size=3 disabled></td><td id=et1><input type=text id=ext1 size=5 value=\"\"></td><td id=et2><input type=text id=ext2 value=\"\" size=24></td><td id=et3><input type=text id=ext3 value=\"\" size=12></td><td id=et4><input type=text id=ext4 value=\"\" size=12></td><td id=et5><input type=text id=ext5 value=\"\" size=14></td><td id=et6><input type=text id=ext6 value=\"\" size=20></td>';";
		$s3="edtStr+='<td id=et7><input type=text id=ext7 value=\"\" size=8></td><td id=et8><input type=text id=ext8 value=\"\" size=12></td><td id=et9><input type=text id=ext9 value=\"\" size=8></td><td id=et10><input type=text id=ext10 value=\"\" size=12></td><td id=et11><input type=text id=ext11 value=\"\" size=12></td><td id=et12><input type=text id=ext12 value=\"\" size=12></td>';";
		$s4="edtStr+='<td id=et13><input type=text id=ext13 value=\"\" size=12></td><td id=et14><input type=text id=ext14 value=\"\" size=14></td><td id=et15><input type=text id=ext15 value=\"\" size=10></td></tr>';";
		$s5="edtStr+='<tr><td colspan=16><lavel>Вставить строку <input type=button value=Перед Onclick=ItmInsBefore()> <input type=button value=Вместо Onclick=ItmReplace()> <input type=button value=После Onclick=ItmInsAfter()> текущей, <input type=button value=Удалить Onclick=ItmDelete()> всю строку или <input type=button value=Закрыть Onclick=modalClose(document.getElementById(\\'hid\\').value)> без сохранения <input type=hidden value=x id=hid></label></td></tr>';";
		$handle = fopen('globals2.js', 'w');
		fwrite($handle, $rd."\r\n".$urlStr."\r\n".$datStr."\r\n".$logStr."\r\n".$dm."\r\n".$cm."\r\n");
		fwrite($handle, $s1."\r\n".$s2."\r\n".$s3."\r\n".$s4."\r\n".$s5);
		fclose($handle);
		$handle = fopen('oldata\opt.a', 'w');
		fwrite($handle, "1");
		fclose($handle);
	}
	if ($_GET['p']=="itmr") {
		echo "<h4>Редактор разделов</h4>\r\n";
		echo "<form action=\"bd_man.php?act=W&p=itmw&lmk=233405&r=123\" method=post>\r\n";
		$lines=file("depart0000.a");
		echo "<textarea name=cont style=\"width: 540px; height: 400px;\">";
		for ($i=0; $i<count($lines); $i++) {
			echo $lines[$i];
		}
		echo "</textarea><br><div style=\"display: inline-block; margin-left: 250px\"><input type=submit id=ContSub value=Send> <input type=button value=Cancel Onclick=\"location.href='bd_man.php?act=R&p=show&from=self'\"></div>\r\n</form>\r\n";
		include('toolmen.php');
	}
	if ($_GET['p']=="itmw") {
		if (ISSET($_GET['lmk'])) {
			if ($_POST['cont']=='') {
				echo "<h3>Ошибка! Сброс файла depart0000.a на дефолтное значение!</h3>\r\n<script>\nlocation.href='bd_man.php?act=W&p=dbd&from=self';\n</script>\n";
			} else {
				echo "<h3>Запись новых данных в depart0000.a</h3>\r\n";
				$d="0";
				$xfile = 'depart0000.a';
				if (!file_exists('oldata/'.str_pad($d, 4, "0", STR_PAD_LEFT))) { mkdir('oldata/'.str_pad($d, 4, "0", STR_PAD_LEFT), 0744, true); }
				$f=scandir('oldata/'.str_pad($d, 4, "0", STR_PAD_LEFT));
				$j=count($f)-1;
				$newfile='oldata/'.str_pad($d, 4, "0", STR_PAD_LEFT).'/depart'.str_pad($d, 4, "0", STR_PAD_LEFT).'['.str_pad($j, 4, "0", STR_PAD_LEFT).']';
				copy($xfile, $newfile);
				$xt=$_POST['cont'];
				$handle = fopen($xfile, 'w');
				fwrite($handle, $xt);
				fclose($handle);
				echo "<h3>...успешно завершена</h3><br><br>\r\n";
				echo "<div style=\"display: inline-block; cursor: pointer; border: 1px dotted #000; font-size: 14px; width: 180px;\" Onclick=\"location.href='bd_man.php?act=R&p=show&from=self'\">Вернуться в меню</div> или <div style=\"display: inline-block; cursor: pointer; border: 1px dotted #000; font-size: 14px; width: 280px;\" Onclick=\"location.href='bd_man.php?act=W&p=itmr&from=me'\">К просмотру содержимого depart0000.a</div>\r\n";
				include('toolmen.php');
			}
		} else {
			echo "<script>\nlocation.href='bd_man.php?act=R&p=show&from=self';\n</script>\n";
		}
	}
	if ($_GET['from']=='self') {
		echo "<script>\nlocation.href='bd_man.php?act=R&p=show&from=self';\n</script>\n";
	}
}
if ($_GET['act']=="A") {
	if ($_GET['p']=="rollback") {
//		if ($_GET['d']=="d0") {
			$xfile="depart0000.a";
			$lines = file($xfile, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
			$i=0;
			echo "<h3>Rollback archive</h3>";
			echo "<label>Выбираем отдел <select id=dps Onchange='depMod=this.selectedIndex'>\r\n";
			foreach($lines as $v) {
				list($mVal[$i], $mLable[$i])=explode("=", $lines[$i]);
				if ($i>0) {$resStr[$i]="<option value=".$mVal[$i].">[".$mVal[$i]."] ".$mLable[$i]."</option>\r\n";}
				else {$resStr[$i]="<option value=".$mVal[$i].">".$mLable[$i]."</option>\r\n";}
				echo $resStr[$i];
				$i++;
			}
			echo "</select></label>\r\n";
//		}
		echo "<div></div>\r\n";	
	}
}
echo "<div>&nbsp;</div>\r\n";
echo "</body>\r\n</html>\r\n";
?>