

<?php
session_start();
$_SESSION['ID']=100;


?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Title</title>
    <link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="css/all.css">
    <link rel="stylesheet" href="fontawesome/css/all.min.css">

</head>
<body>
<script src="js/jquery-3.3.1.min.js"> </script>
<script src="bootstrap/js/bootstrap.min.js"> </script>
<nav class="navbar navbar-expand-lg all-color-primary navbar-dark">
    <a class="navbar-brand" href="#"> <img src="../images/happy1.jpeg" width="50" height="50">Marvel Donations Verififation</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarNavDropdown">
        <ul class="navbar-nav mr-auto">
            <li class="nav-item  active">
                <a class="nav-link" href="pendingrequest.php.php"><b class="fa fa-user-friends"></b>Home</a>
            </li>
        </ul>

        <li class="nav-item dropdown ">
            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownLogout" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <span class="fa fa-user-circle"></span>
            </a>
            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdownLogout">
                <a class="dropdown-item" href="#">LogOut</a>
            </div>
        </li>
    </div>
</nav>
<div class="container">
<?php
if($_SESSION["ID"]!=null){
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
        $x="PENDING";
        $stmt = $conn->prepare("select user_id,user_name,reg_date from marvel_verification where verification_status=?");
        $stmt->bind_param("s",$x);
        $stmt->execute();
        $stmt->bind_result($user_id,$user_name,$reg_date);

       while($stmt->fetch()){
           echo '
        <div class="row  mt-3 ">
        <div class="col-12 bg-light mt-2 ">
            <div class="row justify-content-between">
                <div class="col-2 pr-3 pl-0">
                    <img src="images/user.png" height="100" width="100" >

                </div>
                <div class="col-10 align-items-center">
                    <div class="row justify-content-between pl-1 pt-3">
                        <h5>'.$user_name.'</h5>
                        <small class="small text-muted">'.$reg_date.'</small>
                    </div>
                    <div class="row p-1 mt-0">
                       
                    </div>
                    <div class="row">
                        

                    </div>
                    <div class="row al align-content-end">
                        <div class="col-10"></div>
                        <div class="col-2">
                        <form class="form-inline" method="post" action="selectorView.php">
                            <input class="d-none" type="text" value='.$user_id.' name="id">
                            <input class="btn btn-success" type="submit"  name="details" value="check">
                        </form>
                        </div>


                    </div>



                </div>



            </div>
                </div>


    </div>

            ';




       }

    }


}




?>
</div>