<?php

$dbhost = "localhost";
$dbuser = "root";
$dbpass = "pwdpwd";
$db = "movie_library";
$conn = mysqli_connect($dbhost, $dbuser, $dbpass,$db) or die("Connect failed: %s\n". $conn -> error);

?>