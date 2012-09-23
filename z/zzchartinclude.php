<html>
<body>
<?php

include("zdb.php");


$result = mysql_query("SELECT title,subtitle FROM charts WHERE id = '122'");
if (!$result) {
    echo 'Could not run query: ' . mysql_error();
    exit;
}
$row = mysql_fetch_row($result);

echo $row[0]; // 42
echo $row[1]; // the email value


?>

<br />
<br />
<h1>Chart HTML generator</h1>
	Insert chart ID number. It's at the end of the chart's URL.<br>
	Ex: "Lower-income families experience higher medical burdens"<br>

http://www.stateofworkingamerica.org/beta/charts/view/<span style="color:green; font-weight: bold;">105<span>

<form action="zpost.php" method="post">
<p><input type=text name="zzid" size="20"></p>
<p><input type=submit name=submit value="Submit"></p>
</form>





</body>
</html>