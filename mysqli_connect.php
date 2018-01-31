<?php
DEFINE ('DB_USER', 'root');
DEFINE ('DB_PASSWORD', 'pukar11');
DEFINE ('DB_HOST', 'localhost');
DEFINE ('DB_NAME', 'parking');

$dbc = @mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME)
OR die('Could not connect to MySQL: ' .
mysqli_connect_error());
?>
