<?php
session_start();
if(isset($_POST['appointuserservicetype']))
{
    $server = "localhost";
    $username = "root";
    $password = "test123";
    $database = "servicelagbe";

    $conn = mysqli_connect($server, $username, $password, $database);
    if (!$conn){
        die("Error". mysqli_connect_error());
    }

    $type = $_POST['appointuserservicetype'];
    $findcost="select servicecost from services where servicetype='$type'";
    $query_findcost=mysqli_query($conn,$findcost);
    if(mysqli_num_rows($query_findcost) > 0)
    {
        while($row = mysqli_fetch_assoc($query_findcost))
        {
            $cost=$row['servicecost'];
        }
    }
    $userlocation= $_POST['appointuserlocation'];
    $userid = $_SESSION['userid'];
    $userphone = $_SESSION['userphone'];
    $useraddress = $_POST['appointuserlocation'];

    $sql = "select * from approvedserviceproviders natural join services 
            where approvedserviceproviders.servicetype='$type'
            and approvedserviceproviders.availability=1 and address='$useraddress'
            order by rating asc limit 1";


    $query_run =  mysqli_query($conn, $sql);

    if(mysqli_num_rows($query_run) > 0)
    {
        while($row = mysqli_fetch_assoc($query_run))
        {
            $providerid=$row['approvedproviderid'];
            $providerusername=$row['username'];
            $rating=$row['rating'];
            $servicecount=$row['servicecount'];
            $_SESSION['servicecount']=$row['servicecount'];
            $provideremail=$row['email'];
            $useremail=$_SESSION['email'];
            $providerphone=$row['phone'];
            $provideraddress=$row['address'];
            $detailedlocation=$_POST['detailedlocation'];
        }
        $sql1 = "INSERT INTO `userprovider` (`detailedlocation`,`useremail`,`userid`,`userlocation`,`providerid`,`userphone`,`providerusername`, `provideremail`,`providerphone`,`provideraddress`,`servicetype`,`servicecost`, `dt`) 
                VALUES ('$detailedlocation','$useremail','$userid','$userlocation','$providerid','$userphone','$providerusername', '$provideremail','$providerphone','$provideraddress','$type','$cost', current_timestamp())";
        $query_run2 = mysqli_query($conn, $sql1);
        $queryupdate = "UPDATE approvedserviceproviders SET availability=0 WHERE approvedproviderid='$providerid'";
        $query_run3 = mysqli_query($conn, $queryupdate);

        if($query_run && $query_run2 &&$query_run3)
        {
            $_SESSION['appointrequest'] = "Request for appointment sent";
        }
        else
        {
            $_SESSION['appointrequesterror'] = "Sorry, could not find any service provider for your area.";
        }
    }
    else{
        $v = "Sorry, could not find any service provider for your area.";
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
            </div><span class="actions"> <a class="btn btn-light action-button" role="button" href="./Post%20User%20Login.php">Welcome <?php echo $_SESSION['username']?></a>
                <a class="btn btn-light action-button" role="button" href="./Logout.php">Logout</a></span></div>
    </nav>
    <div class="login-clean">
        <form action="User_Appoint.php" method="post">
            <?php
            if(isset($_SESSION['appointrequest']) && $_SESSION['appointrequest']!=''){
                echo '<h5 class="text-center">'.$_SESSION['appointrequest'].'</h5><br>';
                unset($_SESSION['appointrequest']);
            }
            if(isset($_SESSION['appointrequesterror']) && $_SESSION['appointrequesterror']!=''){
                echo '<h5 class="text-center">'.$_SESSION['appointrequesterror'].'</h5><br>';
                unset($_SESSION['appointrequesterror']);
            }
            if(isset($v)){
                echo '<h5 class="text-center">'.$v.'</h5><br>';
                unset($v);
            }
            ?>
            <?php
            $server = "localhost";
            $username = "root";
            $password = "test123";
            $database = "servicelagbe";

            $conn = mysqli_connect($server, $username, $password, $database);
            if (!$conn){
                die("Error". mysqli_connect_error());
            }

            ?>
            <div class="form-group">
                <select name="appointuserservicetype" class="form-control">
                    <option selected value="12" style="background-color: rgb(247,249,252);color: rgb(108,117,125);width: 240px;height: 42;margin: 0;">Choose...</option>
                    <?php
                    $sql1 = "Select * from services order by servicetype asc";
                    $query_run1 =  mysqli_query($conn, $sql1);
                    if(mysqli_num_rows($query_run1) > 0){
                        while($row1=mysqli_fetch_assoc($query_run1))
                        {
                            ?>
                            <option value="<?php echo $row1['servicetype']; ?>" style="background-color: rgb(247,249,252);color: rgb(108,117,125);width: 240px;height: 42;margin: 0;"><?php echo $row1['servicetype']; ?></option>
                            <?php
                        }
                    }
                    ?>
                </select>
            </div>
            <div class="form-group">
                <select name="appointuserlocation" class="form-control">
                    <option selected value="12" style="background-color: rgb(247,249,252);color: rgb(108,117,125);width: 240px;height: 42;margin: 0;">Choose...</option>
                    <?php
                    $sqllocation = "Select distinct (address) from approvedserviceproviders";
                    $query_run1 =  mysqli_query($conn, $sqllocation);
                    if(mysqli_num_rows($query_run1) > 0){
                        while($row1=mysqli_fetch_assoc($query_run1))
                        {
                            ?>
                            <option value="<?php echo $row1['address']; ?>" style="background-color: rgb(247,249,252);color: rgb(108,117,125);width: 240px;height: 42;margin: 0;"><?php echo $row1['address']; ?></option>
                            <?php
                        }
                    }
                    ?>
                </select>
            </div>
            <div class="form-group">
                <input class="form-control" type="text" name="detailedlocation" placeholder="Detailed Location">
            </div>
            <div class="form-group"><button name="appointuserservice" class="btn btn-primary btn-block" type="submit" style="background-color: rgb(102, 215, 215);">Request</button></div>
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