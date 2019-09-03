<?php
$pagetitle="Attendance taking";


error_reporting(E_ALL ^ E_DEPRECATED);




include("config.php");

?>
<!DOCTYPE html>
<html lang = "eng">
	<head>
		<meta charset = "utf-8" />
		<title>Pwani Online Attendance Recording System</title>
		<meta name = "viewport" content = "width=device-width, initial-scale=1" />
		<link rel = "stylesheet" type = "text/css" href = "css/bootstrap.css"/>
	</head>
	<body class = "alert-info">
		<nav class = "navbar navbar-inverse navbar-fixed-top">
			<div class = "container-fluid">
				<div class = "navbar-header">
					<img src = "image/pulogo.jpg" width = "200px" height = "50px"/>
					<p class = "navbar-text pull-right"> Attendance management System</p>
                                
                            <ul class="nav navbar-nav navbar-right" style="margin-top: 40px;"  role="menu" aria-labelledby="dropdownMenu" aria-expanded="false">
                                 <li><a href="home.php" class="external-link" >Home</a></li>
                                 <li><a href="SearchAttendReport.php" class="external-link">Monthly Report</a></li>
                                <li><a href="Attendance.php" class="external-link">Overall Report</a></li>
                                <li><a href="stdlogin.php" class="external-link" >Log Out</a></li>
                             </ul>
				
			</div>
		</nav>
		<div class = "container-fluid">
			<br />
			<br />
			<br />
			<br />
			<br />
			<br />
			<br />
			<div class = "col-lg-3"></div>
			<div class = "col-lg-6 well">
				<h2>Attendance Login</h2>
				<br />
				<div id = "result"></div>
				<br />
				<br />
				<div class="form-container">

					<form method="post" action="stdattendancelogin.php" role="form" class="search-form" style="width: 50%">
					<div class="container">
				   
					<div class="row">
						  <div class="col-lg-4">
							<div class = "form-group">
								<label for= std_roll_no>StudentRollNumber:</label>
								<input type = "text" id = "std-roll_no" class = "form-control" name="std_roll_no" required = ""/>
								<br />
								<br />
								<div id = "error"></div>
								<br />
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
				
				<br />
				<br />
				
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
				
					
						  <div class="form-group">
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
                  <br />
				  <div class="form-group">
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
				<div class="form-group">
				<div class="checkbox">
                                    <label> <input name="Attendance" type="checkbox" value="P">Attendance</label>
									
                                </div>
								<br />
				<br />
				<div class="form-group">
							<button type="submit" class="btn btn-success btn-lg btn-block" value="login" name="login">Login</button>
							</div>
					</div>
				</form>
			</div>
		</div>
	</body>
	<script src = "js/jquery.js"></script>
	<script src = "js/bootstrap.js"></script>
	<script src = "js/login.js"></script>
</html>