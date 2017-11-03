function edTab(em){
var hdrStr='';
var edtStr='';
if (em==1) {
	hdrStr='<tr><th rowspan=2>'+xth[1]+'</th><th rowspan=2>'+xth[2]+'</th><th colspan=2>'+xth[3]+'</th><th rowspan=2>'+xth[4]+'</th><th colspan=3>'+xth[5]+'</th><th rowspan=2>'+xth[6]+'</th><th colspan=4>'+xth[7]+'</th><th colspan=4>'+xth[8]+'</th><th rowspan=2>'+xth[9]+'</th><th rowspan=2>'+xth[10]+'</th></tr>';
	hdrStr+='<tr><th>'+yth[1]+'</th><th>'+yth[2]+'</th><th>'+yth[3]+'</th><th>'+yth[4]+'</th><th>'+yth[5]+'</th><th>'+yth[6]+'</th><th>'+yth[7]+'</th><th>'+yth[8]+'</th><th>'+yth[9]+'</th><th>'+yth[10]+'</th><th>'+yth[11]+'</th><th>'+yth[12]+'</th><th>'+yth[13]+'</th></tr>';
	edtStr='<tr>';
	for (xI=0; xI<19; xI++) {
		edtStr+='<td id=et'+xI+'><input type=text id=ext'+xI+' size='+esize[xI]+' style="width: 96%"';
		if ((xI==0) || (xI==1)) {edtStr+=' readonly class=RO';}
		if ((xI==2) || (xI==3)) {edtStr+=' id=inpTxt'+xI+' Onfocus="showHint(this.id)"';}
		edtStr+='></td>';
	}
	edtStr+='</tr>';
	edtStr+='<tr><td colspan=19><p>Вставить строку <input type=button value=Перед Onclick=ItmInsert("before")> <input type=button value=Вместо Onclick=ItmInsert("replace")> <input type=button value=После Onclick=ItmInsert("after")> текущей, <input type=button value=Удалить Onclick=ItmInsert("erase")> всю строку или <input type=button value=Закрыть Onclick=modalClose(document.getElementById(\'hid\').value)> без сохранения <input type=hidden value=x id=hid></p></td></tr>';
} else if (em==2) {
	hdrStr='<tr><th rowspan=2>'+xth[1]+'</th><th rowspan=2>'+xth[2]+'</th><th colspan=2>'+xth[3]+'</th><th rowspan=2>'+xth[4]+'</th><th colspan=3>'+xth[5]+'</th><th rowspan=2 colspan=2>'+xth[6]+'</th></tr>';
	hdrStr+='<tr><th>'+yth[1]+'</th><th>'+yth[2]+'</th><th>'+yth[3]+'</th><th>'+yth[4]+'</th><th>'+yth[5]+'</th></tr>';
	hdrStr+='<tr><td id=et0><input type=text id=ext0 style="width: 96%" readonly class=RO></td>';
	hdrStr+='<td id=et1><input type=text id=ext1 style="width: 96%" readonly class=RO></td>';
	hdrStr+='<td id=et2><input type=text id=ext2 style="width: 96%" id=inpTxt2 Onfocus="showHint(this.id)"></td>';
	hdrStr+='<td id=et3><input type=text id=ext3 style="width: 96%" id=inpTxt3 Onfocus="showHint(this.id)"></td>';
	hdrStr+='<td id=et4><input type=text id=ext4 style="width: 96%" id=inpTxt4></td>';
	hdrStr+='<td id=et5><input type=text id=ext5 style="width: 96%"></td>';
	hdrStr+='<td id=et6><input type=text id=ext6 style="width: 96%"></td>';
	hdrStr+='<td id=et7><input type=text id=ext7 style="width: 96%"></td>';
	hdrStr+='<td id=et8 colspan=2><input type=text id=ext8 style="width: 96%"></td></tr>';
	hdrStr+='<tr><th colspan=4>'+xth[7]+'</th><th colspan=4>'+xth[8]+'</th><th rowspan=2>'+xth[9]+'</th><th rowspan=2>'+xth[10]+'</th></tr>';
	hdrStr+='<tr><th>'+yth[6]+'</th><th>'+yth[7]+'</th><th>'+yth[8]+'</th><th>'+yth[9]+'</th><th>'+yth[10]+'</th><th>'+yth[11]+'</th><th>'+yth[12]+'</th><th>'+yth[13]+'</th></tr>';
	hdrStr+='<tr><td id=et9><input type=text id=ext9 style="width: 96%"></td>';
	hdrStr+='<td id=et10><input type=text id=ext10 style="width: 96%"></td>';
	hdrStr+='<td id=et11><input type=text id=ext11 style="width: 96%"></td>';
	hdrStr+='<td id=et12><input type=text id=ext12 style="width: 96%"></td>';	
	hdrStr+='<td id=et13><input type=text id=ext13 style="width: 96%"></td>';
	hdrStr+='<td id=et14><input type=text id=ext14 style="width: 96%"></td>';
	hdrStr+='<td id=et15><input type=text id=ext15 style="width: 96%"></td>';
	hdrStr+='<td id=et16><input type=text id=ext16 style="width: 96%"></td>';
	hdrStr+='<td id=et17><input type=text id=ext17 style="width: 96%"></td>';
	hdrStr+='<td id=et18><input type=text id=ext18 style="width: 96%"></td></tr>';
	edtStr='<tr><td colspan=10><p>Вставить строку <input type=button value=Перед Onclick=ItmInsert("before")> <input type=button value=Вместо Onclick=ItmInsert("replace")> <input type=button value=После Onclick=ItmInsert("after")> текущей, <input type=button value=Удалить Onclick=ItmInsert("erase")> всю строку или <input type=button value=Закрыть Onclick=modalClose(document.getElementById(\'hid\').value)> без сохранения <input type=hidden value=x id=hid></p></td></tr>';
} else if (em==3) {
	hdrStr='<tr><th rowspan=2>'+xth[1]+'</th><th rowspan=2>'+xth[2]+'</th><th colspan=2>'+xth[3]+'</th></tr>';
	hdrStr+='<tr><th>'+yth[1]+'</th><th>'+yth[2]+'</th></tr>';
	hdrStr+='<tr><td id=et0><input type=text id=ext0 style="width: 96%" readonly class=RO></td><td id=et1><input type=text id=ext1 style="width: 96%" readonly class=RO></td>';
	hdrStr+='<td id=et2><input type=text id=ext2 style="width: 96%" id=inpTxt2 Onfocus="showHint(this.id)"></td><td id=et3><input type=text id=ext3 style="width: 96%" id=inpTxt3 Onfocus="showHint(this.id)"></td></tr>';
	hdrStr+='<tr><th rowspan=2>'+xth[4]+'</th><th colspan=3>'+xth[5]+'</th></tr>';
	hdrStr+='<tr><th>'+yth[3]+'</th><th>'+yth[4]+'</th><th>'+yth[5]+'</th></tr>';
	hdrStr+='<tr><td id=et4><input type=text id=ext4 style="width: 96%" id=inpTxt4></td><td id=et5><input type=text id=ext5 style="width: 96%"></td>';
	hdrStr+='<td id=et6><input type=text id=ext6 style="width: 96%"></td><td id=et7><input type=text id=ext7 style="width: 96%"></td></tr>';
	hdrStr+='<tr><th colspan=4>'+xth[6]+'</th></tr>';
	hdrStr+='<tr><td id=et8 colspan=4><input type=text id=ext8 style="width: 96%"></td></tr>';
	hdrStr+='<tr><th colspan=4>'+xth[7]+'</th></tr>';
	hdrStr+='<tr><th>'+yth[6]+'</th><th>'+yth[7]+'</th><th>'+yth[8]+'</th><th>'+yth[9]+'</th></tr>';
	hdrStr+='<tr><td id=et9><input type=text id=ext9 style="width: 96%"></td><td id=et10><input type=text id=ext10 style="width: 96%"></td>'; // 9-10
	hdrStr+='<td id=et11><input type=text id=ext11 style="width: 96%"></td><td id=et12><input type=text id=ext12 style="width: 96%"></td></tr>'; // 11-12
	hdrStr+='<tr><th colspan=4>'+xth[8]+'</th></tr>';
	hdrStr+='<tr><th>'+yth[10]+'</th><th>'+yth[11]+'</th><th>'+yth[12]+'</th><th>'+yth[13]+'</th></tr>';
	hdrStr+='<tr><td id=et13><input type=text id=ext13 style="width: 96%"></td><td id=et14><input type=text id=ext14 style="width: 96%"></td><td id=et15><input type=text id=ext15 style="width: 96%"></td><td id=et16><input type=text id=ext16 style="width: 96%"></td></tr>';
	hdrStr+='<tr><th colspan=2>'+xth[9]+'</th><th colspan=2>'+xth[10]+'</th></tr>';
	hdrStr+='<tr><td id=et17 colspan=2><input type=text id=ext17 style="width: 96%"></td><td id=et18 colspan=2><input type=text id=ext18 style="width: 96%"></td></tr>';
	edtStr='<tr><td colspan=4><p>Вставить строку <input type=button value=Перед Onclick=ItmInsert("before")> <input type=button value=Вместо Onclick=ItmInsert("replace")> <input type=button value=После Onclick=ItmInsert("after")> текущей, <input type=button value=Удалить Onclick=ItmInsert("erase")> всю строку или <input type=button value=Закрыть Onclick=modalClose(document.getElementById(\'hid\').value)> без сохранения <input type=hidden value=x id=hid></p></td></tr>';
}
return hdrStr+edtStr; 
}