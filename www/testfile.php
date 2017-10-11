<?php
include('linelim.php');
$zip = new ZipArchive();
$filename = "oldata/LONG/back".time().".zip";
$dt=localtime();
if ($zip->open($filename, ZipArchive::CREATE)!==TRUE) {exit("Невозможно открыть <".$filename.">\n");}
else {
	for ($i=0; $i<$deplimit; $i++) {
		$zip->addGlob('oldata/'.str_pad($i, 4, "0", STR_PAD_LEFT).'/*');
	}
	$zip->setArchiveComment('Файлы откатов, созданные до '.$dt['tm_year'].'/'.$dt['tm_mon'].'/'.$dt[tm_mday].' числа'); 
	$zip->close();
}