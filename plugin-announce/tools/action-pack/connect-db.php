<?php

/*

CONNECT-DB.PHP

Allows PHP to connect to your database

*/



// Database Variables (edit with your own server information)

$server = 'localhost';

$user = 'root';

$pass = '';

$db = 'pluginannouncement';



// Connect to Database

$conn = mysqli_connect($server, $user, $pass)

or die ("Could not connect to server ... \n" . mysql_error ());

mysqli_select_db($conn,$db)

or die ("Could not connect to database ... \n" . mysql_error ());





?>