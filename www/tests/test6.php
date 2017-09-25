<?php
function xlsBOF() {
    echo pack("ssssss", 0x809, 0x8, 0x0, 0x10, 0x0, 0x0);
    return;
}
function xlsEOF() {
    echo pack("ss", 0x0A, 0x00);
    return;
}
function xlsWriteNumber($Row, $Col, $Value) {
    echo pack("sssss", 0x203, 14, $Row, $Col, 0x0);
    echo pack("d", $Value);
    return;
} 
function xlsWriteLabel($Row, $Col, $Value ) {
    $L = strlen($Value);
    echo pack("ssssss", 0x204, 8 + $L, $Row, $Col, 0x0, $L);
    echo $Value;
    return;
}
 
//где-то тут создаем массив $array[$i][$j] или читаем из файла (из базы данных), после чего начинаем формировать excel-файл
if (ISSET($_GET['f'])) {
	$fn=$_GET['f'];
	IF (!FILE_EXISTS($fn)) {$fn=$fn.".a";}
	IF (!FILE_EXISTS($fn)) {die(0);}
	$ax = file($fn, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
	for ($i=0; $i<count($ax); $i++) {
		$array[$i]=explode("|", $ax[$i]);
	}
    header("Content-Type: application/force-download");
    header("Content-Type: application/octet-stream");
    header("Content-Type: application/download");;
    header("Content-Disposition: attachment;filename=list.xls");
    header("Content-Transfer-Encoding: binary");
 
    xlsBOF(); //пишем начало файла
 
    for($i=0,$counti=count($array);$i<$counti;$i++){ //количество строк
        for($j=0,$countj=count($array[$i]);$j<$countj;$j++){ //количество ячеек    
            xlsWriteLabel($i,$j,$array[$i][$j]); 
                        //в строку $i, в ячейку $j, записываем содержимое $array[$i][$j]
 
        }
    }
 
    xlsEOF(); // закрываем файл
}
?>