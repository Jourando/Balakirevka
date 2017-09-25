<?php
// v.10.a.0::scan revision
function getExtension($filename) {
return substr($filename, strrpos($filename, '.') + 1);
}
function renameDirAndFile($patch) {
echo "<h4>".$patch."</h4>";
$handle = opendir($patch);
while(($file = readdir($handle))) {
	if (is_file($patch. DIRECTORY_SEPARATOR .$file)) {
		if ($_POST['ftype']!='') {
			// echo strtoupper(getExtension($file))." ::: ".strtoupper($_POST['ftype'])."<br>";
			if (strtoupper(getExtension($file))==strtoupper($_POST['ftype'])) {
				echo "<h5>Scan ".$patch. DIRECTORY_SEPARATOR .$file."</h5>";
				$lines=file($patch. DIRECTORY_SEPARATOR .$file);
				for ($i=0; $i<count($lines); $i++) {
					if (strrpos($lines[$i], $_POST['SearchStr'])) {
						echo ">><span style='color: red'>line ".$i." in ".$patch. DIRECTORY_SEPARATOR .$file."</span>: ".$_POST['SearchStr']." found<br>";
					}
				}
				echo "<hr>";
			}
		}
					
    }
    if (is_dir($patch. DIRECTORY_SEPARATOR .$file) && ($file != ".") && ($file != "..")) {
		/* рекусрсивно проходим по директории */
		renameDirAndFile($patch. DIRECTORY_SEPARATOR .$file);  // Обходим вложенный каталог
    }
}
closedir($handle); 
}	

if ((!ISSET($_POST['SearchStr'])) || (trim($_POST['SearchStr'])=='')) {
?>
<HTML>
<HEAD><TITLE>SCAN</TITLE></HEAD>
<BODY>
<FORM action="" method=post>
	<input type=text name=SearchStr value=""> String<br>
	<input type=text name=ftype value="php"> FileType<br>
	<input type=text name=Dir value=""> Folder<br>
	<input type=submit value=Scan>
</FORM>
</BODY>
</HTML>
<?
} else {
	$cur_dir = __DIR__;
	renameDirAndFile($cur_dir);
	// В качестве аргумента передаем путь(имя) до папки.
}
?>