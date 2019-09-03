
<?php
error_reporting(E_ALL & ~ E_NOTICE);
session_start();
?>
<?php
       if ($_POST['submit']){
        include 'connection.php';
        $username=($_POST['username']);
		$password=($_POST['password']);
		// make sure form is filled properly
		if (empty($username)) {
			echo "Username is required";
		}
		if (empty($password)) {
			echo "Password is required";
		}

        $sql="SELECT id, username, password FROM users WHERE username='$username' LIMIT 1";
        $query=mysqli_query($dbcon, $sql);
        if($query){
          $row= mysqli_fetch_row($query);
          $userId= $row[0];
          $dbusername=$row[1];
		  $dbpassword=$row[2];
		  $password = md5($password);
        }
           if($username== $dbusername && $password== $dbpassword){
          $_SESSION['username']=$username;
          $_SESSION['id']=$userId;
          header('Location:home.php');
        }else{
            echo "<span style='color:red;'>User name or password is incorrect!</span>";
          }    
} 

?>

        <link href="css/bootstrap.css" rel='stylesheet' type='text/css'>
        <link href="css/semantic.min.css" rel="stylesheet">
        <link href="css/templatemo_style.css"  rel='stylesheet' type='text/css'>
        <link href="css/mystyle.css"  rel='stylesheet' type='text/css'> 
<div class="container">

               <div class="row">
                    <div class="templatemo-line-header" style="margin-top: 40px;" >
                        <div class="text-center">
                            <hr class="team_hr team_hr_left hr_gray"/><span class="span_blog txt_darkgrey txt_orange">Welcome Please LOGIN</span>
                            <hr class="team_hr team_hr_right hr_gray" />
                        </div>
                    </div>
                </div>
 </div>
     <div class="container">
        <div class="row">
            <div class="col-md-4 col-md-offset-4">
                <div class="login-panel panel panel-default">
                    <div class="panel-heading">
                        <h3 class="panel-title">Please Sign In</h3>
                       <!-- <?php //if(sqlValue("select count(1) from membership_groups where allowSignup=1")){ ?>-->
					<a class="btn btn-success pull-right" href="index3.php"><?php echo 'sign up'; ?></a>
				
				<div class="clearfix"></div>
			</div>
                    </div>
                    <div class="panel-body">
                        <form role="form" method="post" action="login.php">
                                <div class="form-group">
                                    <input class="form-control" placeholder="Username" name="username" 
                                    onBlur="checkUsernameAvailability()" 
                         pattern="^[a-zA-Z][a-zA-Z0-9-_.]{5,12}$" title="User must be alphanumeric without spaces 6 to 12 chars"
                          class="input-xlarge" required type="username" autofocus>
                                </div>
                                <div class="form-group">
                                    <input class="form-control" placeholder="Password" name="password" 
                                    pattern="^\S{4,}$" onchange="this.setCustomValidity(this.validity.patternMismatch ? 'Must have at least 4 characters' : '');
                 if(this.checkValidity()) form.password_two.pattern = this.value;"  required class="input-xlarge"
                    name="password" value=""  type="password" autofocus>
                                </div>
                                <div class="checkbox">
                                    <label> <input name="remember" type="checkbox" value="Remember Me">Remember Me</label>
                                </div>
                        <button type="sumbit" name="submit" value="login" class="btn btn-lg btn-success btn-block">Login</button> 
                        <br>
                        <div class="row">
					<div class="col-xs-9 col-sm-9 col-md-9">
						 <a href='reset.php'>Forgot your Password?</a>
					</div>
				</div> 
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
          
 <?php include "includes/footer.php"; ?>