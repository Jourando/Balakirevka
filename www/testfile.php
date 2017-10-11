<?php
include('linelim.php');

$xfile='test21.zip';
$za = new ZipArchive();
$zip = zip_open($xfile);
$za->open($xfile);
echo "<div style='margin-left: 20px;'>";
?>
<script>
function fcontx(b) {
var el=document.getElementById(b+'div');
(el.style.display=='none')?el.style.display='block':el.style.display='none';
}
</script>
<?
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
		echo "<PRE style='font-weight: bold; width: 460px; background: lightyellow; margin: 0px;'>";
		echo "<u><b>Название:         ".zip_entry_name($zip_entry)."</b></u>\r\n";
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
		echo "</DIV>\n";
	}
	zip_close($zip);
}
echo "</div>";






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
?>