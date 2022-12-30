<?php
session_start();
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
                    <li class="nav-item" role="presentation"><a class="nav-link" href="./About.php">About</a></li>
                    <li class="nav-item" role="presentation"><a class="nav-link" href="./Contact.php">Contact</a></li>
                    <li class="nav-item" role="presentation"><a class="nav-link" href="./All%20Services.php">All Services</a></li>
                    <li class="nav-item" role="presentation"><a class="nav-link" href="#"></a></li>
                </ul>
                <form class="form-inline mr-auto" target="_self">
<!--                    <div class="form-group"><label for="search-field"><i class="fa fa-search"></i></label><input class="border-secondary form-control search-field" type="search" id="search-field" name="search"></div>-->
<!--                    <div class="form-group"><a class="btn btn-light action-button" role="button" href="#">Search&nbsp;</a></div>-->
                </form>
            </div><span class="actions"> <a class="btn btn-light action-button" role="button" href="./Post%20User%20Login.php">Welcome <?php echo $_SESSION['username']?></a>
                 <a class="btn btn-light action-button" role="button" href="#">Logout</a></span></div>
    </nav>
    <?php
    if(isset($_SESSION['deleteduser']) && $_SESSION['deleteduser']!=''){
        echo ' <div class="alert alert-success alert-dismissible fade show" role="alert">
            <strong>Success!</strong> Service Provider Removed
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div> ';
        unset($_SESSION['deleteduser']);
    }
    if(isset($_SESSION['deleteduserror']) && $_SESSION['deletedusererror']!=''){
        echo ' <div class="alert alert-danger alert-dismissible fade show" role="alert">
        <strong>Error!</strong> '.$_SESSION['deletedprovidererror'].'
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span>
        </button>
        </div> ';
        unset($_SESSION['deletedusererror']);
    }
    ?>
    <h3 class="text-center"><br>Appointed Services<br><br></h3>
    <div class="table-responsive">
        <?php
        $server = "localhost";
        $username = "root";
        $password = "test123";
        $database = "servicelagbe";

        $conn = mysqli_connect($server, $username, $password, $database);
        if (!$conn){
            die("Error". mysqli_connect_error());
        }


        $userid = $_SESSION['userid'];
        $sql = "Select * from userprovider where userid='$userid' && appointstatus=0";
        $query_run =  mysqli_query($conn, $sql);
        ?>
        <table class="table">
            <thead>
                <tr>
                    <th>OrderID</th>
                    <th>ProviderID</th>
                    <th>Provider Username</th>
                    <th>Provider Email</th>
                    <th>Provider Phone</th>
                    <th>Service Type</th>
                    <th>Service Cost</th>
                </tr>
            </thead>
            <tbody>
                <?php
                if(mysqli_num_rows($query_run) > 0)
                {
                while($row = mysqli_fetch_assoc($query_run))
                    {
                    ?>
                    <tr>
                        <td><?php  echo $row['orderid']; ?></td>
                        <td><?php  echo $row['providerid']; ?></td>
                        <td><?php  echo $row['providerusername']; ?></td>
                        <td><?php  echo $row['provideremail']; ?></td>
                        <td><?php  echo $row['providerphone']; ?></td>
                        <td><?php  echo $row['servicetype']; ?></td>
                        <td><?php  echo $row['servicecost']; ?></td>
                        <!--<?php
                        if($row['appointstatus']==1){
                        ?>
                        <td>
                            <form action="appointedservices.php" method="post">
                                <input type="hidden" name="deleteorder" value="<?php echo $row['orderid']; ?>">
                                <button type="submit" name="deleteorder" class="btn btn-danger">Send delete request</button>
                            </form>
                        </td>
                        <?php
                        }
                        else{
                            ?>
                                <td><?php  echo 'Service Provided' ?></td>
                            <?php
                        }
                        ?>-->
                    </tr>
                    <?php
                    }
                }
                else {
                    echo '<h5 class="text-center">No record found.</h5>';
                }
                ?>
            </tbody>
        </table>
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