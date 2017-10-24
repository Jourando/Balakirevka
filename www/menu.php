<?php
// v.10.a.4::tab_menu revision
function mkMenu() {
$xfile="depart0000.a";
$lines = file($xfile, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
$i=0;
echo "<form class=lgfrm autocomplete=1><fieldset name=set id=fset>\r\n";
echo "<nobr><label>Отдел <select id=dps Onchange='depMod=this.selectedIndex'>\r\n";
foreach($lines as $v) {
	list($mVal[$i], $mLable[$i])=explode("=", $lines[$i]);
	if ($i>0) {
		$resStr[$i]="<option value=".$mVal[$i].">[".$mVal[$i]."] ".$mLable[$i]."</option>\r\n";
	} else {
		$resStr[$i]="<option value=".$mVal[$i].">".$mLable[$i]."</option>\r\n";
	}
	echo $resStr[$i];
	if ((!FILE_EXISTS('depart'.str_pad($i, 4, "0", STR_PAD_LEFT).'.a')) || (filesize('depart'.str_pad($i, 4, "0", STR_PAD_LEFT).'.a')<10)) {
		if (FILE_EXISTS('store/depart')) {
			copy('store/depart', 'depart'.str_pad($i, 4, "0", STR_PAD_LEFT).'.a');
		} else {
			$handle = fopen('depart'.str_pad($i, 4, "0", STR_PAD_LEFT).'.a', 'w');
			fwrite($handle, " 0||||||||||||||||||\r\n");
			fclose($handle);
		}
	}
	$i=$i+1;
}
echo "</select></label>\r\n";
echo "<label> оператор <input type=text id=lusr value=\"Фамилия и инициалы\" OnFocus=this.value=\"\" OnBlur=\"if (this.value=='') {this.value='Фамилия и инициалы';}\"></label> <label>пароль <input id=pusr type=password value='Пароль' OnFocus='this.value=\"\"; checkCapsWarning(event);' OnBlur='if (this.value==\"\") {this.value=\"Пароль\"}; removeCapsWarning();' onkeyup='checkCapsWarning(event);'></label> <div id=CLW class=CapsOff ALT=\"проверьте CapsLock\">&nbsp;</div> <input type=button value=Отправить Onclick=\"Auth(1)\" class=visible id=b1> <input type=button value=Перелогиниться Onclick=\"Auth(2)\" class=invisible id=b2> <input type=button value=Обновить OnClick=\"location.reload()\"></nobr>\r\n";
echo "</fieldset></form>\r\n";
return $mLable;
}
?>