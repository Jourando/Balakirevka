<?php
include('linelim.php');
$zip = new ZipArchive();
$filename = "back".time().".zip";
if ($zip->open($filename, ZipArchive::CREATE)!==TRUE) {exit("Невозможно открыть <".$filename.">\n");}
else {
	for ($i=0; $i<$deplimit; $i++) {
		$zip->addGlob('oldata/'.str_pad($i, 4, "0", STR_PAD_LEFT).'/*');
	}
	$zip->close();
}