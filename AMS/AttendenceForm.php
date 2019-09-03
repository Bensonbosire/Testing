<?php  $pagetitle="AttendenceForm";
  include "includes/header.php"; ?>
 <div class="container">
              <div class="row">
                 <div class="templatemo-line-header" style="margin-top: 0px;" >
                        <div class="text-center">
                            <hr class="team_hr team_hr_left hr_gray"/><span class="span_blog txt_darkgrey txt_orange">Attendance Form</span>
                            <hr class="team_hr team_hr_right hr_gray" />
                        </div>
                  </div>
                </div>
<?php  

      //$useDb = $db->query("INSERT INTO db_1.table1 (value_1, value_2) SELECT value_3, value_4 FROM db_2.table2 WHERE db_2.table2.id = 5")
error_reporting(E_ALL ^ E_DEPRECATED);
session_start();
include("config.php");

?>

<div class="form-container">
    <form method="post" action="saveattendence.php" role="form">
     <!-- <div class="container"> -->
     
      <div class="form-group">
      <div class="col-lg-2">  
      <label for="Std_roll_no" >Student</label> 
<?php
      $qs=mysqli_query($connect,"select * from student_table");
      ?>
      <?php	
      echo "<select class='form-control' name='std_roll_no' >";			
      while($stdname=mysqli_fetch_row($qs))
      {				
       echo"
       <option value=$stdname[0]>$stdname[1] </option>";
       }
      echo "</select>"."<br>";
      ?>
      </div><!--col-lg-3-->
     
      
      <div class="col-lg-2">
      <label for="Unitid" >Unit</label> 
      <?php
      $qs1=mysqli_query($connect,"select * from subject_table");	
      echo "<select class='form-control' name='Unitid'>";			
      while($Unitid=mysqli_fetch_row($qs1))
      {				
       echo"
       <option value=$Unitid[0]>$Unitid[1] </option>";
       }
      echo "</select>";
      ?>
       </div><!--col-lg-3-->
      <div class="col-lg-2">
						  <label for="Session" >Session</label>
						   <select  class="form-control" required id="Session" name="Session">
						   <option>Select session</option>
						   <option >2014-2018</option>
						   <option >2015-2019</option>
						   <option >2016-2020</option>
						   <option >2017-2021</option> 
						   <option >2018-2022</option>
						   <option >2019-2023</option>
						   </select>
						   </div>
                     <div class="col-lg-2">

				<label for="Program" >Program</label>
				 <select  class="form-control" required id="Program" name="Program">
				 <option>Select program</option>
				 <option >BSCS</option>
				 <option >BSSC</option>
				 <option >IT</option>
				 <option >MCS</option> 
				 <option >Ms</option>
				 <option >P.HD</option>
				 </select>
				</div>
				</div>
      <div class="col-lg-2">
      <label for="Attendance" >Attendance</label> 
   <select name = "Attendance">
         <option value = "P">Present</option>
         <option value ="A">Absent</option>
         </select><br>
         </div> <!--col-lg-3-->
         <div class="col-lg-2">
<label for="week" >Week</label>
 <select  class="form-control" required id="week" name="week">
 <option>Select Week</option>
 <option >1</option>
 <option >2</option>
 <option >3</option>
 <option >4</option> 
 <option >5</option>
 <option >6</option>
 <option >7</option>
 <option >8</option>
 <option >9</option>
 <option >10</option>
 </select><br>
</div>
<div class="col-lg-2">
      <button type="submit" name="save" value="Save" class="btn btn-success btn-sm">Save</button>
    </div>
 </form>
 </div> <!--form-container-->
</div><!--container-->
<?php include "includes/footer.php"; ?>