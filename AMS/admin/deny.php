<?php
session_start();
/**
 * Created by PhpStorm.
 * User: Btech
 * Date: 02/05/2019
 * Time: 02:38
 *
 */
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "marvel_database";
//Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
$sql ="use marvel_database";
if($conn->query($sql)===TRUE) {
    $stmt = $conn->prepare("update marvel_verification set verification_status =? where user_id=?");
    $status = "DENIED";
    $stmt->bind_param("ss", $status,$_SESSION["id"] );
    if ($stmt->execute()) {
        header("Location:pendingrequest.php");


    } else {
        echo $stmt->error;
    }
}