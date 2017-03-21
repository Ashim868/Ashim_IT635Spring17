<?php 	

$localhost = "localhost";
$username = "ashim";
$password = "ashim1";
$dbname = "wholesale";

// db connection
$connect = mysqli($localhost, $username, $password, $dbname);
// check connection
if($connect->connect_error) {
  die("Connection Failed : " . $connect->connect_error);
} else {
  // echo "Successfully connected";
}

?>
