<?php
// v.10.a.5::adm revision
echo "<html><head><title>adm tools</title></head><body>";
if ((!ISSET($_POST['log'])) || (!ISSET($_POST['dep'])) || (ISSET($_POST['relog']))) {
	$str1='<h3>adm tools</h3><form action="" target=_self method=post><input type=text value=0 name="dep"> : <input type=text value="Input password" name="log">';
	$str2='<input type=submit value="Send"></form>';
	echo $str1.$str2;
} else {
	$logins=file('username.a');
	for ($i=0; $i<count($logins); $i++) {
		$login[$i]=explode(":", $logins[$i]);
	}
	for ($i=0; $i<count($logins)+1; $i++) {
		if (($login[$i][0]=="999") & ($_POST['dep']==$login[$i][0]) & (md5($_POST['log'])==$login[$i][2])) {
			include('toolmen.php');
			echo "<h3>Welcome, administrator ".$login[$i][1]."!</h3>";
			break;
		} else {
			$str1='<h3>adm tools</h3><form action="" target=_self method=post>Access blocked <input type=hidden value=0 name="relog">';
			$str2='<input type=submit value="Retry"></form>';
			if (($_GET['mode']=='debug') || ($_GET['mode']=='DEBUG')) {
				echo '<!-- fail: '.$i.'.'.$_POST['log'].' - ['.$login[$i][0].' @ 999] and ['.md5($_POST['log']).' @ '.$login[$i][2].'] -->'."\r\n";
			}
		}
	}
	echo $str1.$str2;
}
echo "<hr><h6>adm tools</h6>\r\n</body></html>";
?>