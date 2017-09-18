<?php
function inString($a, $b) {
	$c="".$a;
if (strlen($c)<=$b) {
while (strlen($c)<$b) {
		$c="0".$c;
}
return $c;
} else {
	// обрезать
}
}
echo inString(2, 8)."<br>";
echo inString(221, 3)."<br>";
echo inString(0, 5)."<br>";
echo inString(22, 1)."<br>";
echo inString(7576, 9)."<br>";
echo inString('q', 3)."<br>";
?>