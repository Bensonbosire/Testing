<?php
 error_reporting(E_ALL ^ E_DEPRECATED);
	require 'config.php';
	$student = $_POST['std_roll_no'];
	$unit = $_POST['Unitid'];
	$program = $_POST['Program'];
	$session = $_POST['Session'];
	$att = $_POST['Attendance'];
    $week =$_POST['week'];
	date_default_timezone_set('Africa/Nairobi');

	$time = date("H:i" );
	$date = date("Y-m-d");
	$query=mysqli_query ($connect,"SELECT  *FROM Student_table WHERE std_roll_no = '$student'") or die(mysqli_error($connect));
	

	$query=mysqli_query($connect,"INSERT INTO `time` VALUES('', '$student', '$unit','$program','$session','$att','$week', '$time', '$date')") or die(mysqli_error($connect));
	echo "<h3 <label class = 'text-info'>Attendance Taken at  ".date("h:i a", strtotime($time))."</label></h3>";

?>
	<a class="btn btn-success pull-right" href="home.php"><?php echo 'Home'; ?></a>