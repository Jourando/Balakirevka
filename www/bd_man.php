<?php
// v.10.a.6::bdman revision
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
.delBtn, .eyeBtn {height:26px; width:32px;display: inline-block;border: 1px solid #333;padding: 0px;margin: 0px;cursor: pointer}
.delBtn {background:url('data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAACAAAAAaCAIAAABZ+cloAAAAAXNSR0IArs4c6QAAAARnQU1BAACxjwv8YQUAAAAJcEhZcwAADsMAAA7DAcdvqGQAAAFTSURBVEhLrZaxcsIwDIYDGyusdKMLxzuwMjPRY+qx8wLtkAFegJ1j6pWJJ2HkupStXcvKmCqVamRHkh3gu9whEfv/bTmx0yiK4vTwmP3R/vrE4Ea4YOOn28MEud3DqSNN+v0nuF2XavdwBsgV89BG5q1BQLqNoVCWSBNKLJc9vnIGmGvtOt9HiiqI5QX4iC8GiGjz8b6hiNF/eqbIJ6hH+BSJ5apqJaoDoQGgeThRTX01m1LEEAwAre7chgM11LrIBsPRfjzYUhIDWr4uW9CFch/ZAEnxiLaxDBYvZ/H5QeAWXNAGLvpLwjIAtPUEjFscyyAqoa05RzXYHSYUxbA9BAN4mUV1LDolPsZoQgNtR3LSdT28vSiqzhErU90FyKCWtCPFwzpwUl40rTLORj4ygfStwvZQz+Q8zylJYL5+o8gHdO722SLWuTTga3C1uiOUyrJf4mirjZa/T+kAAAAASUVORK5CYII=');}
.eyeBtn {background:url('data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAACAAAAAaCAIAAABZ+cloAAAAAXNSR0IArs4c6QAAAARnQU1BAACxjwv8YQUAAAAJcEhZcwAADsMAAA7DAcdvqGQAAAJ/SURBVEhLpVY9j2lRFL1vKolGR0mpkCj9BD9BSadV0rySTqlQML+BhGgIhYiEBBmiEImWREGYjMSsa53Zc9yvmZe3imudc/dZa59t33Ovcf8/rNdrxVzwYrhjPp9Pp1MLxxWck+CHw4HcDV4GsVjs/f2duuDn8xkEV3AQzONuIpEwQ5+NdTgY6IljPXUBn88nVwDzVL/dbjSjsRWqVPf7bDabTCbkw+EQ/OPjg7zX64XDYcaD1Go1BGOewYg8nU7CcYucePqTqUuONW9vb61WS6TtwK1Op6M7CReYBvbcQbylLbA4AbIVtQM992636yidzWaLxaIauAALUUB9K4Y08ng8dssa0ozR4WaGLkCKKggGzP2fpC2wO8GDjTAYDMwSwTAQCKibD6RSqcvlwvW/h+5ED0walUpFzX3BI2s8Iv1+Xw2cYPf4g8pst1tOQdruRywWi9FotN/vsTOsTCaT8Xhc3XtGqVTK5/PkiHy5Xq8clMtlN3VgtVrtdjuog2NJs9nkvB2hUEgKjsiX4/HIQS6Xi0Qi9XqdQwuCwaBiDzim3263oZDJZETThKUH5M+xAy3x94FGo6GmvuDRhGYXLZfLdDqt5h7g88LFPwLqHk1oyFNnb+ff2CDAoo6s9beQgQcYPzg4N5uN3QNwtHGsifS3fvCYJeImeOSCO3aI2HiUW08cgjztTQNuApByAY67cUS1WmXF9cSRLrk6TQFdHcAQh4m3zevrKyJ1XXQaCYB5KHwbyD4A3QycRSsUCtQFWG6RE6KbEd8GAtiKOuooXFSk1rouKw7oiQIOBjqQjrxv7fkK4fuV3IIfvovwreD3+znEQ+5GEBONRsmfYBif308PWgoE+2sAAAAASUVORK5CYII=');}
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
	$str7='<label>6. <input type=button value="Manage Backups" Onclick=location.href="bd_man.php?act=Z&p=arch&from=me"> Управлять долгосрочными бэкапами документов</label>';
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
	if ($_GET['p']=='arch') {
		echo "<h3>Долгосрочный архив откатов</h3>\r\n";
		$str1='<div>';
		$str2='<label>1. <input type=button value="View | Download" Onclick=location.href="bd_man.php?act=Z&p=dl"> Просмотр и скачивание</label><br>';
		$str3='<label>2. <input type=button value="Arch | Erase" Onclick=location.href="bd_man.php?act=Z&p=er"> Архивация и очистка</label><br>';
		$str4='<label>3. <input type=button value="Step back" Onclick=location.href="bd_man.php?act=R&p=show&from=self"> Назад</label><br>';
		$str5='</div>';
		echo $str1.$str2.$str3.$str4;
		include('toolmen.php');
	} elseif ($_GET['p']=='er') {
		include('linelim.php');
		function killDir($wdir, $except) {
			$f=scandir($wdir);
			for ($i=1; $i<count($f); $i++) {
				if (($f[$i]!=='.') && ($f[$i]!=='..')) {
					if ($f[$i]!==$except) {
						unlink($wdir.$f[$i]);
						echo "add ".$f[$i]." to arch, then remove<br>\r\n";
					} else {
						echo "add ".$f[$i]." to arch<br>\r\n";
					}
				}
			}
		}
		$tmpstr=date("l, Y.d.m H:i:s");
		if (!file_exists('oldata/LONG')) {mkdir('oldata/LONG', 0744, true);}
		$zip = new ZipArchive();
		$filename="oldata/LONG/back_".time().".zip";
		if ($zip->open($filename, ZipArchive::CREATE)!==TRUE) {exit("Невозможно открыть <".$filename.">\r\n");}
		else {
			for ($i=0; $i<$deplimit; $i++) {
				$zip->addGlob('oldata/'.str_pad($i, 4, "0", STR_PAD_LEFT).'/*');
			}
			$zip->setArchiveComment('Backup files, created before '.$tmpstr); 
			$zip->close();
			echo "<div style='border: 1px solid #999; width: 540px; background: #000; color: #fff'>Файлы, которые были включены в архив <a href=".$filename." style='color: gold'>".$filename."</a>:</div>\r\n";
			echo "<div style='border: 1px solid #999; height: 320px; width: 540px; overflow: scroll;'>";
			for ($j=0; $j<$deplimit; $j++) {
				if (is_dir('oldata/'.str_pad($j, 4, "0", STR_PAD_LEFT))) {
					killDir('oldata/'.str_pad($j, 4, "0", STR_PAD_LEFT).'/', 'depart'.str_pad($j, 4, "0", STR_PAD_LEFT).'[0001]');
				}
			}
			echo "</div>\r\n";
			echo "<div style='border: 1px solid #999; width: 540px; background: #000; text-align: center;'><label><input type=button value='Продолжить' onclick=location.href='bd_man.php?act=Z&p=arch&from=me'></label></div>\r\n";
		}
	} elseif ($_GET['p']=='dl') {
		$wdir='oldata/LONG/';
		include('linelim.php');
		$f=scandir($wdir);
?>
<script>
function fcontx(b, a) {
var addStr='';
console.log(b);
if (a==1) {addStr='div';}
else if (a==2) {addStr='block';}
else if (a==3) {(addStr='file')}
var el=document.getElementById(b+addStr);
(el.style.display=='none')?el.style.display='block':el.style.display='none';
}
</script>
<Table>
<tr><td valign=top>
<?
		for ($i=1; $i<count($f); $i++) {
			if (($f[$i]!=='.') && ($f[$i]!=='..')) {
				echo "<div style='background: lightblue; border: 1px solid #000; padding: 0px; margin: 0px;'>".$f[$i]."&nbsp;&nbsp;&nbsp;<div class=eyeBtn id=n".$i." Onclick='fcontx(this.id, 3)'> </div> <div class=delBtn Onclick=location.href='bd_man.php?act=Z&p=xx&f=".$f[$i]."' id=d".$i."> </div></div>\r\n";
			}
		}
		echo "</td><td valign=top>\r\n";
		for ($i=1; $i<count($f); $i++) {
			if (($f[$i]!=='.') && ($f[$i]!=='..')) {
				$xfile=$wdir.$f[$i];
				$za = new ZipArchive();
				$zip = zip_open($xfile);
				$za->open($xfile);
				if ($zip) {
					echo "<DIV id=n".$i."file style='display: none'>Архив [<a href=".$xfile." style='text-decoration: none'>".$xfile."</a>] содержит:<br>Внутреннее имя ресурса: ".$zip."<br>Дата создания: ".date("Y/m/d H:i:s", filemtime($xfile))."<br>Размер архива: ".filesize($xfile)." byte(s)<br>Число доступных файлов-записей: ".$za->numFiles."<br>Статус/системный статус: ".$za->status."/".$za->statusSys."<br>Список комментариев: ".$za->comment."<br>[<a href=# id=zip".$i." onclick='fcontx(this.id, 2)' style='text-decoration: none'>Подробнее</a>]\r\n";
					$k=0;
					echo "<div id=zip".$i."block style='display: none'>\r\n";
					while ($zip_entry = zip_read($zip)) {
						$k=$k+1;
						echo "<div style='width:462px; border: 1px solid #000;'><PRE style='font-weight: bold; width: 460px; background: lightyellow; margin: 0px; padding-left: 5px;'>\r\nНазвание:         ".zip_entry_name($zip_entry)."\r\nИсходный размер:  ".zip_entry_filesize($zip_entry)."\r\nСжатый размер:    ".zip_entry_compressedsize($zip_entry)."\r\nМетод сжатия:     ".zip_entry_compressionmethod($zip_entry)."\r\nСодержимое: [<a href=# id=xc".$i."x".$k." onclick='fcontx(this.id, 1)' style='text-decoration: none'>Показать</a>]</PRE>";
						echo "<DIV id=xc".$i."x".$k."div style='width: 460px; height: 200px; overflow: scroll; background: lightblue; margin: 0px; border-bottom: 1px solid #333; display: none'>\r\n";
						if (zip_entry_open($zip, $zip_entry, "r")) {
							$buf = zip_entry_read($zip_entry, zip_entry_filesize($zip_entry));
							echo $buf;
							zip_entry_close($zip_entry);
						}
						echo "</DIV>\r\n</div>\r\n";
					}
					zip_close($zip);
					echo "</div>\r\n<hr>\r\n";
					echo "</DIV>\r\n";
				}
			}
		}		
?>
</td></tr>
</Table>
<?	
	include('toolmen.php');
	} elseif ($_GET['p']=='xx') {
		if (ISSET($_GET['f'])) {
			$wdir='oldata/LONG/';
			if (FILE_EXISTS($wdir.$_GET['f'])) {
				unlink($wdir.$_GET['f']);
				usleep(100);
			}
?>
<br>
<script>
location.href='bd_man.php?act=Z&p=dl';
</script>
<?
		}
	}
}
echo "<div>&nbsp;</div>\r\n";
echo "</body>\r\n</html>\r\n";
?>