<?php
echo "<html><head><title>adm tools</title></head><body>";
if ((!ISSET($_POST['log'])) || (!ISSET($_POST['dep'])) || (ISSET($_POST['relog']))) {
	$str1='<h3>adm tools</h3><form action="adm.php" target=_blank method=post><input type=text value=0 name="dep"> : <input type=text value="Input password" name="log">';
	$str2='<input type=submit value="Send"></form>';
	echo $str1.$str2;
} else {
//	echo "--- ".$_POST['log'].":".$_POST['dep']."<br><hr>";
	$logins=file('username.a');
	for ($i=0; $i<count($logins); $i++) {
		$login[$i]=explode(":", $logins[$i]);
	}
	for ($i=0; $i<count($logins)+1; $i++) {
		if (($login[$i][0]=="999") & (md5($_POST['log'])==$login[$i][2])) {
			echo 'ура';
		} else {
			$str1='<h3>adm tools</h3><form action="adm.php" target=_self method=post>Access blocked <input type=hidden value=0 name="relog">';
			$str2='<input type=submit value="Retry"></form>';
			// echo 'фейл: '.$i.'.'.$_POST['log'].' - ['.$login[$i][0].' @ 999] and ['.md5($_POST['log']).' @ '.$login[$i][2].']<br>';
			echo $str1.str2;
		}
	}
}
echo "<hr><h6>adm tools</h6></body></html>";
?>