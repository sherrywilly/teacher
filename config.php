<?php
date_default_timezone_set("Asia/Kolkata");
$host="localhost";
$db_user="root";
$db_pass="";
$db_name="try1";
$conn = mysqli_connect($host,$db_user,$db_pass,$db_name);

if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
  }
  //echo "Connected successfully";
?>