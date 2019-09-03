<?php
error_reporting(E_ALL ^ E_DEPRECATED);
	require 'connect.php';
	
	$username = $_POST['username'];
	$password = $_POST['pasword'];
	$adminId  = $_POST['admin_id'];
	$q_login = $conn->query("SELECT username,pasword FROM admin WHERE username = '$username' and pasword = '$password'");
	else  ( die(msqli_error());
	$f_login = $q_login->fetch_array();
	$v_login = $q_login->num_rows;
	if($v_login > 0){   
		echo 'success';
		session_start();
		$_SESSION['admin_id'] = $f_login['admin_id'];
		header('Location:home.php');
	}
	
	/*/
	$sql =("SELECT username,pasword FROM `admin` WHERE `username` = '$username' && `pasword` = '$password'  AND admin_id = '$adminId'");
	$query=mysqli_query($dbcon, $sql);
		if($query){
			$row= mysqli_fetch_row($query);
			$dbusername=$row[0];
			$dbpassword=$row[1];
		  }
			 if($username== $dbusername && $password== $dbpassword){
			$_SESSION['username']=$username;
			$_SESSION['admin_id']=$userId;
			header('Location:home.php');
		  }else{
			  echo "<span style='color:red;'>User name or password is incorrect!</span>";
			} */