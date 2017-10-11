<?php
// Пример #2 Собрать и отобразить подробную информацию об архиве
$za = new ZipArchive();
$za->open('test21_php.zip');
print_r($za);
var_dump($za);
echo "numFiles: " . $za->numFiles . "\n";
echo "status: " . $za->status  . "\n";
echo "statusSys: " . $za->statusSys . "\n";
echo "filename: " . $za->filename . "\n";
echo "comment: " . $za->comment . "\n";

for ($i=0; $i<$za->numFiles;$i++) {
    echo "index: $i\n";
    print_r($za->statIndex($i));
}
echo "numFile:" . $za->numFiles . "\n";
?>