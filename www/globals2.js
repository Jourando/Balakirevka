// v.10.a.4::global revision
rd='sh_tab_xls_v';
urlStr='http://test2.ru/auth.php?';
datStr='http://test2.ru/writ2.php?';
logStr='http://test2.ru/actlog.php?';
depMod=0;
curMod=0;
var xth = new Array();
var yth = new Array();
xth[0]=10;
xth[1]='номер';
xth[2]='отделение';
xth[3]='дата';
xth[4]='вид деятельности';
xth[5]='мероприятие';
xth[6]='место проведения';
xth[7]='охват';
xth[8]='организация';
xth[9]='орг-фин';
xth[10]='доп.инфо';
yth[0]=13;
yth[1]='начало';
yth[2]='конец';
yth[3]='форма работы';
yth[4]='наше/совместное/иное';
yth[5]='название';
yth[6]='уровень';
yth[7]='ЦА';
yth[8]='зрители';
yth[9]='выступающие/участники'
yth[10]='ОП';
yth[11]='руководитель';
yth[12]='ответственный';
yth[13]='орг';
var esize = new Array();
esize[0]=5;
esize[1]=6;
esize[2]=6;
esize[3]=6;
esize[4]=8;
esize[5]=8;
esize[6]=8;
esize[7]=8;
esize[8]=8;
esize[9]=6;
esize[10]=6;
esize[11]=5;
esize[12]=5;
esize[13]=6;
esize[14]=6;
esize[15]=6;
esize[16]=6;
esize[17]=8;
esize[18]=8;
hdrStr='<tr><th rowspan=2>'+xth[1]+'</th><th rowspan=2>'+xth[2]+'</th><th colspan=2>'+xth[3]+'</th><th rowspan=2>'+xth[4]+'</th><th colspan=3>'+xth[5]+'</th><th rowspan=2>'+xth[6]+'</th><th colspan=4>'+xth[7]+'</th><th colspan=4>'+xth[8]+'</th><th rowspan=2>'+xth[9]+'</th><th rowspan=2>'+xth[10]+'</th></tr>';
hdrStr+='<tr><th>'+yth[1]+'</th><th>'+yth[2]+'</th><th>'+yth[3]+'</th><th>'+yth[4]+'</th><th>'+yth[5]+'</th><th>'+yth[6]+'</th><th>'+yth[7]+'</th><th>'+yth[8]+'</th><th>'+yth[9]+'</th><th>'+yth[10]+'</th><th>'+yth[11]+'</th><th>'+yth[12]+'</th><th>'+yth[13]+'</th></tr>';
edtStr='<tr>';
for (xI=0; xI<19; xI++) {
	edtStr+='<td id=et'+xI+'><input type=text id=ext'+xI+' size='+esize[xI]+' style="width: 96%"';
	if ((xI==0) || (xI==1)) {edtStr+=' readonly';}
	if ((xI==2) || (xI==3)) {edtStr+=' id=inpTxt'+xI+' Onfocus="showHint(this.id)"';}
	edtStr+='></td>';
}
edtStr+='</tr>';
edtStr+='<tr><td colspan=19><label>Вставить строку <input type=button value=Перед Onclick=ItmInsert("before")> <input type=button value=Вместо Onclick=ItmInsert("replace")> <input type=button value=После Onclick=ItmInsert("after")> текущей, <input type=button value=Удалить Onclick=ItmInsert("erase")> всю строку или <input type=button value=Закрыть Onclick=modalClose(document.getElementById(\'hid\').value)> без сохранения <input type=hidden value=x id=hid></label></td></tr>';