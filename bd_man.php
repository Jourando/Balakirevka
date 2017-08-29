<?php
echo '<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">';
echo '<html lang="ru"><head><meta charset="utf-8"><meta http-equiv="X-UA-Compatible" content="IE=edge">';
$retr=false;
echo "<style>\n";
echo "input[type=button] {width: 140px;}\n";
echo "</style>\n";
echo '<title>BD-man</title></head>';
$dir = __DIR__;
echo '<body>';
if (($_GET['act']=="R") && ($_GET['p']=="show")) {
	echo "<p>Workdir is $dir</p>";
	$str1='<div>';
	$str2='<label>1. <input type=button value="Drop User BD" Onclick=location.href="bd_man.php?act=W&p=ubd&from=self"> Сбросить список пользователей</label><br>';
	$str3='<label>2. <input type=button value="Drop DP BD" Onclick=location.href="bd_man.php?act=W&p=dbd&from=self"> Сбросить список разделов</label><br>';
	$str4='<label>3. <input type=button value="Drop Data BD" Onclick=location.href="bd_man.php?act=W&p=xbd&from=self"> Сбросить список пользовательских документов</label><br>';
	$str5='<label>4. <input type=button value="Drop Settings"> Сбросить список настроек</label>';
	$str6='</div>';
	// var_dump($fn);
	echo $str1.$str2.$str3.$str4.$str5.$str6;
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
		$handle = fopen('depart0.js', 'w');
		fwrite($handle, "var d0=new Array();\r\nd0[1]='отдел 1';\r\nd0[2]='отдел 2';\r\nd0[3]='отдел 3';\r\nd0[4]='отдел 4';\r\nd0[5]='отдел 5';\r\nd0[6]='отдел 6';\r\n");
		fclose($handle);
	}
	if ($_GET['p']=="xbd") {
		$f = scandir($dir);
		for ($i=2; $i<count($f); $i++) {
			// здесь условие
			// if (basename($file) == 'этот файл не трогать') continue;
			if(preg_match('/\.js/', $f[$i])){ $fn[]=$f[$i];	}
		}
		for ($i=1; $i<count($fn); $i++) {
			if ($fn[$i] == 'depart'.$i.'.js') {
				$handle = fopen($fn[$i], 'w');
				fwrite($handle, "var d".$i." = new Array();\r\n");
				fwrite($handle, "d".$i."[1]='1||||||||||||||||';\r\n");
				fclose($handle);
			}
		}
	}	
	if ($_GET['from']=='self') {
			echo "<script>\nlocation.href='bd_man.php?act=R&p=show&from=self';\n</script>\n";
	}
}
echo '</body>';
echo '</html>';
?>