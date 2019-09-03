<?php
namespace Phppot;

use \Phppot\DataSource;

class Member
{

    private $dbConn;

    private $ds;

    function __construct()
    {
        require_once "DataSource.php";
         
        $this->ds = new DataSource();
    }

    function validateMember()
    {
        $valid = true;
        $errorMessage = array();
        foreach ($_POST as $key => $value) {
            if (empty($_POST[$key])) {
                $valid = false;
            }
        }
        
        if($valid == true) {
            // Password Matching Validation
            if ($_POST['password'] != $_POST['confirmpassword']) {
                $errorMessage[] = 'Passwords should be same.';
                $valid = false;
            }
            
            // Email Validation
            if (! isset($error_message)) {
                if (! filter_var($_POST["email"], FILTER_VALIDATE_EMAIL)) {
                    $errorMessage[] = "Invalid email address.";
                    $valid = false;
                }
            }
            
            // Validation to check if Terms and Conditions are accepted
            if (! isset($error_message)) {
                if (! isset($_POST["terms"])) {
                    $errorMessage[] = "Accept terms and conditions.";
                    $valid = false;
                }
            }
        }
        else {
            $errorMessage[] = "All fields are required.";
        }
        
        if ($valid == false) {
            return $errorMessage;
        }
        return;
    }

    function isMemberExists($username, $email)
    {
        $query = "select * FROM users WHERE username = ? OR email = ?";
        $paramType = "ss";
        $paramArray = array($username, $email);
        $memberCount = $this->ds->numRows($query, $paramType, $paramArray);
        
        return $memberCount;
    }

    function insertMemberRecord($username, $displayName, $password, $email,$mobile,$usertype)
    {
        $passwordHash = md5($password);
        $activasion = md5(uniqid(rand(),true));
        $query = "INSERT INTO users (username, fname, password, email,mobile_no,usertype,activate) VALUES (?, ?, ?,?,?,?,?)";
        $paramType = "sssssss";
        $paramArray = array(
            $username,
            $displayName,
            $passwordHash,
            $email,
            $mobile,
            $usertype,
            $activasion
        );
        $insertId = $this->ds->insert($query, $paramType, $paramArray);
       return $insertId;
    }
}