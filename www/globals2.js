// global settings
// v.10.a.1::global revision
rd='sh_tab_xls_v';
urlStr='http://test2.ru/auth.php?';
datStr='http://test2.ru/writ2.php?';
logStr='http://test2.ru/actlog.php?';
depMod=0;
curMod=0;
hdrStr='<tr><th rowspan=2>номер</th><th rowspan=2>дата</th><th rowspan=2>вид деятельности</th><th colspan=3>мероприятие</th><th rowspan=2>место проведения</th><th colspan=4>охват</th><th colspan=3>проводящие</th><th rowspan=2>организационно-<br>финансовое</th><th rowspan=2>доп.<br>информация</th>';
hdrStr+='</tr><tr><th>тип</th><th>внутр./сторонние</th><th>название</th><th>тип</th><th>целевая аудитория</th><th>зрители</th><th>выступающие/участники</th><th>отделение</th><th>нач.отделения</th><th>ответственный</th></tr>';
edtStr='<tr><td id=et0><input type=text id=ext0 value=0 size=3 disabled></td><td id=et1><input type=text id=ext1 size=5 value=""></td><td id=et2><input type=text id=ext2 value="" size=24></td><td id=et3><input type=text id=ext3 value="" size=12></td><td id=et4><input type=text id=ext4 value="" size=12></td><td id=et5><input type=text id=ext5 value="" size=14></td><td id=et6><input type=text id=ext6 value="" size=20></td>';
edtStr+='<td id=et7><input type=text id=ext7 value="" size=8></td><td id=et8><input type=text id=ext8 value="" size=12></td><td id=et9><input type=text id=ext9 value="" size=8></td><td id=et10><input type=text id=ext10 value="" size=12></td><td id=et11><input type=text id=ext11 value="" size=12></td><td id=et12><input type=text id=ext12 value="" size=12></td>';
edtStr+='<td id=et13><input type=text id=ext13 value="" size=12></td><td id=et14><input type=text id=ext14 value="" size=14></td><td id=et15><input type=text id=ext15 value="" size=10></td></tr>';
edtStr+='<tr><td colspan=16><lavel>Вставить строку <input type=button value=Перед Onclick=ItmInsBefore()> <input type=button value=Вместо Onclick=ItmReplace()> <input type=button value=После Onclick=ItmInsAfter()> текущей, <input type=button value=Удалить Onclick=ItmDelete()> всю строку или <input type=button value=Закрыть Onclick=modalClose(document.getElementById(\'hid\').value)> без сохранения <input type=hidden value=x id=hid></label></td></tr>';