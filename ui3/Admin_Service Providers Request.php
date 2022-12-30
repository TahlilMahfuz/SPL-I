<?php
    include 'partials/_dbconnect.php';
    session_start();
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
            $_SESSION['servicetypenotchosenerror'] = "Please choose the service type.";
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

    <h3 class="text-center"><br>Service Providers Request<br><br></h3>
    <?php
    if(isset($_SESSION['deletedprovider']) && $_SESSION['deletedprovider']!=''){
        echo '<h5 class="text-center">'.$_SESSION['deletedprovider'].'</h5>';
        unset($_SESSION['deletedprovider']);
    }
    if(isset($_SESSION['postadminmasterkeyerror']) && $_SESSION['postadminmasterkeyerror']!=''){
        echo '<h5 class="text-center">'.$_SESSION['postadminmasterkeyerror'].'</h5>';
        unset($_SESSION['postadminmasterkeyerror']);
    }
    if(isset($_SESSION['deletedprovidererror']) && $_SESSION['deletedprovidererror']!=''){
        echo '<h5 class="text-center">'.$_SESSION['deletedprovidererror'].'</h5>';
        unset($_SESSION['deletedprovidererror']);
    }
    if(isset($_SESSION['approvedprovider']) && $_SESSION['approvedprovider']!=''){
        echo '<h5 class="text-center">'.$_SESSION['approvedprovider'].'</h5>';
        unset($_SESSION['approvedprovider']);
    }
    if(isset($_SESSION['approvedprovidererror']) && $_SESSION['approvedprovidererror']!=''){
        echo '<h5 class="text-center">'.$_SESSION['approvedprovidererror'].'</h5>';
        unset($_SESSION['approvedprovidererror']);
    }
    if(isset($_SESSION['addednewservice']) && $_SESSION['addednewservice']!=''){
        echo '<h5 class="text-center">'.$_SESSION['addednewservice'].'</h5> ';
        unset($_SESSION['addednewservice']);
    }
    if(isset($_SESSION['addednewserviceerror']) && $_SESSION['addednewserviceerror']!=''){
        echo '<h5 class="text-center">'.$_SESSION['addednewserviceerror'].'</h5>';
        unset($_SESSION['addednewserviceerror']);
    }
    if(isset($_SESSION['servicetypenotchosenerror']) && $_SESSION['servicetypenotchosenerror'] != ''){
        echo '<h5 class="text-center">'.$_SESSION['servicetypenotchosenerror'].'</h5>';
        unset($_SESSION['servicetypenotchosenerror']);
    }
    ?>
    <?php
        include 'partials/_dbconnect.php';
        $sql = "Select * from serviceproviders";
        $query_run =  mysqli_query($conn, $sql);
        // $sql1 = "Select * from services order by servicetype asc";
        // $query_run1 =  mysqli_query($conn, $sql1);
    ?>
    <div class="table-responsive">
        <table class="table">
            <thead>
                <tr>
                    <th>ProviderID</th>
                    <th>Username</th>
                    <th>Email</th>
                    <th>Phone</th>
                    <th>Address</th>
                    <th>Service Type</th>
                    <th>Add</th>
                    <th>Delete</th>
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
                        <td><?php  echo $row['providerid']; ?></td>
                        <td><?php  echo $row['username']; ?></td>
                        <td><?php  echo $row['email']; ?></td>
                        <td><?php  echo $row['phone']; ?></td>
                        <td><?php  echo $row['address']; ?></td>
                        <form action="./Admin_Service%20Providers%20Request.php" method="post">
                        <td>

                                <div class="input-group mb-3">
                                    <select name="servicetype" class="custom-select" id="servicetype" required>
                                        <option selected>Choose...</option>
                                        <?php
                                        $sql1 = "Select * from services order by servicetype asc";
                                        $query_run1 =  mysqli_query($conn, $sql1);
                                        if(mysqli_num_rows($query_run1) > 0){
                                            while($row1=mysqli_fetch_assoc($query_run1))
                                            {
                                                ?>
                                                <option value="<?php echo $row1['servicetype']; ?>"><?php echo $row1['servicetype']; ?></option>
                                                <?php
                                            }
                                        }
                                        ?>
                                    </select>
                                </div>

                        </td>
                        <td>

                                <input type="hidden" name="add_id" value="<?php echo $row['providerid']; ?>">
                                <button type="submit" name="add_btn" class="btn btn-success">ADD</button>

                        </td>
                        <td>

                                <input type="hidden" name="delete_id" value="<?php echo $row['providerid']; ?>">
                                <button type="submit" name="delete_btn" class="btn btn-danger"> DELETE</button>

                        </td>
                        </form>
                    </tr>
                    <?php
                    }
                }
                else {
                    echo '<h5 class="text-center">No Record Found</h5>';
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