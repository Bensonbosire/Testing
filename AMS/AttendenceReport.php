<?php
 error_reporting(E_ALL ^ E_DEPRECATED);
  $pagetitle="student Report";
  include "includes/header.php";
 require 'config.php';
$program=$_POST['Program'];
$session=$_POST['Session']; 
$Unit   =$_POST['Unitid'];
?>

  <div class="container">
  <div class="row">
                    <div class="templatemo-line-header" style="margin-top: 0px;" >
                        <div class="text-center">
                            <hr class="team_hr team_hr_left hr_gray"/><span class="span_blog txt_darkgrey txt_orange">Attendance Report</span>
                            <hr class="team_hr team_hr_right hr_gray" />
                        </div>
                    </div>
                </div>
<?php
error_reporting(E_ALL ^ E_DEPRECATED);
$connect=Mysqli_connect("localhost","root","");
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

<button type="submit" id="print" onclick="printPage()">Print</button>
<script>
function printPage() {
    window.print();
}
</script>
	 <div align="right">
		<b style="color:blue;">Date Prepared:</b>
		<?php include('current-date.php'); ?>
        </div>

	<div class="table-responsive">
                 <table class="ui celled table table table-hover">
                  <thead>
                    <tr>
                    <th>StudentRollNumber</th>
                      <th>StudentName</th>
                      <th>Unit</th>
                      <th>Program</th>
                      <th>Semester</th>
                      <th>Percentage</th>
                      <th>Comments</th>
                    </tr>
                  </thead>
     <tbody>
          <?php 
 $query=mysqli_query($connect,"Select (Select count(*) from time where Attendance='P')/ count(std_roll_no) 
 *100 as Percentage from time")  or die( mysqli_error($connect));
 $query3=mysqli_query($connect,"Select * from time T 
inner join student_table st on st.std_roll_no=T.std_roll_no
inner join subject_table S on T.Unitid=S.Unitid where T.Unitid like '%$Unit%' and  T.Session like '%$session%' and T.Program like '%$program%'  group by T.std_roll_no")  or die( mysqli_error($connect));

if($query3 === false) {
  echo "error while executing mysql: " . mysqli_error($connect);
 } else 

while($row=Mysqli_fetch_row($query3))
{
  echo '<td>'. $row[1] . '</td>';
  echo '<td>'. $row[10] . '</td>';
echo '<td>'. $row[20] . '</td>';
echo '<td>'. $row[3] . '</td>';
echo '<td>'. $row[4] . '</td>';


$query=mysqli_query($connect,"Select (select count(*) from time where Attendance='P' and std_roll_no='$row[1]' 
and Unitid='$row[2]')/(Select count(Attendance) from time where std_roll_no='$row[1]'
and Unitid='$row[2]')*100 as per from time where std_roll_no='$row[1]' group by per asc ")  or die( mysqli_error($connect));

while ($row2=mysqli_fetch_row($query))
{
echo '<td>'. $row2[0] . '%</td>';
if($row2[0]<30)
{
echo "<td><span style='color:red;'>Not Quarified To Sit For Exams</span></td>";

}
else
echo "<td><span style='color:green;'>Quarified to sit for exams</span></td>";


}
echo"</tr>";
}
?>
</tbody>     
 </table>
  </div><!--table-responsive-->
 </div><!--container-->

          <?php include "includes/footer.php"; ?>
