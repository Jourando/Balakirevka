<?php
$j=1;
$xStr="d0[123]='text';";
if (ISSET($_GET['x'])) { $j=$_GET['x']; }
echo $xStr;
echo "<br>";
echo "preg pattern = d(\d+)\[(\d+)\]=";
echo "<br>";
$pattern = '/d(\d)\[\d+\]/';
$repl = 'd(\d)\['.$j.'\]';
echo "/d(\d)\[".$j."\]/";
echo "<br>";
echo "Result is ";
$res = preg_replace($pattern, $repl, $xStr);
echo $res;
echo "<br>";
list($s1, $s2) = explode('[', $xStr);
list($s3, $s4) = explode(']', $xStr);
echo $s1."[".$j."]".$s4;
?>