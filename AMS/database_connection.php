<?php

//database_connection.php

$connect = new PDO("mysql:host=localhost;dbname=attendance_db","root","");

$base_url = "http://localhost/tutorial/student-attendance-system-in-php-using-ajax/";

function get_total_records($connect, $table_name)
{
	$query = "SELECT * FROM $table_name";
	$statement = $connect->prepare($query);
	$statement->execute();
	return $statement->rowCount();
}

function load_grade_list($connect)
{
	$query = "
	SELECT * FROM subject_table ORDER BY Unitname ASC
	";
	$statement = $connect->prepare($query);
	$statement->execute();
	$result = $statement->fetchAll();
	$output = '';
	foreach($result as $row)
	{
		$output .= '<option value="'.$row["Unitid"].'">'.$row["Unitname"].'</option>';
	}
	return $output;
}

function get_attendance_percentage($connect, $student_id)
{
	$query = "
	SELECT 
		ROUND((SELECT COUNT(*) FROM time 
		WHERE Attendance = 'P' 
		AND std_roll_no = '".$student_id."') 
	* 100 / COUNT(*)) AS percentage FROM time
	WHERE std_roll_no= '".$student_id."'
	";

	$statement = $connect->prepare($query);
	$statement->execute();
	$result = $statement->fetchAll();
	foreach($result as $row)
	{
		if($row["percentage"] > 0)
		{
			return $row["percentage"] . '%';
		}
		else
		{
			return 'NA';
		}
	}
}

function Get_student_name($connect, $student_id)
{
	$query = "
	SELECT student_name FROM student_table 
	WHERE std_roll_no = '".$student_id."'
	";

	$statement = $connect->prepare($query);

	$statement->execute();

	$result = $statement->fetchAll();

	foreach($result as $row)
	{
		return $row["student_name"];
	}
}

function Get_student_grade_name($connect, $student_id)
{
	$query = "
	SELECT Subject_table.Unitname FROM student_table 
	INNER JOIN Subject_table
	ON Subject_table.Unitid = student_table.Unitid 
	WHERE student_table.std_roll_no = '".$student_id."'
	";
	$statement = $connect->prepare($query);
	$statement->execute();
	$result = $statement->fetchAll();
	foreach($result as $row)
	{
		return $row['Unitname'];
	}
}

function Get_student_teacher_name($connect, $student_id)
{
	$query = "
	SELECT Subject_table.lecturername 
	FROM student_table 
	INNER JOIN Subject_table 
	ON Subject_table.Unitid = student_table.Unitid 
	INNER JOIN tbl_teacher 
	ON users.Unitid = Subject_table.Unitid 
	WHERE student_table.std_roll_no = '".$student_id."'
	";
	$statement = $connect->prepare($query);
	$statement->execute();
	$result = $statement->fetchAll();
	foreach($result as $row)
	{
		return $row["lecturername"];
	}
}

function Get_grade_name($connect, $grade_id)
{
	$query = "
	SELECT Unitname FROM Subject_table 
	WHERE Unitid = '".$grade_id."'
	";
	$statement = $connect->prepare($query);
	$statement->execute();
	$result = $statement->fetchAll();
	foreach($result as $row)
	{
		return $row["Unitname"];
	}
}

?>