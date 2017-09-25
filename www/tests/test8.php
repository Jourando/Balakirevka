<?php
// v.10.a.0::scan revision
function getExtension($filename) {
return substr($filename, strrpos($filename, '.') + 1);
}
function renameDirAndFile ($patch) {
$handle = opendir($patch);
while(($file = readdir($handle))) {
	if (is_file($patch."/".$file)) {
		if ($_POST['ftype']!='') {
		// Выводим старое имя файла,  Переименовываем выводим новое
			if (strtoupper(getExtension($file))==strtoupper($_POST['ftype'])) {
				echo $patch."/".$file;
				$lines=file($patch."/".$file);
				for ($i=0; $i<count($lines); $i++) {
					if (strrpos($lines[$i], $_POST['SearchStr'])) {
						echo "line ".$i." in ".$patch."/".$file.": ".$_POST['SearchStr']." found<br>";
					}
				}
				echo "<hr>";
			}
		}
					
    }
    if (is_dir($patch."/".$file) && ($file != ".") && ($file != "..")) {
		/* рекусрсивно проходим по директории */
		renameDirAndFile($patch."/".$file);  // Обходим вложенный каталог
    }
}
closedir($handle); 
}	

if ((!ISSET($_POST['SearchStr'])) || (trim($_POST['SearchStr'])=='')) {
?>
<HTML>
<HEAD><TITLE>SCAN</TITLE></HEAD>
<BODY>
<FORM action=test8.php?g=x method=post>
	<input type=text name=SearchStr value=""> String<br>
	<input type=text name=ftype value="*.php"> FileType<br>
	<input type=text name=Dir value=""> Folder<br>
	<input type=submit value=Scan>
</FORM>
</BODY>
</HTML>
<?
} else {
renameDirAndFile(".");
// В качестве аргумента передаем путь(имя) до папки.
}
?>