<?php
session_start();
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "attendance_db";

$_SESSION["id"] = $_POST["id"];


if(!$_SESSION["id"]==null){
// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
$sql ="use attendance_db";
if($conn->query($sql)===TRUE) {

        $stmt = $conn->prepare("select user_type from users where id=? ");
        $stmt->bind_param("s", $_SESSION["id"]);
        $stmt->execute();
        $stmt->bind_result($user_category);

        $stmt->fetch();
        $stmt->close();
        if ($user_category != null) {

            switch ($user_category) {
                case "Lecturer":
                    $stmt = $conn->prepare("select id from users where id=? ");
                    $stmt->bind_param("s", $_SESSION["id"]);
                    $stmt->execute();
                    $stmt->bind_result($userid);
                    $stmt->fetch();

                    echo $stmt->num_rows();
                    if($userid!=null){
                        header("Location:organization_profileView.php");
                    }else {
                        header("Location:noprofile.php");
                    }
                    $stmt->close();
                }
            }
        }
}
?>
