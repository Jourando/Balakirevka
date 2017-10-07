<?php
function getContent($a1, $m1) {
$i=0;
foreach (glob("depart*.a") as $filename) {
    $fArray[$i]=$filename; 
	$j=0;
	if ($fArray[$i] !== "depart0000.a") {
		$lines[$i] = file($fArray[$i], FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
		$rx[$i]="<tr id=sec".$i."hdr class=T2><td id=hdr".$i." colspan=19 class=depHdr>Отдел: ".$m1[$i]."</td></tr>\r\n";
		echo $rx[$i];
		foreach($lines[$i] as $v) {
			list($n, $depart, $dStart, $dEnd, $vd, $acType, $acOwner, $acName, $acPlace, $oLvl, $oAud, $oSeer, $oPrt, $OOP, $hostHead, $hostLd, $hostOrg, $fin, $adInfo) = explode("|", $lines[$i][$j]);
			$rs[$i][$j]="<tr id=sec".$i."line".$j." class=T1 name=skip Onclick='modalEdit(\"sec".$i."line".$j."\")'><td id=s".$i."r".$j."c1>".$n."</td><td id=s".$i."r".$j."c2>".$depart."</td><td id=s".$i."r".$j."c3>".$dStart."</td><td id=s".$i."r".$j."c4>".$dEnd."</td><td id=s".$i."r".$j."c5>".$vd."</td><td id=s".$i."r".$j."c6>".$acType."</td><td id=s".$i."r".$j."c7>".$acOwner."</td><td id=s".$i."r".$j."c8>".$acName."</td><td id=s".$i."r".$j."c9>".$acPlace."</td><td id=s".$i."r".$j."c10>".$oLvl."</td>";
			$rs[$i][$j]=$rs[$i][$j]."<td id=s".$i."r".$j."c11>".$oAud."</td><td id=s".$i."r".$j."c12>".$oSeer."</td><td id=s".$i."r".$j."c13>".$oPrt."</td><td id=s".$i."r".$j."c14>".$OOP."</td><td id=s".$i."r".$j."c15>".$hostHead."</td><td id=s".$i."r".$j."c16>".$hostLd."</td><td id=s".$i."r".$j."c17>".$hostOrg."</td><td id=s".$i."r".$j."c18>".$fin."</td><td id=s".$i."r".$j."c19>".$adInfo."</td></tr>\r\n";
			echo $rs[$i][$j];
			$j=$j+1;
		}
	}
	$i=$i+1;
}
}
$cell1='<tr>';
$cell2='</tr>';
$cell3='</td>';
$linearr [0] = array($cell1, $cell2, $cell3);
$linearr[1] = array(
	cell1 => array("cnt" => "номер", "w" => "1", "h" => "2"),
	cell2 => array("cnt" => "отделение", "w" => "1", "h" => "2"),
	cell3 => array("cnt" => "дата", "w" => "2", "h" => "1"),
	cell4 => array("cnt" => "вид деятельности", "w" => "1", "h" => "2"),
	cell5 => array("cnt" => "мероприятие", "w" => "3", "h" => "1"),
	cell6 => array("cnt" => "место проведения", "w" => "1", "h" => "2"),
	cell7 => array("cnt" => "охват", "w" => "4", "h" => "1"),
	cell8 => array("cnt" => "организация", "w" => "4", "h" => "1"),
	cell9 => array("cnt" => "орг.-финансовое", "w" => "1", "h" => "2"),
	cell10 => array("cnt" => "доп.информация", "w" => "1", "h" => "2")
	);
$linearr[2] = array(
	cell1 => array("cnt" => "начало", "w" => "1", "h" => "1"),
	cell2 => array("cnt" => "конец", "w" => "1", "h" => "1"),
	cell3 => array("cnt" => "форма работы", "w" => "1", "h" => "1"),
	cell4 => array("cnt" => "наше/совместное/иное", "w" => "1", "h" => "1"),
	cell5 => array("cnt" => "название", "w" => "1", "h" => "1"),
	cell6 => array("cnt" => "уровень", "w" => "1", "h" => "1"),
	cell7 => array("cnt" => "целевая аудитория", "w" => "1", "h" => "1"),
	cell8 => array("cnt" => "зрители", "w" => "1", "h" => "1"),
	cell9 => array("cnt" => "выступающие/участники", "w" => "1", "h" => "1"),
	cell10 => array("cnt" => "ОП", "w" => "1", "h" => "1"),
	cell11 => array("cnt" => "руководитель", "w" => "1", "h" => "1"),
	cell12 => array("cnt" => "ответственный", "w" => "1", "h" => "1"),
	cell13 => array("cnt" => "организатор", "w" => "1", "h" => "1")
	);
$tmpTR='';
for ($j=1; $j<count($linearr); $j++) {
	$tmpTR=$tmpTR.$cell1;
	for ($i=1; $i<count($linearr[$j])+1; $i++) {
		$tmpTD="<th";
		if ($linearr[$j]["cell".$i]["w"] !== '1') {$tmpTD=$tmpTD.' colspan='.$linearr[$j]["cell".$i]["w"];}
		if ($linearr[$j]["cell".$i]["h"] !== '1') {$tmpTD=$tmpTD.' rowspan='.$linearr[$j]["cell".$i]["h"];}
		$tmpTR=$tmpTR.$tmpTD.'>'.$linearr[$j]["cell".$i]["cnt"].$cell3;
	}
	$tmpTR=$tmpTR.$cell2;
}
echo $tmpTR;
?>