<?php
include("zdb.php");



$text = "Blabla bla bla bla bla. [[5]] Also, [[111]] bla bla bla bla bla [[27]] Hey, and bla bla bla! [[129]]";





function es_replacement($zzid) {
if ($zzid !='') {
	$result = mysql_query("SELECT download_image_file_path,download_file_file_path,title,subtitle FROM charts WHERE id = '$zzid'");
	if (!$result) {
    	echo 'Could not run query: ' . mysql_error();
    	exit;
	}
$row = mysql_fetch_row($result);

$replacement = '<!--[[' . $zzid . ']] chartbegin--><div class="chart"><a href="/beta/charts/view/' . $zzid . '"><img src="/beta/files/images/med/' . $row[0] . '"></a><div class="excel"><a href="/beta/files/files/' . $row[1] . '">Download Excel data</a></div></div> <!-- chartend -->';

return $replacement;
}
else {
	return "No chart ID was specified.";
}
}


function es_getcharts($text){	
	// Looks in text for all IDs in the form [[127]] and replaces them with the chart with ID 127
	// You need the e modifier in preg_replace to make it evaluate (using eval()) the new code instead of just outputting it
	// Also see example #4 here http://nl3.php.net/manual/en/function.preg-replace.php

	   $newtext = preg_replace('#\[\[(\d{1,3})\]\]#e', 'es_replacement(\\1)', $text);
	// $newtext = preg_replace('#\[\[(\d{1,3})\]\]#e', 'es_replacement($1)', $text); // should also work. newer/preferred

}




//$zzid = $matches[1][0];

//var_dump( $matches[1] );  






echo "<br>";
echo "<br>";
echo "<br>";

echo $newtext;



?>
