<?php
include('linelim.php');
?>
<script>
function fcontx(b) {
var el=document.getElementById(b+'div');
(el.style.display=='none')?el.style.display='block':el.style.display='none';
}
</script>
<?
// $xfile='tests/test21.zip';
// $za = new ZipArchive();
// $zip = zip_open($xfile);
// $za->open($xfile);
/*
if ($zip) {
	echo "<DIV>Архив [<a href=".$xfile." style='text-decoration: none'>".$xfile."</a>] содержит:<br>\r\n";
	echo "Внутреннее имя ресурса: " . $zip . "<br>\r\n";
	echo "Дата создания: ".date("Y/m/d H:i:s", filemtime($xfile))."<br>\r\n";
	echo "Размер архива: ".filesize($xfile)." byte(s)<br>\r\n";
	echo "Число доступных файлов-записей: " . $za->numFiles . "<br>\r\n";
	echo "Статус/системный статус: " . $za->status  ."/".$za->statusSys. "<br>\r\n";
	echo "Список комментариев: " . $za->comment . "</DIV>\r\n";
	$k=0;
	while ($zip_entry = zip_read($zip)) {
		$k=$k+1;
		echo "<div style='width:462px; border: 1px solid #000'>\r\n";
		echo "<PRE style='font-weight: bold; width: 460px; background: lightyellow; margin: 0px; padding-left: 5px;'>";
		echo "Название:         ".zip_entry_name($zip_entry)."\r\n";
		echo "Исходный размер:  ".zip_entry_filesize($zip_entry)."\r\n";
		echo "Сжатый размер:    ".zip_entry_compressedsize($zip_entry)."\r\n";
		echo "Метод сжатия:     ".zip_entry_compressionmethod($zip_entry)."\r\n";
		echo "Содержимое: [<a href=# id=xc".$k." onclick=fcontx(this.id) style='text-decoration: none'>Показать</a>]";
		echo "</PRE><DIV id=xc".$k."div style='width: 460px; height: 200px; overflow: scroll; background: lightblue; margin: 0px; border-bottom: 1px solid #333; display: none'>\r\n";
		if (zip_entry_open($zip, $zip_entry, "r")) {
			$buf = zip_entry_read($zip_entry, zip_entry_filesize($zip_entry));
			echo $buf."\r\n";
			zip_entry_close($zip_entry);
		}
		echo "</DIV>\r\n</div>\r\n";
	}
	zip_close($zip);
}
*/
// echo "</div>";





$wdir = 'oldata/LONG/';
$f=scandir($wdir);
echo "<Table>\r\n";
echo "<tr><td>\r\n";
for ($i=1; $i<count($f); $i++) {
	if (($f[$i]!=='.') && ($f[$i]!=='..')) {
		echo "<div style='background: lightblue;'>".$f[$i]."</div>\r\n";
		$xfile=$wdir.$f[$i];
		$za = new ZipArchive();
		$zip = zip_open($xfile);
		$za->open($xfile);
		if ($zip) {
			$strX1[$i]="<DIV>Архив [<a href=".$xfile." style='text-decoration: none'>".$xfile."</a>] содержит:<br>Внутреннее имя ресурса: ".$zip."<br>Дата создания: ".date("Y/m/d H:i:s", filemtime($xfile))."<br>Размер архива: ".filesize($xfile)." byte(s)<br>Число доступных файлов-записей: ".$za->numFiles."<br>Статус/системный статус: ".$za->status."/".$za->statusSys."<br>Список комментариев: ".$za->comment."</DIV>\r\n";
			$k=0;
			while ($zip_entry = zip_read($zip)) {
				$k=$k+1;			
				$strX1[$i]=$strX1[$i]."<div style='width:462px; border: 1px solid #000'><PRE style='font-weight: bold; width: 460px; background: lightyellow; margin: 0px; padding-left: 5px;'>\r\nНазвание:         ".zip_entry_name($zip_entry)."\r\nИсходный размер:  ".zip_entry_filesize($zip_entry)."\r\nСжатый размер:    ".zip_entry_compressedsize($zip_entry)."\r\nМетод сжатия:     ".zip_entry_compressionmethod($zip_entry)."\r\nСодержимое: [<a href=# id=xc".$k." onclick=fcontx(this.id) style='text-decoration: none'>Показать</a>]</PRE><DIV id=xc".$k."div style='width: 460px; height: 200px; overflow: scroll; background: lightblue; margin: 0px; border-bottom: 1px solid #333; display: none'>\r\n";
				if (zip_entry_open($zip, $zip_entry, "r")) {
					$buf = zip_entry_read($zip_entry, zip_entry_filesize($zip_entry));
					zip_entry_close($zip_entry);
					$strX2[$i]=$buf;
				}
				$strX3[$i]="</DIV>\r\n<div></div>\r\n";
			}
			zip_close($zip);
		}		
	}
}
echo "</td><td>\r\n";
echo "<div id=zipcontext>";
for ($i=1; $i<count($f); $i++) {
	echo $strX1[$i].$strX2[$i].$strX3[$i];
}
echo "</div>";
echo "</td></tr>\r\n";
echo "</Table>\r\n";
?>