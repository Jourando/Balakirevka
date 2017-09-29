<?php
// v.10.a.2::scan revision
function getExtension($filename) {
return substr($filename, strrpos($filename, '.') + 1);
}
function renameDirAndFile($patch) {
echo "<h4>".$patch."</h4>";
$handle = opendir($patch);
while(($file = readdir($handle))) {
	if (is_file($patch. DIRECTORY_SEPARATOR .$file)) {
		if ($_POST['ftype']!='') {
			if (strtoupper(getExtension($file))==strtoupper($_POST['ftype'])) {
				echo "<h5>Scan ".$patch. DIRECTORY_SEPARATOR .$file."</h5>";
				$lines=file($patch. DIRECTORY_SEPARATOR .$file);
				for ($i=0; $i<count($lines); $i++) {
					if (strrpos($lines[$i], $_POST['SearchStr'])) {
						echo ">><span style='color: red'>line ".($i+1)." in ".$patch. DIRECTORY_SEPARATOR .$file."</span>: string '".$_POST['SearchStr']."' was found<br>";
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
<script>
function substr( f_string, f_start, f_length ) {
	// +	 original by: Martijn Wieringa
	if(f_start < 0) {f_start += f_string.length;}
	if(f_length == undefined) {
		f_length = f_string.length;
	} else if(f_length < 0){
		f_length += f_string.length;
	} else {
		f_length += f_start;
	}
	if(f_length < f_start) {f_length = f_start;}
	return f_string.substring(f_start, f_length);
}
function fx1() {
var c = document.getElementById('s2').value;
if (c.indexOf('.')>-1) {
	document.getElementById('s2').value=substr(c, c.indexOf('.')+1);
}
document.mfrm.submit();
}
</script>
<h3>fast text scan</h3>
<FORM action="" name=mfrm method=post>
	<input id=s1 type=text name=SearchStr value=""> String<br>
	<input id=s2 type=text name=ftype value="php"> FileType<br>
	<input id=s3 type=text name=Dir value=""> Folder<br>
	<input type=button value=Scan Onclick=fx1()>
</FORM>
<? include "toolmen.php"; ?>
</BODY>
</HTML>
<?
} else {
	$cur_dir = __DIR__;
	if (ISSET($_POST['Dir'])) {
		if (FILE_EXISTS($_POST['Dir'])) { $cur_dir=$_POST['Dir']; }
	}
	echo "Scan for '".$_POST['SearchStr']."' in *.".$_POST['ftype']." of ".$cur_dir;
	renameDirAndFile($cur_dir);
	include "toolmen.php";
}
?>