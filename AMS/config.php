
<?php
$connect=Mysqli_connect("localhost","root");
if(!$connect)
{
	echo "Error".Mysqli_error();
	}
	
	
	$db=Mysqli_select_db($connect,"attendance_db");
	if(!$db)
	{
		echo "Error".Mysqli_error($connect);
	}
		



?>