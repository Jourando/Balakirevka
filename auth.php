<?php
// ввести парам. from...
// если from существует, xFrom=$_GET['from'] иначе xFrom=default
$ResStr="";
$xFrom="";
if (($_GET['act']=="R") || ($_GET['act']=="W") || ($_GET['act']=="D")) {
// если переменные [departm], [log], [pwd] существуют, то
// открыть список соответствий и сверить 1) пара log:pwd 2) пара log+pwd:departm 3) CRC(log+pwd+departm):CRC_data from file
		echo '<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">';
		echo '<html lang="ru"><head><meta charset="utf-8"><meta http-equiv="X-UA-Compatible" content="IE=edge"><title>Auth</title></head>';
	if ($_GET['act']=="R") {
		$lines = file('username.a', FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
		$i=0;
		echo "<body><p>Лист операторов/доступов к разделам</p>\n";
		echo "<script>\nfunction addusr() {\nlocation.href='auth.php?act=W&d='+document.newusr.df.value+'&u='+document.newusr.lf.value+'&p='+document.newusr.pf.value+'&from=self';\n}\n</script>\n";
		echo "<Table border=1>";
		echo "<tr><td>действие</td><td>доступ к<br>разделу</td><td>пользователь</td></tr>";
		foreach($lines as $v) {
			list($d[$i], $u[$i], $p[$i], $c[$i]) = explode(":", $v);
			// echo "now: [d=".$d[$i].", u=".$u[$i].", p=".$p[$i].", c=".$c[$i]."]<br>";
			// echo $v.'<br>';
			// если p=display - вывести меню редактирования
			echo "<tr><td><a href=# Onclick=location.href='auth.php?act=D&d=".$d[$i]."&u=".$u[$i]."&from=self' style='text-decoration: none'>[x]</a></td><td>".$d[$i]."</td><td>".$u[$i]."</td></tr>";
		}
		echo "</Table>";
		echo "<form name=newusr>";
		echo "<label>Добавить нового юзера:<br>Логин <input type=text name=lf> Пароль <input type=text name=pf> Раздел <input type=text name=df> <input type=button value=Сохранить Onclick=addusr()></label>";
		echo "</form>";
	}
	if ($_GET['act']=="W") {
		$tmpStr=$_GET['d'].":".strtoupper($_GET['u']).":".md5($_GET['p']).":";
		$tmpStr=$tmpStr.crc32($tmpStr)."\r\n";
		$lines = file('username.a', FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
		$i=0;
		foreach($lines as $v) {
			if ($v==$tmpStr) {
								$ResStr='#01: ERR';
								exit;
							 }
		}
		if ($ResStr=="") {
			if (!$handle = fopen('username.a', 'a')) {
					$ResStr="#02: ERR"; //Не могу открыть файл ($filename)
					exit;
			}
			if (fwrite($handle, $tmpStr) === FALSE) {
					$ResStr="#03: ERR"; //Не могу произвести запись в файл ($filename)";
					exit;
			} else {
					$ResStr="<h3>Новый пользователь успешно добавлен</h3>\n";
					if ($_GET['from']=='self') {
						$ResStr=$ResStr."<script>\ndocument.write('<p>Подождите несколько секунд, база обновится</p>');\nsetTimeout(location.href='auth.php?act=R', 9000);\n</script>\n";
					}
			}
			fclose($handle);
		}
		echo $ResStr;
	}
	if ($_GET['act']=="D") {
// Erase
		$lines = file('username.a', FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);	
		$tmpStr=$_GET['u'];
		$tmpStr=$_GET['d'].":".strtoupper($tmpStr);
		if (!$handle = fopen('username.a', 'w')) {
					$ResStr="#02: ERR"; //Не могу открыть файл ($filename)
					exit;
		}
		foreach($lines as $v) {
			list($d[$i], $u[$i], $p[$i], $c[$i]) = explode(":", $v);
			if ((($d[$i].":".strtoupper($u[$i])) !== $tmpStr) && (trim($d[$i].$u[$i].$p[$i].$c[$i]) !== "")) {
				fwrite($handle, $d[$i].":".$u[$i].":".$p[$i].":".$c[$i]."\r\n");
			}
		}
		fclose($handle);
		$ResStr="<h3>Пользователь ".strtoupper($_GET['u'])." успешно удален</h3>\n";
		if ($_GET['from']=='self') {
			$ResStr=$ResStr."<script>\ndocument.write('<p>Подождите несколько секунд, база обновится</p>');\nsetTimeout(location.href='auth.php?act=R', 9000);\n</script>\n";
		}
		echo $ResStr;
	}
	echo ""; // вставка интерфейса управления
	echo '</body></html>';
}
if ($_GET['act']=="C") {
	include 'flib.php';
	if (isset($_GET['d'], $_GET['u'], $_GET['p'])) {
		// $new_u=uchr($_GET['u']);
		// $new_p=uchr($_GET['p']);
		$new_u=urldecode($_GET['u']);
		$new_p=urldecode($_GET['p']);
		$new_d=$_GET['d'];
		// если p=user + u=login (ISSET) + d>0, вывести сид для юзера... позитивный, если доступ к разделу разрешен
		if (($new_d<1) && (strtoupper($new_u) !== 'ADM') && (strtoupper($new_u) !== 'ADMIN')) { $ResStr='param error (d)'; }
		else {
				if ((strtoupper($new_u) == 'ADM') || (strtoupper($new_u) == 'ADMIN')) { 
					if ($new_d == 0) { $new_d=999; }
				}
				$handle = fopen('tmp.a', 'w');
				fwrite($handle, $new_d.":".$new_u.":".$new_p."\r\n");
				fclose($handle);
				$ResStr='user not found';
				$lines = file('username.a', FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);	
				foreach($lines as $v) {
					list($d[$i], $u[$i], $p[$i], $c[$i]) = explode(":", $v);
					if (($d[$i]==$new_d) && ($u[$i]==strtoupper($new_u)) && ($p[$i]==md5($new_p))) {
						// значение раздела и авторизация
						$ResStr="+".$d[$i];
					}
				}
		}
	} else { $ResStr='param error (general)'; }
	echo $ResStr;
}
?>