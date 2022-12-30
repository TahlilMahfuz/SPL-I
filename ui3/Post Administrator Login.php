<?php
session_start();
include 'partials/_dbconnect.php';

if(isset($_POST['delete_btn']))
{
    $id = $_POST['delete_id'];

    $query = "DELETE FROM serviceproviders WHERE providerid='$id' ";
    $query_run = mysqli_query($conn, $query);

    if($query_run)
    {
        $_SESSION['deletedprovider'] = "Service Provider Removed";
    }
    else
    {
        $_SESSION['deletedprovidererror'] = "Sorry, Deletion could be processed. Something went wrong";
    }
}

if(isset($_POST['add_btn']))
{
    $id = $_POST['add_id'];
    $servicetype = $_POST['servicetype'];

    $query1 = "SELECT * FROM serviceproviders WHERE providerid='$id' ";
    $query2 = "DELETE FROM serviceproviders WHERE providerid='$id' ";

    $query_run1 = mysqli_query($conn, $query1);
    if(mysqli_num_rows($query_run1)==1 && $servicetype!="Choose..."){
        while($row = mysqli_fetch_assoc($query_run1)){
            $approvedproviderid = $row["providerid"];
            $username = $row["username"];
            $email = $row["email"];
            $phone = $row["phone"];
            $address = $row["address"];
            $password = $row["password"];
        }
        $sql = "INSERT INTO `approvedserviceproviders` ( `username`,`servicetype`,`email`,`phone`,`address`, `password`, `dt`) VALUES ('$username','$servicetype','$email','$phone','$address', '$password', current_timestamp())";
        $result = mysqli_query($conn, $sql);
        if($result){
            $query_run2 = mysqli_query($conn, $query2);

            if($query_run1 && $query_run1)
            {
                $_SESSION['approvedprovider'] = "Service Provider is Approved";
            }
            else
            {
                $_SESSION['approvedprovidererror'] = "Sorry, approval could be processed. Something went wrong";
            }
        }

    }
    else{
        echo ' <div class="alert alert-warning alert-dismissible fade show" role="alert">
        <strong>Warning!</strong> Please choose the service type
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
        </div> ';
    }

}


if(isset($_POST['addservicetypename']))
{
    $addservicetypename = $_POST['addservicetypename'];
    $addservicetypecost = $_POST['addservicetypecost'];
    $postadminmasterkey = $_POST['postadminmasterkey'];
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
    <nav class="navbar navbar-light navbar-expand-md navigation-clean-search" style="background-color: rgb(237,237,237);">
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
    <h1>&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;&nbsp;</h1>
    <h1>&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;&nbsp;</h1>
    <nav class="navbar navbar-light navbar-expand-md navigation-clean-button">
        <div class="container"><button data-toggle="collapse" class="navbar-toggler" data-target="#navcol-1"><span class="sr-only">Toggle navigation</span><span class="navbar-toggler-icon"></span></button>
            <div class="collapse navbar-collapse" id="navcol-1"><span class="navbar-text actions"> <a class="btn btn-light action-button" role="button" href="./Admin_Service%20Providers%20Request.php">Service Providers Request</a></span></div>
        </div>
    </nav>
    <nav class="navbar navbar-light navbar-expand-md navigation-clean-button">
        <div class="container"><button data-toggle="collapse" class="navbar-toggler" data-target="#navcol-1"><span class="sr-only">Toggle navigation</span><span class="navbar-toggler-icon"></span></button>
            <div class="collapse navbar-collapse" id="navcol-1"><span class="navbar-text actions"> <a class="btn btn-light action-button" role="button" href="./Admin_Approved%20Service%20Providers.php">Approved Service Providers</a></span></div>
        </div>
    </nav>
    <nav class="navbar navbar-light navbar-expand-md navigation-clean-button">
        <div class="container"><button data-toggle="collapse" class="navbar-toggler" data-target="#navcol-1"><span class="sr-only">Toggle navigation</span><span class="navbar-toggler-icon"></span></button>
            <div class="collapse navbar-collapse" id="navcol-1"><span class="navbar-text actions"> <a class="btn btn-light action-button" role="button" href="./Admin_User%20List.php">Userlist</a></span></div>
        </div>
    </nav>
    <nav class="navbar navbar-light navbar-expand-md navigation-clean-button">
        <div class="container"><button data-toggle="collapse" class="navbar-toggler" data-target="#navcol-1"><span class="sr-only">Toggle navigation</span><span class="navbar-toggler-icon"></span></button>
            <div class="collapse navbar-collapse" id="navcol-1"><span class="navbar-text actions"> <a class="btn btn-light action-button" role="button" href="./Admin_Add%20New%20Service.php">Add New Service</a></span></div>
        </div>
    </nav>
    <h1>&nbsp; &nbsp; &nbsp; &nbsp; &nbsp;</h1>
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