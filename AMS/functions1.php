<?php 
	error_reporting(E_ALL & ~ E_NOTICE);
	
	

	// connect to database
	$db = mysqli_connect('localhost', 'root', '', 'attendance_db');

	// variable declaration
	$username = "";
	$email    = "";
	$errors   = array(); 
		
	function format_email($info, $format){

		//set the root
		$root = $_SERVER['DOCUMENT_ROOT'].'/dev/tutorials/email_signup';
	
		//grab the template content
		$template = file_get_contents($root.'/signup_template.'.$format);
				
		//replace all the tags
		$template = ereg_replace('{USERNAME}', $info['username'], $template);
		$template = ereg_replace('{EMAIL}', $info['email'], $template);
		$template = ereg_replace('{KEY}', $info['key'], $template);
		$template = ereg_replace('{SITEPATH}','http://site-path.com', $template);
			
		//return the html of the template
		return $template;
	
	}

	function send_email($info){
		
		//format each email
		$body = format_email($info,'html');
		$body_plain_txt = format_email($info,'txt');
	
		//setup the mailer
		$transport = Swift_MailTransport::newInstance();
		$mailer = Swift_Mailer::newInstance($transport);
		$message = Swift_Message::newInstance();
		$message ->setSubject('Welcome to Pwani University Online attendance System');
		$message ->setFrom(array('noreply@sitename.com' => 'PU online attendance system'));
		$message ->setTo(array($info['email'] => $info['username']));
		
		$message ->setBody($body_plain_txt);
		$message ->addPart($body, 'text/html');
				
		$result = $mailer->send($message);
		
		return $result;
		
	}
	//cleanup the errors
function show_errors($action){

	$error = false;

	if(!empty($action['result'])){
	
		$error = "<ul class=\"alert $action[result]\">"."\n";

		if(is_array($action['text'])){
	
			//loop out each error
			foreach($action['text'] as $text){
			
				$error .= "<li><p>$text</p></li>"."\n";
			
			}	
		
		}else{
		
			//single error
			$error .= "<li><p>$action[text]</p></li>";
		
		}
		
		$error .= "</ul>"."\n";
		
	}

	return $error;

}
	function activate(){
		global $db, $errors;
	   
		
	    $activate    =  e($_POST['activate']);

		if (!isset($_GET['confirm']) || empty($_GET['confirm'])) {
			die('Error: an activation code is required.');
		}
		if (isset($_GET['confirmcode'])||  ($_GET['confirmcode'])) { 
			$activate = e($_POST['activate']);
			$query = "INSERT INTO users (activate) 
					  VALUES($activate')";
			mysqli_query($db, $query);
			$_SESSION['success']  = "New user activation successfully!!"; echo 'signin';
			header('location: login.php');
		}
			else{
			$query = "INSERT INTO users (username, email, usertype, password,confirmpassword,mobile_no) 
					  VALUES('$username', '$email', '$user_type', '$password_1','$password_2','$mobile')";
			mysqli_query($db, $query);
      

			
		}

		function isLoggedIn()
		{
			if (isset($_SESSION['username'])) {
				return true;
			}else{
				return false;
			}
		}
	
		function isAdmin()
		{
			if (isset($_SESSION['id']) && $_SESSION['username']['usertype'] == 'admin' ) {
				return true;
			}else{
				return false;
			}
		}
	
		// escape string
		function e($val){
			global $db;
			return mysqli_real_escape_string($db, trim($val));
		}
	
		function display_error() {
			global $errors;
	
			if (count($errors) > 0){
				echo '<div class="error">';
					foreach ($errors as $error){
						echo $error .'<br>';
					}
				echo '</div>';
			}
		}
		}
?>