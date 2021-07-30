<?php
//Opens a connection to a MySQL server.
$connection=mysqli_connect ("localhost", 'root', '','mapboxproject');
if (!$connection) {
    die('Not connected : ' . mysqli_connect_error());
}

// define('DB_SERVER', 'localhost');
// define('DB_USERNAME', 'root');
// define('DB_PASSWORD', '');
// define('DB_NAME', 'mapboxproject');
 
/* Attempt to connect to MySQL database */
 $link = mysqli_connect("localhost", 'root', '','mapboxproject');
 
// Check connection
if($link === false){
    die("ERROR: Could not connect. " . mysqli_connect_error());
}
?>