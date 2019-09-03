<?php

//attendance_action.php

include('admin/database_connection.php');
require 'config.php';
session_start();
$output = '';
if(isset($_POST["action"]))
{
 if($_POST["action"] == 'fetch')
 {
  $query = "
  SELECT * FROM time 
  INNER JOIN student_table 
  ON student_table.std_roll_no= time.std_roll_no
  INNER JOIN Subject_table 
  ON Subject_table.Unitid = time.Unitid
  WHERE users.id = '".$_SESSION["id"]."' AND (";
  if(isset($_POST["search"]["value"]))
  {
   $query .= 'student_table.student_name LIKE "%'.$_POST["search"]["value"].'%" 
      OR student_table.std_roll_no LIKE "%'.$_POST["search"]["value"].'%" 
      ORtime.AttendanceLIKE "%'.$_POST["search"]["value"].'%" 
      ORtime.date LIKE "%'.$_POST["search"]["value"].'%") ';
  }
  if(isset($_POST["order"]))
  {
   $query .= 'ORDER BY '.$_POST['order']['0']['column'].' '.$_POST['order']['0']['dir'].' ';
  }
  else
  {
   $query .= 'ORDER BYtime.time_id DESC ';
  }
  if($_POST["length"] != -1)
  {
   $query .= 'LIMIT ' . $_POST['start'] . ', ' . $_POST['length'];
  }

  $statement = $connect->prepare($query);
  $statement->execute();
  $result = $statement->fetchAll();
  $data = array();
  $filtered_rows = $statement->rowCount();
  foreach($result as $row)
  {
   $sub_array = array();
   $status = '';
   if($row["Attendance"] == 'P')
   {
    $status = '<label class="badge badge-success">Present</label>';
   }
   if($row["Attendance"] == 'A')
   {
    $status = '<label class="badge badge-danger">A</label>';
   }
   
   $sub_array[] = $row["student_name"];
   $sub_array[] = $row["std_roll_no"];
   $sub_array[] = $row["Unitname"];
   $sub_array[] = $status;
   $sub_array[] = $row["date"];
   $data[] = $sub_array;
  }

  $output = array(
   "draw"    => intval($_POST["draw"]),
   "recordsTotal"  =>  $filtered_rows,
   "recordsFiltered" => get_total_records($connect, 'time'),
   "data"    => $data
  );
  echo json_encode($output);
 }
 if($_POST["action"] == "Add")
 {
  $date = '';
  $error_date = '';
  $error = 0;
  if(empty($_POST["date"]))
  {
   $error_date = 'Attendance Date is required';
   $error++;
  }
  else
  {
   $date = $_POST["date"];
  }
  if($error > 0)
  {
   $output = array(
    'error'       => true,
    'error_date'   => $error_date
   );
  }
  else
  {
   $std_roll_no = $_POST["std_roll_no"];
   $query = '
   SELECT date FROM time 
   WHERE id = "'.$_SESSION["id"].'" 
   AND date = "'.$date.'"
   ';
   $statement = $connect->prepare($query);
   $statement->execute();
   if($statement->rowCount() > 0)
   {
    $output = array(
     'error'     => true,
     'error_date' => 'Attendance Data Already Exists on this date'
    );
   }
   else
   {
    for($count = 0; $count < count($std_roll_no); $count++)
    {
     $data = array(
      ':std_roll_no'   => $std_roll_no[$count],
      ':Attendance' => $_POST["Attendance".$std_roll_no[$count].""],
      ':date'  => $date,
      ':id'   => $_SESSION["id"]
     );

     $query = "
     INSERT INTO time 
     (std_roll_no, Attendance, date, id) 
     VALUES (:std_roll_no, :Attendance, :date, :id)
     ";
     $statement = $connect->prepare($query);
     $statement->execute($data);
    }
    $output = array(
     'success'  => 'Data Added Successfully',
    );
   }
  }
  echo json_encode($output);
 }

 if($_POST["action"] == "index_fetch")
 {
  $query = "
  SELECT * FROM time 
  INNER JOIN student_table 
  ON student_table.std_roll_no =time.std_roll_no 
  INNER JOIN Subject_table 
  ON Subject_table.Unitid = student_table.student_Unitid 
  WHERE time.id = '".$_SESSION["id"]."' AND (";
  if(isset($_POST["search"]["value"]))
  {
   $query .= 'student_table.student_name LIKE "%'.$_POST["search"]["value"].'%" 
      OR student_table.std_roll_no LIKE "%'.$_POST["search"]["value"].'%" 
      OR Subject_table.Unitname LIKE "%'.$_POST["search"]["value"].'%" )';
  }

  $query .= 'GROUP BY student_table.std_roll_no ';
  if(isset($_POST["order"]))
  {
   $query .= 'ORDER BY '.$_POST['order']['0']['column'].' '.$_POST['order']['0']['dir'].' ';
  }
  else
  {
   $query .= 'ORDER BY student_table.std__roll_no ASC ';
  }

  if($_POST["length"] != -1)
  {
   $query .= 'LIMIT ' . $_POST['start'] . ', ' . $_POST['length'];
  }

  $statement = $connect->prepare($query);
  $statement->execute();
  $result = $statement->fetchAll();
  $data = array();
  $filtered_rows = $statement->rowCount();
  foreach($result as $row)
  {
   $sub_array = array();
   $sub_array[] = $row["student_name"];
   $sub_array[] = $row["std_roll_no"];
   $sub_array[] = $row["Unitname"];
   $sub_array[] = get_attendance_percentage($connect, $row["std_roll_no"]);
   $sub_array[] = '<button type="button" name="report_button" id="'.$row["std_roll_no"].'" class="btn btn-info btn-sm report_button">Report</button>';
   $data[] = $sub_array;
  }

  $output = array(
   "draw"    => intval($_POST["draw"]),
   "recordsTotal"  =>  $filtered_rows,
   "recordsFiltered" => get_total_records($connect, 'student_table'),
   "data"    => $data
  );
  echo json_encode($output);  
 }
}



?>
