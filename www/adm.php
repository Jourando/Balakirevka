<?php
echo "<html><head><title>adm tools</title></head><body>";
if ((!ISSET($_POST['log'])) || (!ISSET($_POST['dep']))) {
	$str1='<h3>adm tools</h3><form action="adm.php" target=_self method=post><input type=text value=0 name=dep> : <input type=text value="Input password" name=log OnFocus="this.value=\'\';" OnBlur="if (this.value=\'\') {this.value=\'Input password\'}">';
	$str2='<input type=submit value="Send"></form>';
	echo $str1.$str2;
} else {
	echo "--- ".$_POST['log'].":".$_POST['dep']."<br><hr>";
	$logins=file('username.a');
	for ($i=0; $i<count($logins); $i++) {
		$login[$i]=explode(":", $logins[$i]);
	}
	for ($i=0; $i<count($logins); $i++) {
		if (($login[$i][0]=="999") && (md5($_POST['log'])==$login[$i][2])) {
			echo 'ура';
		} else {
			echo 'фейл: '.$i.'.'.$_POST['log'].' - ['.$login[$i][0].' @ 999] and ['.md5($_POST['log']).' @ '.$login[$i][2].']<br>';
		}
	}
}
echo "<hr><h6>adm tools</h6></body></html>";
?>