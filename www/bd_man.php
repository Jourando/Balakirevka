<?php
// v.10.a.5::bdman revision
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
	$str6='<label>5. <input type=button value="Edit Departments" Onclick=location.href="bd_man.php?act=W&p=itmr&from=me"> Редактировать список разделов</label><br>';
	$str7='<label>6. <input type=button value="Clean Backups" Onclick=location.href="bd_man.php?act=Z&p=arch&from=me"> Почистить старые бэкапы документов</label>';
	$str8='</div>';
	echo $str1.$str2.$str3.$str4.$str5.$str6.$str7.$str8;
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
			$xfile='depart'.str_pad($i, 4, "0", STR_PAD_LEFT).'.a';
			if (FILE_EXISTS('store/depart')) {
				unlink($xfile);
				usleep(100);
				copy('store/depart', $xfile);
			} else {
				$handle = fopen($xfile, 'w');
				fwrite($handle, " 0||||||||||||||||||\r\n");
				fclose($handle);
			}
		}
	}
	if ($_GET['p']=="ds") {
		unlink('globals2.js');
		usleep(100);
		copy('store/inpart', 'globals2.js');
		$handle = fopen('oldata/opt.a', 'w');
		fwrite($handle, "1");
		fclose($handle);
	}
	if ($_GET['p']=="itmr") {
		echo "<h4>Редактор разделов</h4>\r\n";
		echo "<form action=\"bd_man.php?act=W&p=itmw&lmk=233405&r=123\" method=post>\r\n";
		$lines=file("depart0000.a");
		echo "<textarea name=cont style=\"width: 540px; height: 420px;\">";
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
		echo "<div></div>\r\n";	
	}
}
if ($_GET['act']=="Z") {
// arch	
}
echo "<div>&nbsp;</div>\r\n";
echo "</body>\r\n</html>\r\n";
?>