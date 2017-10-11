<?php
include('linelim.php');
function killDir($wdir, $except) {
$f=scandir($wdir);
for ($i=1; $i<count($f); $i++) {
	if (($f[$i]!=='.') && ($f[$i]!=='..')) {
		if ($f[$i]!==$except) {unlink($wdir.$f[$i]); echo "del ".$f[$i]."<br>";}
	}
}
}
$tmpstr=date("l, Y.d.m H:i:s");
$zip = new ZipArchive();
$filename = "oldata/LONG/back_".time().".zip";
if ($zip->open($filename, ZipArchive::CREATE)!==TRUE) {exit("Невозможно открыть <".$filename.">\n");}
else {
	for ($i=0; $i<$deplimit; $i++) {
		$zip->addGlob('oldata/'.str_pad($i, 4, "0", STR_PAD_LEFT).'/*');
	}
	$zip->setArchiveComment('Backup files, created before '.$tmpstr); 
	$zip->close();
}
echo $tmpstr;
for ($j=0; $j<$deplimit; $j++) {
	if (is_dir('oldata/'.str_pad($j, 4, "0", STR_PAD_LEFT))) {
		killDir('oldata/'.str_pad($j, 4, "0", STR_PAD_LEFT).'/', 'depart'.str_pad($j, 4, "0", STR_PAD_LEFT).'[0001]');
	}
}
?>