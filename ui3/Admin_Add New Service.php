<?php
session_start();
include 'partials/_dbconnect.php';

if(isset($_POST['servicetype']))
{
    $addservicetypename = $_POST['servicetype'];
    $addservicetypecost = $_POST['servicecost'];
    $postadminmasterkey = $_POST['masterkey'];
    if($postadminmasterkey=='1234'){
        try{
            $query1 = "INSERT INTO `services` ( `servicetype`,`servicecost`) VALUES ('$addservicetypename','$addservicetypecost')";
            $query_run1 = mysqli_query($conn, $query1);
            $_SESSION['addednewservice'] = "A new service has been added";
        }
        catch(Exception $e){
            $_SESSION['addednewserviceerror']="Service already exists";
        }
    }
    else{
        $_SESSION['postadminmasterkeyerror']="Invalid masterkey";
    }

}
?>








<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <title>ServiceLagbe</title>
    <link rel="stylesheet" href="assets/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Lora">
    <link rel="stylesheet" href="assets/fonts/font-awesome.min.css">
    <link rel="stylesheet" href="assets/fonts/ionicons.min.css">
    <link rel="stylesheet" href="assets/css/Article-Clean.css">
    <link rel="stylesheet" href="assets/css/Footer-Basic.css">
    <link rel="stylesheet" href="assets/css/Login-Form-Clean.css">
    <link rel="stylesheet" href="assets/css/Navigation-Clean.css">
    <link rel="stylesheet" href="assets/css/Navigation-with-Button.css">
    <link rel="stylesheet" href="assets/css/Navigation-with-Search.css">
    <link rel="stylesheet" href="assets/css/Registration-Form-with-Photo.css">
    <link rel="stylesheet" href="assets/css/styles.css">
</head>

<body>
    <nav class="navbar navbar-light navbar-expand-md navigation-clean-search" style="background-color: rgb(255,255,255);">
        <div class="container"><a class="navbar-brand" href="./index.php">ServiceLagbe</a><button data-toggle="collapse" class="navbar-toggler" data-target="#navcol-1"><span class="sr-only">Toggle navigation</span><span class="navbar-toggler-icon"></span></button>
            <div class="collapse navbar-collapse"
                id="navcol-1">
                <ul class="nav navbar-nav">
                    <li class="nav-item" role="presentation"><a class="nav-link active" href="./About.php">About</a></li>
                    <li class="nav-item" role="presentation"><a class="nav-link" href="./Contact.php">Contact</a></li>
                    <li class="nav-item" role="presentation"><a class="nav-link" href="./All%20Services.php">All Services</a></li>
                    <li class="nav-item" role="presentation"><a class="nav-link" href="#"></a></li>
                </ul>
                <form class="form-inline mr-auto" target="_self">
<!--                    <div class="form-group"><label for="search-field"><i class="fa fa-search"></i></label><input class="border-secondary form-control search-field" type="search" id="search-field" name="search"></div>-->
<!--                    <div class="form-group"><a class="btn btn-light action-button" role="button" href="#">Search&nbsp;</a></div>-->
                </form>
            </div>
            <span class="actions">
                <a class="btn btn-light action-button" role="button" href="./Post%20Administrator%20Login.php">Welcome <?php echo $_SESSION['username'] ?></a>
                <a class="btn btn-light action-button" role="button" href="./Logout.php">Logout</a>
            </span>
        </div>
    </nav>

    <div class="login-clean">

        <form action="./Admin_Add%20New%20Service.php" method="post">
            <?php
            if(isset($_SESSION['addednewservice']) && $_SESSION['addednewservice']!=''){
                echo '<h5 class="text-center">'.$_SESSION['addednewservice'].'</h5><br>';
                unset($_SESSION['addednewservice']);
            }
            if(isset($_SESSION['addednewserviceerror']) && $_SESSION['addednewserviceerror']!=''){
                echo '<h5 class="text-center">'.$_SESSION['addednewserviceerror'].'</h5><br>';
                unset($_SESSION['addednewserviceerror']);
            }
            ?>
            <div class="form-group"><input class="form-control" type="text" placeholder="Service Type" name="servicetype"></div>
            <div class="form-group"><input class="form-control" type="text" placeholder="Service Cost" name="servicecost"></div>
            <div class="form-group"><input class="form-control" type="password" name="masterkey" placeholder="Master Key"></div>
            <div class="form-group"><button class="btn btn-primary btn-block" type="submit" style="background-color: rgb(102, 215, 215);">Add</button></div>
        </form>
    </div>
    <div class="footer-basic" style="background-color: rgb(237,237,237);">
        <footer>
            <div class="social"><a href="#"><i class="icon ion-social-instagram"></i></a><a href="#"><i class="icon ion-social-snapchat"></i></a><a href="#"><i class="icon ion-social-twitter"></i></a><a href="#"><i class="icon ion-social-facebook"></i></a></div>
            <ul class="list-inline">
                <li class="list-inline-item"><a href="./Terms.php">Terms</a></li>
                <li class="list-inline-item"><a href="./Privacy%20Policy.php">Privacy Policy</a></li>
            </ul>
            <p class="copyright">ServiceLagbe © 2022</p>
        </footer>
    </div>
    <script src="assets/js/jquery.min.js"></script>
    <script src="assets/bootstrap/js/bootstrap.min.js"></script>
</body>

</html>