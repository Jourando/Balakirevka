<?php
include('linelim.php');
function killDir($wdir, $except) {
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
$tmpstr=date("l, Y.d.m H:i:s");
if (!file_exists('oldata/LONG')) {mkdir('oldata/LONG', 0744, true);}
$zip = new ZipArchive();
$filename="oldata/LONG/back_".time().".zip";
if ($zip->open($filename, ZipArchive::CREATE)!==TRUE) {exit("Невозможно открыть <".$filename.">\r\n");}
else {
	for ($i=0; $i<$deplimit; $i++) {
		$zip->addGlob('oldata/'.str_pad($i, 4, "0", STR_PAD_LEFT).'/*');
	}
	$zip->setArchiveComment('Backup files, created before '.$tmpstr); 
	$zip->close();
	echo "<div style='border: 1px solid #999; width: 540; background: #000; color: #fff'>Файлы, которые были включены в архив <a href=".$filename." style='color: gold'>".$filename."</a>:</div>\r\n";
	echo "<div style='border: 1px solid #999; height: 320px; width: 540px; overflow: scroll;'>";
	for ($j=0; $j<$deplimit; $j++) {
		if (is_dir('oldata/'.str_pad($j, 4, "0", STR_PAD_LEFT))) {
			killDir('oldata/'.str_pad($j, 4, "0", STR_PAD_LEFT).'/', 'depart'.str_pad($j, 4, "0", STR_PAD_LEFT).'[0001]');
		}
	}
	echo "</div>\r\n";
}
?>