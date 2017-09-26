<?php
// v.10.a.2::tools revision
		$str1='<div style="width: 220px; height: 460px; position: fixed; top: 0; right: 0; z-index: 3; overflow: scroll; background: silver; color: navy; border: 1px solid #000"><div style="margin: 5px auto; width: 120px; text-align: center; font-weight: bold; font-face: Tahoma; background: #dedede">MENU</div><div style="margin: 10px; width: 180px; border: 1px dotted #fff; font-face: Arial;cursor: pointer;"><div Onclick="location.href=\'adm3.php\'">Tools page</div><div Onclick="location.href=\'auth.php?act=R&r=3\'">User list</div><div Onclick="location.href=\'bd_man.php?act=R&p=show&from=self\'">BD manager</div><div Onclick="location.href=\'scant.php\'">TextScan</div><div Onclick="location.href=\'rollback_man3.php?mode=show\'">Export</div></div></div>';
		$str2='';
		echo $str1.$str2;
		// выводить в админку подсказку бы еще по соответствию № разделов и названий
?>