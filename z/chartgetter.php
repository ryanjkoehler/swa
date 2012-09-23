<?php

function es_replacement($zzid) {
$result = mysql_query("SELECT download_image_file_path,download_file_file_path,title,subtitle FROM charts WHERE id = '$zzid'");

$row = mysql_fetch_row($result);

$replacement = '<div align="right"><div class="download-share"><span class="downloads"><ul><li><a href="/files/files/' . $row[1] . '">Excel data</a> | <a href="/charts/view/' . $zzid . '">Go to  chart</li></ul></span></div>
<div class="chart"><a href="/charts/view/' . $zzid . '"><img src="/files/images/med/' . $row[0] . '"></a></div></div>';

return $replacement;

}


function es_replacement_page($zzid) {
$result = mysql_query("SELECT download_image_file_path,download_file_file_path,title,subtitle FROM charts WHERE id = '$zzid'");

$row = mysql_fetch_row($result);
$title = $row[2];
$subtitle = $row[3];

$replacement = '<p><strong>' . $zzid . '</strong> <a href="/charts/view/' . $zzid . '">'. $title . '"</a><br /> '. $subtitle . ' </p>';

return $replacement;

}





function es_getcharts($text){	
	// Looks in text for all IDs in the form [[127]] and replaces them with the chart with ID 127
	// You need the e modifier in preg_replace to make it evaluate (using eval()) the new code instead of just outputting it
	// Also see example #4 here http://nl3.php.net/manual/en/function.preg-replace.php

	   $newtext = preg_replace('#\[\[(\d{1,3})\]\]#e', 'es_replacement(\\1)', $text);
	// $newtext = preg_replace('#\[\[(\d{1,3})\]\]#e', 'es_replacement($1)', $text); // should also work. newer/preferred
	return $newtext;
}

function es_getcharts_page($text){	
	// Looks in text for all IDs in the form [[127]] and replaces them with the chart with ID 127
	// You need the e modifier in preg_replace to make it evaluate (using eval()) the new code instead of just outputting it
	// Also see example #4 here http://nl3.php.net/manual/en/function.preg-replace.php

	   $newtext = preg_replace('#\[\[(\d{1,3})\]\]#e', 'es_replacement_page(\\1)', $text);
	// $newtext = preg_replace('#\[\[(\d{1,3})\]\]#e', 'es_replacement_page($1)', $text); // should also work. newer/preferred
	return $newtext;
}


?>