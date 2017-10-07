<?php
class TCell {
	var $content;
	var $width=1;
	var $height=1;
	function GetCont() {
		echo $this->content;
	}
	function SetCont($cnt) {
		echo $this->content=$cnt;
	}
	function GetWidth() {
		echo $this->width;
	}
	function SetWidth($w) {
		echo $this->width=$w;
	}
	function GetHeight() {
		echo $this->height;
	}
	function SetHeight($h) {
		echo $this->height=$h;
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
	cell8 => array("cnt" => "организатор", "w" => "4", "h" => "1"),
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
	echo "<style>";
	echo "th {border: 1px solid #333}";
	echo "</style>";
$tmpTR='';
echo "<Table>";
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
echo "</table>";
echo "<p>--- +++ </p><hr><p>".count($linearr)."</p>";
?>