<?php
error_reporting(E_ALL ^ E_DEPRECATED);
$pagetitle="Students Attendance";
include "includes/header1.php"; 

include("Config.php");
$atid               =$_POST['attID'];
$stdname            =$_POST['std_roll_no'];
$Unitid             =$_POST['Unitid'];
$atten              =$_POST['Attendance'];
$date               =$_POST['Date'];
$query=mysqli_query($connect,"Insert into tbl_attendence (attID,std_roll_no, Unitid,Attendence,Date)VALUES('$atid','$stdname','$Unitid','$atten','$date')");
if(!$query)
{
	echo "Error".Mysqli_error($connect);

	}




 include "includes/footer.php"; 

?>