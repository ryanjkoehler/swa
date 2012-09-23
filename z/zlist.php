<?php
include("zdb.php");


$query = "SELECT id,title,subtitle,download_image_file_path,download_file_file_path FROM charts";
$result = mysql_query($query);

while($row = mysql_fetch_row($result)) {
	$id = $row[0];
	$title = $row[1];
	$subtitle = $row[2];
	$excel = $row[4];

if($id >= 0 ) {

echo '<p><strong>' . $id . '</strong> <a href="/charts/view/' . $id . '">'. $title . '</a><br /> '. $subtitle . ' </p>';
	
}


}






/*


function replacement($zzid) {
if ($zzid !='') {
	$result = mysql_query("SELECT title,subtitle,download_image_file_path,download_file_file_path FROM charts WHERE id = '$zzid'");
	if (!$result) {
    	echo 'Could not run query: ' . mysql_error();
    	exit;
	}
$row = mysql_fetch_row($result);

$replacement = '<p><strong>' . $zzid . '</strong> <a href="/charts/view/' . $zzid . '">'. $row[0] . '"</a><br /> '. $row[1] . ' </p>';

return $replacement;
}
else {
	return "No chart ID was specified.";
}
}



$br = '<br />';
echo $br . "<hr>";




echo replacement(8);
echo replacement(82);

*/



?>
