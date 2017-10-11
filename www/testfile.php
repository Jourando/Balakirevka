<?php
include('linelim.php');
$tmpstr=date("l, Y.d.m H:i:s");
$zip = new ZipArchive();
$filename = "oldata/LONG/back".time().".zip";
if ($zip->open($filename, ZipArchive::CREATE)!==TRUE) {exit("Невозможно открыть <".$filename.">\n");}
else {
	for ($i=0; $i<$deplimit; $i++) {
		$zip->addGlob('oldata/'.str_pad($i, 4, "0", STR_PAD_LEFT).'/*');
	}
	$zip->setArchiveComment('Backup files, created before '.$tmpstr); 
	$zip->close();
}
// print_r($dt);
echo $tmpstr;
?>