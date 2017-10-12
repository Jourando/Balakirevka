<?php
// Пример #2 Собрать и отобразить подробную информацию об архиве
$za = new ZipArchive();
$za->open('test21_php.zip');
print_r($za);
echo "<hr>";
var_dump($za);
echo "<hr>";
echo "numFiles: " . $za->numFiles . "<br>\n";
echo "status: " . $za->status  . "<br>\n";
echo "statusSys: " . $za->statusSys . "<br>\n";
echo "filename: " . $za->filename . "<br>\n";
echo "comment: " . $za->comment . "\n";
echo "<hr>";
for ($i=0; $i<$za->numFiles;$i++) {
    echo "index: $i\n";
    print_r($za->statIndex($i));
	echo "<p>---</p>";
}
echo "numFile:" . $za->numFiles . "\n";
// варианты
?>