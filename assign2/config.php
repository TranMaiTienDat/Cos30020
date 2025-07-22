<?php


//  //swin server
 $host = "feenix-mariadb.swin.edu.au";
 $user = "s104207944";
  $pswd = "060603";
 $dbnm = "s104207944_db";



// $host = "localhost";
// $user = "root";
// $pass = "";
// $dbname = "friend_management";

$conn = new mysqli($host, $user, $pswd, $dbnm);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>
