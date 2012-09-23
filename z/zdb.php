<?php
 $prod = 
	array(
		'driver' => 'mysql',
		'persistent' => false,
		'host' => 'mysql2011.stateofworkingamerica.org',
		'login' => 'swadbuser2011',
		'password' => '3piswa22',
		'database' => 'swadb2011',
		'encoding' => 'utf8',
	);

$link = mysql_connect($prod["host"], $prod["login"], $prod["password"]);
mysql_select_db($prod["database"]);

if (!$link) {
    die('Could not connect: ' . mysql_error());
}
else {
 echo 'Connected successfully! <br> <br><br>';
}

?>

