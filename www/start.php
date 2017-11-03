<?php
// v.10.a.1::start revision
header("Cache-Control: no-store, no-cache, must-revalidate");
header("Expires: " . date("r"));
$page='local index.html';
$owner='unknown device';
$xfile = 'log/actlog.txt';
$vtx=0;
if (ISSET($_GET['doc'])) {$page=$_GET['doc']; $vtx=$vtx+1;}
if (ISSET($_GET['data'])) {$owner=urldecode($_GET['data']); $vtx=$vtx+1;}
$tm = date("d m Y H:i:s");
if ($vtx==2) {
	$uPC=explode("==>", $owner);
} else {
	$uPC[0]='...';
}
$a='System was started from ['.$page.'] at '.$tm.' on device {';
if ($owner=='unknown device') {
	$a=$a.$owner."}\r\n";
} else {
	$a=$a."host: ".$uPC[0]."; ip: ".$uPC[1]."; mac: ".$uPC[2]."; profile: ".$uPC[3]."}\r\n";
}
$handle = fopen($xfile, 'a');
fwrite($handle, $a);
fclose($handle);
echo "<html><head><title>START</title></head><body ";
if ($vtx==0) {echo 'background-color="red">';}
else if ($vtx==1) {echo 'background-color="gold">';}
else if ($vtx==2) {echo 'background-color="green">';}
else {echo 'background-color="black">';}
echo "<div> </div>";
echo "</body></html>";
?>