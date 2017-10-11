<?php
// Пример #4 Пример использования Zip
$zip = zip_open("test21.zip");
if ($zip) {
	echo "<DIV>Архив " . $zip->filename ." содержит:<br>\r\n"
	echo "Число доступных файлов: " . $zip->numFiles . "<br>\r\n";
	echo "Статус/системный статус: " . $zip->status  ."/".$zip->statusSys. "<br>\r\n";
	echo "Список комментариев: " . $zip->comment . "</DIV>\r\n";

	while ($zip_entry = zip_read($zip)) {
		echo "<PRE>";
		echo "Название:         ".zip_entry_name($zip_entry)."\n";
		echo "Исходный размер:  ".zip_entry_filesize($zip_entry)."\n";
		echo "Сжатый размер:    ".zip_entry_compressedsize($zip_entry)."\n";
		echo "Метод сжатия:     ".zip_entry_compressionmethod($zip_entry)."\n";
		echo "</PRE><DIV style='width: 350px; height: 200px; overflow: scroll;'>\n";
		if (zip_entry_open($zip, $zip_entry, "r")) {
			$buf = zip_entry_read($zip_entry, zip_entry_filesize($zip_entry));
			echo "Содержимое файла: ".$buf."\n";
			zip_entry_close($zip_entry);
		}
		echo "</DIV>\n";
	}
	zip_close($zip);
}
?>