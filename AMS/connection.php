<?php 
$dbcon = mysqli_connect("localhost","root","","attendance_db") or die (mysqli_error($connect));

// Check connection
if (mysqli_connect_error())
  {
  echo "Failed to connect to MySQL: " . mysqli_connect_error();
  
  }

 ?>