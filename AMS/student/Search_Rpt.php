<?php
$pagetitle="Search Report";
include "includes/header.php"; 

error_reporting(E_ALL ^ E_DEPRECATED);
$name=$_POST['name'];
$session=$_POST['Session'];
$date=$_POST['date'];
$program=$_POST['Program'];



include("config.php");

?>

			
<div class="container">

			
 <div class="row">
                    <div class="templatemo-line-header" style="margin-top: 0px;" >
                        <div class="text-center">
                            <hr class="team_hr team_hr_left hr_gray"/><span class="span_blog txt_darkgrey txt_orange">Individual Report </span>
                            <hr class="team_hr team_hr_right hr_gray" />
                        </div>
                    </div>
                </div>

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
                       <th>Attendance</th>
                      <th>Percentage</th>
                    </tr>
                  </thead>
     <tbody>
          <?php        
           // $query=mysqli_query($connect,"Select (Select count(*) from tbl_attendence Where attendence='P')/ count(std_roll_no) *100 as Percentage from tbl_attendence ");
  
$result=mysqli_query($connect,"Select (Select count(*) from time Where Attendance='P')/ count(std_roll_no)
 *100 as Percentage from time ")  or die( mysqli_error($connect));



$query3=Mysqli_query($connect,"Select *from time T 
inner join student_table st on T.std_roll_no=st.std_roll_no
inner join subject_table S on S.Unitid=T.Unitid 
Where st.student_name like '%$name%' and T.date like '%$date%' and st.Session 
like '%$session%' and st.Program like '%$program%'  order by T.date, T.Unitid and T.std_roll_no");


if($query3 === false) {
echo "error while executing mysql: " . mysqli_error($connect);
}  else 

while($row=Mysqli_fetch_row($query3))

{
   
    echo '<td>'. $row[1] . '</td>';
    echo '<td>'. $row[10] . '</td>';
    echo '<td>'. $row[19] . '</td>';
    echo '<td>'. $row[3] . '</td>';
    echo '<td>'. $row[16] . '</td>';
    echo '<td>'. $row[5] . '</br>'.$row[7].'</td>';
   


    
    $result=mysqli_query($connect,"Select (select count(*) from time where Attendance='P' and 
           std_roll_no='$row[1]' and Unitid='$row[2]')/(Select count(Attendance) from time 
           where std_roll_no='$row[1]' and Unitid='$row[2]')*100 as per from time
            where std_roll_no='$row[1]' and Unitid='$row[2]' group by per asc ") or die( mysqli_error($connect));
          
  
		   
		while ($row=mysqli_fetch_row($result))
		   {
        echo '<td>'. $row[0] . '%</td>';
       }
         echo"</tr>";

}
               
              
           ?>
       </tbody>     
            </table>
            </div><!--table-responsive-->
            </div><!--row-->  
            </div><!--container-->    
           

