<?php

$server = 'localhost';
$user = 'root';
$pass = '';
$db = 'book_store_database';

$mysqli = new mysqli($server, $user, $pass, $db);

if ($mysqli -> connect_errno) {
	echo "Failed to connect to MySQL: " . $mysqli -> connect_error;
	exit();
}
/*
    // Check connection
    if (mysqli_connect_errno())
      {
      echo "Failed to connect to MySQL: " . mysqli_connect_error();
      }

    $result = mysqli_query($con,"SELECT * FROM user");

    while($row = mysqli_fetch_array($result))
      {
      echo $row['address'] . " " . $row['user_name']; 
      echo "<br />";
      }
	  
    mysqli_close($con);*/
    ?>