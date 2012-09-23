<?php
include("zdb.php");

function replacement($zzid) {
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



$br = '<br />';
echo $br . "<hr>";



function text() {
	$body = "This is the [[12]] text, inside the function text().";
	echo $body;
}

text();



echo $br;




$text = "Blabla bla bla bla bla. [[5]] Also, [[111]] bla bla bla bla bla [[27]] Hey, and bla bla bla! [[129]]";

$zpreg = preg_match_all('#\[\[(\d{1,3})\]\]#', $text, $matches );

$zzid = $matches[1][0];

foreach($matches[1] as $match) { 
	
	echo $match . '<br />';
	
	}


$available_ids = 2; //what do I have to put here to make it go match by match until it runs out of matches? i.e., $match

var_dump( $matches[1] );  


   $newtext = preg_replace('#\[\[(\d{1,3})\]\]#', replacement($matches[1][$id_inc]), $text);
// $newtext = preg_replace('#\[\[(\d{1,3})\]\]#', replacement($available_id), $text);


/*

function pr_rc($match)
{
   $vars = var_dump( $matches[1] );
   $which = intval($matches[1]);
   
   if($which<0 || $which>=count($vars)) $which=0;
  
   return $vars[$which];
}


$newtext=preg_replace_callback('#\[\[(\d{1,3})\]\]#','pr_rc',$text);

*/






// echo $text;



echo "<br>";
echo "<br>";
echo "<br>";

echo $newtext;

echo "<br>";
echo "<br>";
echo "<br>";




echo replacement(8);
echo replacement(82);











echo $br;







?>
