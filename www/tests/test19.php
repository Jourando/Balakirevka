<?php
// Пример #1 Создание Zip архива
$zip = new ZipArchive();
$filename = "test21_php.zip";

if ($zip->open($filename, ZipArchive::CREATE)!==TRUE) {
    exit("Невозможно открыть <$filename>\n");
}
echo $thisdir."<hr>";
$zip->addFromString("testfilephp.txt" . time(), "#1 Это тестовая строка, добавленная как testfilephp.txt.\n");
$zip->addFromString("testfilephp2.txt" . time(), "#2 Это тестовая строка, добавленная как testfilephp2.txt.\n");
$zip->addFile($thisdir . "test1.php","test2.php");
echo "numfiles: " . $zip->numFiles . "\n";
echo "status:" . $zip->status . "\n";
$zip->close();
?>