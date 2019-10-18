<?php
 $dBServername = "127.0.0.1";
 $dBUsername = "root";
 $dBPassword = "123456";
 $dBName = "loginsystem";

// Create connection
$conn = mysqli_connect($dBServername, $dBUsername, $dBPassword, $dBName);

if (!conn)
	die("Coonection failed :".mysqli_connect_error());