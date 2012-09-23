<?php
include("zdb.php");




$query = "SELECT 
	charts.*, 
	charts_subjects.*,
	subjects.id AS subsub_id, 
	subjects.title AS subsub_title
	FROM charts, charts_subjects, subjects 
	WHERE charts.id = charts_subjects.chart_id AND charts_subjects.subject_id = subjects.id
	ORDER BY subject_id;";

$result = mysql_query($query) or die(mysql_error());


function listheaders($result) {
	
	
   while($row = mysql_fetch_array($result)) {
   	$subjectid = $row[subject_id]; 
  	$subjecttitle = $row[subsub_title];

		if ($subjectid != $previoussubject) {
			echo '<li><a href="#'. $subjecttitle . '">' . $subjecttitle . '</a></li>';
		}

		$previoussubject = $subjectid;
	}
}


function listcharts($result) {

$previoussubject = "";  

   while($row = mysql_fetch_array($result)) {
   	$subjectid = $row[subject_id];
   	$subjecttitle = $row[subsub_title];
   	$chartid = $row[id];
   	$charttitle = $row[title];
	$chartsubtitle = $row[subtitle];
   	

		if ($subjectid != $previoussubject) {
			echo '<h2 id="'. $subjecttitle . '">' . $subjecttitle . '</h2>';
		}


		echo '<p><strong>' . $chartid . '</strong> <a href="/charts/view/' . $chartid . '">' . $charttitle . '</a><br>' . $chartsubtitle . '</p>';

		$previoussubject = $subjectid;
	}
   	
}


listheaders($result);

echo '<hr>';

listcharts($result);






// 
// $query = "SELECT 
// 	charts.*, 
// 	charts_subjects.*,
// 	subjects.id AS subsub_id,
// 	subjects.title AS subsub_title
// 	FROM charts, charts_subjects, subjects 
// 	WHERE charts.id = charts_subjects.chart_id AND charts_subjects.subject_id = subsub_id
// 	ORDER BY subject_id;";
// 
// $result = mysql_query($query) or die(mysql_error());
// 
// $previoussubject = "";
// 
//   
//    while($row = mysql_fetch_array($result)) {
//    	$subjectid = $row[subject_id];
//    	$chartid = $row[id];
//    	$charttitle = $row[title];
// 	$chartsubtitle = $row[subtitle];
//    	
// 
// 		if ($subjectid != $previoussubject) {
// 			echo '<h1>' . $subjectid . '</h1>';
// 		}
// 
// 
// 		echo '<p><strong>' . $chartid . '</strong> <a href="/charts/view/' . $chartid . '">' . $charttitle . '</a><br>' . $chartsubtitle . '</p>';
// 
// 		$previoussubject = $subjectid;
// 	}
//    	

   
/*

But what I want is a list like this:
<h1>$subject1</h1>
$charttitle
$charttitle
$charttitle
<h1>$subject2</h1>
$charttitle
$charttitle
$charttitle
etc.

*/

// 
// $query = "SELECT id,title,subtitle,download_image_file_path,download_file_file_path FROM charts ";
// $result = mysql_query($query);
// 
// $query2 = "SELECT * FROM charts_subjects";
// $result2 = mysql_query($query2);
// 
// 
// while($row2 = mysql_fetch_array($result2)) {
// 
// echo '<h2>Heading</h2>';
// 
// if($row2[1] == 8) {
// 	echo "$row2[0] <br>";
// }}


// while($row2 = mysql_fetch_array($result2)) {
// 	$chartid = $row2[0];
// 	$subjectid = $row2[1];
// 
// if ($subjectid == 8){
// echo $chartid . ', '.$subjectid .'<br/>';
// }
// }


// 
// 
// $listarray = array(4,5,6,7,8,9,10,11,12,45,66);
// 
// while($row = mysql_fetch_row($result)) {
// 	$id = $row[0];
// 	$title = $row[1];
// 	$subtitle = $row[2];
// 	$excel = $row[4];
// 
// 
// //if($id == 120 ) {
// 
// if (in_array($id, $listarray)){
// echo '<p><strong>' . $id . '</strong> <a href="/charts/view/' . $id . '">'. $title . '</a><br /> '. $subtitle . ' </p>';
// 
// } else {
// 	echo '';
// }}
// 



/*

while($row = mysql_fetch_array($result)) {
	$chartid = $row[0];
	$subjectid = $row[1];

if ($subjectid == 8){
echo $chartid . ', '.$subjectid .'<br/>';
}
}


*/


/*


function replacement($zzid) {
if ($zzid !='') {
	$result = mysql_query("SELECT title,subtitle,download_image_file_path,download_file_file_path FROM charts WHERE id = '$zzid'");
	if (!$result) {
    	echo 'Could not run query: ' . mysql_error();
    	exit;
	}
$row = mysql_fetch_row($result);
$title = $row[0];
$subtitle = $row[1];

$replacement = '<p><strong>' . $zzid . '</strong> <a href="/charts/view/' . $zzid . '">'. $title . '"</a><br /> '. $subtitle . ' </p>';

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
