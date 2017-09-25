<?php
// v.10.a.0::scan revision
if ((!ISSET($_POST['SearchStr'])) || (trim($_POST['SearchStr'])=='')) {
?>
<HTML>
<HEAD><TITLE>SCAN</TITLE></HEAD>
<BODY>
<FORM action=test8.php?g=x method=post>
	<input type=text name=SearchStr value=""> String<br>
	<input type=text name=Dir value=""> Folder<br>
	<input type=submit value=Scan>
</FORM>
</BODY>
</HTML>
<?
}
// 0
?>