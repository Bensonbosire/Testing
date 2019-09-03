<?php

namespace Phppot;
use \Phppot\Member;
if (! empty($_POST["register-user"])) {
    
    $username = filter_var($_POST["username"], FILTER_SANITIZE_STRING);
    $displayName = filter_var($_POST["fname"], FILTER_SANITIZE_STRING);
    $password = filter_var($_POST["password"], FILTER_SANITIZE_STRING);
    $email = filter_var($_POST["email"], FILTER_SANITIZE_STRING);
    $mobile = filter_var($_POST["mobile_no"], FILTER_SANITIZE_STRING);
    $usertype = filter_var($_POST["usertype"], FILTER_SANITIZE_STRING);
    $activasion = filter_var($_POST["activate"], FILTER_SANITIZE_STRING);
    require_once ("Member.php");
    /* Form Required Field Validation */
    $member = new Member();
    $errorMessage = $member->validateMember($username, $displayName, $password, $email,$mobile,$usertype, $activasion);
    
    if (empty($errorMessage)) {
        $memberCount = $member->isMemberExists($username, $email);
        
        if ($memberCount == 0) {
            $insertId = $member->insertMemberRecord($username, $displayName, $password, $email,$mobile,$usertype,$activasion);
            if (! empty($insertId)) {
                header("Location: thankyou.php");
            }
        } else {
            $errorMessage[] = "User already exists.";
        }
    }
    
	
	
			//send email
			$to = $_POST['email'];
			$subject = "Registration Confirmation";
			$body = "<p>Thank you for registering at demo site.</p>
			<p>To activate your account, please click on this link: <a href='".DIR."activate.php?x=$id&y=$activasion'>".DIR."activate.php?x=$id&y=$activasion</a></p>
			<p>Regards Site Admin</p>";

			$mail = new Mail();
			$mail->setFrom(SITEEMAIL);
			$mail->addAddress($to);
			$mail->subject($subject);
			$mail->body($body);
			$mail->send();

			//redirect to index page
			header('Location: index2.php?action=joined');
			exit;


	
				//check for any errors
				if(isset($error)){
					foreach($error as $error){
						echo '<p class="bg-danger">'.$error.'</p>';
					}
				}

				//if action is joined show sucess
				if(isset($_GET['action']) && $_GET['action'] == 'joined'){
					echo "<h2 class='bg-success'>Registration successful, please check your email to activate your account.</h2>";
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
                            <hr class="team_hr team_hr_left hr_gray"/><span class="span_blog txt_darkgrey txt_orange">Welcome Please signup</span>
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
                        <h3 class="panel-title">Please signup</h3>
                       <!-- <?php //if(sqlValue("select count(1) from membership_groups where allowSignup=1")){ ?>-->
					<a class="btn btn-success pull-right" href="login.php"><?php echo'Already Member Login'; ?></a>
				
				<div class="clearfix"></div>
			</div>
                    </div>
                    <div class="panel-body">
            <form role="form" method="post" action="index2.php">
            <div class="form-group">
                <label>Username</label>
                <div>
                    <input type="text" class="form-control"
                     name="username" onBlur="checkUsernameAvailability()" 
                         pattern="^[a-zA-Z][a-zA-Z0-9-_.]{5,12}$" title="User must be alphanumeric without spaces 6 to 12 chars"
                          class="input-xlarge" required
                        value="<?php if(isset($_POST['username'])) echo $_POST['username']; ?>">
                        <p class="help-block">Username can contain any letters or numbers, without spaces 6 to 12 chars </p>
                </div>
            </div>
            <div class="form-group">
			<label>User type</label>
			<select name="usertype" id="usertype" >
				<option value="<?php if(isset($_POST['usertype'])) echo $_POST['usertype']; ?>"></option>
				<option value="Lecturer">Lecturer</option>
			</select>
		</div>
            <div class="form-group">
                <label>Password</label>
                <div><input type="password" class="form-control"
                pattern="^\S{4,}$" onchange="this.setCustomValidity(this.validity.patternMismatch ? 'Must have at least 4 characters' : '');
                 if(this.checkValidity()) form.password_two.pattern = this.value;"  required class="input-xlarge"
                    name="password" value=""></div>
                    <p class="help-block">Password should be at least 4 characters</p>
            </div>
            <div class="form-group">
                <label>Confirm Password</label>
                <div>
                    <input type="password" class="form-control"
    name="confirmpassword" pattern="^\S{4,}$" onchange="this.setCustomValidity(this.validity.patternMismatch ? 'Must have at least 4 characters' : ''); 
    if(this.checkValidity()) form.password_two.pattern = this.value;"  required class="input-xlarge"
                         value="">
                         
                </div>
            </div>
            <div class="form-group">
                <label>Full Name</label>
                <div>
                    <input type="text" class="form-control"
                        name="fname"  pattern="[a-zA-Z\s]+" title="Full name must contain letters only" class="input-xlarge" required
                        value="<?php if(isset($_POST['fname'])) echo $_POST['fname']; ?>">
                        <p class="help-block">Full can contain any letters only</p> 
                </div>

            </div>
            <div class="form-group">
                <label>Email</label>
                <div>
                    <input type="text" class="form-control"
                        name="email" name="email" placeholder="" onBlur="checkEmailAvailability()" class="input-xlarge" required
                        value="<?php if(isset($_POST['email'])) echo $_POST['email']; ?>">
             <span id="email-availability-status" style="font-size:12px;"></span>
        <p class="help-block">Please provide your E-mail</p>
                       
                </div>
            </div>
            <div class="form-group">
			<label>Mobile Number</label>
            <div>
			<input type="int" class="form-control" id="mobile_no" name="mobile_no" pattern="[0-9]{10}" 
            maxlength="10"  title="10 numeric digits only"   class="input-xlarge" required
            value="<?php if(isset($_POST['mobile_no'])) echo $_POST['mobile_no']; ?>">
            <p class="help-block">Mobile Number Contain only 10 digit numeric values</p>
		</div>

            <div class="form-group">
                <div class="terms">
                    <input type="checkbox" name="terms"> I accept terms
                    and conditions
                </div>
                <div>
                    
                        <button type="sumbit" name="register-user" value="Register" class="btn btn-lg btn-success">Register</button>  
                        </form>
                    </div>
                </div>
            </div>
            </div>
            </div>
            </div>
            </div>
    <?php include "includes/footer.php"; ?>