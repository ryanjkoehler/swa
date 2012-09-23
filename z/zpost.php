<html>
<body>
<?php

include("zdb.php");


echo "
<br />
<br />
<h1>Chart HTML generator</h1>
";

$zzid = $_POST['zzid'];



echo '<textarea name="copy" rows="15" cols="50">';


$result = mysql_query("SELECT download_image_file_path,download_file_file_path,title,subtitle FROM charts WHERE id = '$zzid'");
if (!$result) {
    echo 'Could not run query: ' . mysql_error();
    exit;
}
$row = mysql_fetch_row($result);

echo '<!--[[' . $zzid . ']] chartbegin--><div class="chart"><a href="/beta/charts/view/' . $zzid . '"><img src="/beta/files/images/med/' . $row[0] . '"></a><div class="excel"><a href="/beta/files/files/' . $row[1] . '">Download Excel data</a></div></div> <!-- chartend -->';

//echo $row[1]; 

echo '</textarea>';




$result = mysql_query("SELECT download_image_file_path,download_file_file_path,title,subtitle FROM charts WHERE id = '$zzid'");
if (!$result) {
    echo 'Could not run query: ' . mysql_error();
    exit;
}
$row = mysql_fetch_row($result);

echo '<!--[[' . $zzid . ']] chartbegin--><div class="chart"><a href="/beta/charts/view/' . $zzid . '"><img src="/beta/files/images/med/' . $row[0] . '"></a><div class="excel"><a href="/beta/files/files/' . $row[1] . '">Download Excel data</a></div></div> <!-- chartend -->';








echo htmlspecialchars($clean);


?>






</body>
</html>