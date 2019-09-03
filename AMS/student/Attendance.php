<?php
  $pagetitle="Attendance Program search";
  include "includes/header.php"; ?>
  <div class="container" class="text-center">
                     >
         <div class="row">
                 <div class="templatemo-line-header" style="margin-top: 0px;" >
                        <div       <hr class="team_hr team_hr_left hr_gray"/><span class="span_blog txt_darkgrey txt_orange">Individual Program Searching</span>
                            <hr class="team_hr team_hr_right hr_gray" />
                        </div>
                    </div>
                </div>
<?php
error_reporting(E_ALL ^ E_DEPRECATED);
include("config.php");
?>
    <div class="form-container">

    <form method="post" action="AttendenceReport.php" role="form" class="search-form" style="width: 50%">
    <div class="container">
   
    <div class="row">
          <div class="col-lg-4">

<div class="form-group">
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
<div class="col-lg-3">

          <div class="form-group">
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
          </div>
          <div class="form-group">
          <div class="col-lg-6">
           <label for="Unitid" >Unit Name </label>
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
         </div>
          <div class="col-lg-8"><br>
          <button type="submit" class="btn btn-success btn-lg btn-block" value="Search" name="search">Search</button>
          </div>
          </div>
          </form>
          </div> <!--form-container--> 
          </div><!--container--> 
          <?php include "includes/footer.php"; ?>