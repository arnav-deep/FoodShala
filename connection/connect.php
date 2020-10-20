<?php

global $con;

$servername = "localhost"; //server
$username = "root"; //username	global $con;
$password = ""; //password
$dbname = "foodshala";  //database

// Create connection
$con = new mysqli($servername, $username, $password, $dbname);

// Check connection
if (!$con) {       //checking connection to DB
  echo "Failed to connect to the database: " . mysqli_connect_error();
}
