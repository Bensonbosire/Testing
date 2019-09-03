<?php

error_reporting(E_ALL ^ E_DEPRECATED);
session_start();
$pagetitle="Students Attendance";
include "includes/header.php"; 

include("Config.php");
    $student = $_POST['std_roll_no'];
	$unit    = $_POST['Unitid'];
	$program = $_POST['Program'];
	$session = $_POST['Session'];
	$att     = $_POST['Attendance'];
	$week    = $_POST['week'];

	date_default_timezone_set('Africa/Nairobi');

	$time = date("H:i" );
	$date = date("Y-m-d");
 $query=mysqli_query($connect,"INSERT INTO `time` VALUES('', '$student', '$unit',
 '$program','$session','$att','$week', '$time', '$date')") or die(mysqli_error($connect));
	echo "
	<div class='text-center' 'color-orange'>
	
	 <h3 <label class = 'text-info'>Attendance Taken at ".date("h:i a", strtotime($time))."</label></h3> 
                            
                        </div>";
	
	

	 include "includes/footer.php"; 
?>