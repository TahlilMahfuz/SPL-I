<?php
session_start();
if(isset($_POST['appointuserservicetype']))
{
    $server = "localhost";
    $username = "root";
    $password = "";
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
        }
        $sql1 = "INSERT INTO `userprovider` (`useremail`,`userid`,`userlocation`,`providerid`,`userphone`,`providerusername`, `provideremail`,`providerphone`,`provideraddress`,`servicetype`,`servicecost`, `dt`) 
                VALUES ('$useremail','$userid','$userlocation','$providerid','$userphone','$providerusername', '$provideremail','$providerphone','$provideraddress','$type','$cost', current_timestamp())";
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
        echo ' <div class="alert alert-warning alert-dismissible fade show" role="alert">
        <strong>Warning!</strong> Sorry, could not find any service provider for your area
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
        </div> ';
    }
}
?>
<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.4.1/dist/css/bootstrap.min.css"
        integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">

    <title>ServiceLagbe? - Service Provider</title>
</head>

<body>
    <?php
        $server = "localhost";
        $username = "root";
        $password = "";
        $database = "servicelagbe";
        
        $conn = mysqli_connect($server, $username, $password, $database);
        if (!$conn){
            die("Error". mysqli_connect_error());
        }
        $checkuserid=$_SESSION['userid'];
        $sqlcheck = "select * from userprovider where appointstatus=1 and userid='$checkuserid'";
        $query_check =  mysqli_query($conn, $sqlcheck);
        if(mysqli_num_rows($query_check) > 0){
            while($row = mysqli_fetch_assoc($query_check))
            {
                $_SESSION['providername']=$row['providerusername'];
                $_SESSION['providerid']=$row['providerid'];
            }
            header("location:addratetoprovider.php");
        }
    ?>

    <?php
    echo'
    <nav class="navbar sticky-top navbar-expand-lg navbar-dark bg-dark">
            <a class="navbar-brand" href="/servicelagbe/index.php">ServiceLagbe?</a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
                aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav mr-auto">
                    <li class="nav-item active">
                        <a class="nav-link" href="/servicelagbe/index.php">Home <span class="sr-only">(current)</span></a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">About</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">Contact</a>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button"
                            data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            Services
                        </a>
                        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                            <a class="dropdown-item" href="#">Action</a>
                            <a class="dropdown-item" href="#">Another action</a>
                            <div class="dropdown-divider"></div>
                            <a class="dropdown-item" href="#">Something else here</a>
                        </div>
                    </li>
                </ul>
                <form class="form-inline my-2 my-lg-0">
                    <input class="form-control mr-sm-2" type="search" placeholder="Search" aria-label="Search">
                    <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Search</button>
                </form>

                <a href="/servicelagbe/postlogin/appointedservices.php" class="btn btn-warning mx-2">Appointed Services</a>

                <div class="mx-2">
                <li class="nav-item dropdown">
                <a class="btn btn-success" href="#" id="navbarDropdown" role="button"
                    data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <p class="text-light my-0 mx-2">Welcome '.$_SESSION['username'].' </p>
                </a>
                <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                    <a class="dropdown-item" href="#">Profile</a>
                    <div class="dropdown-divider"></div>
                    <a class="dropdown-item" href="/servicelagbe/loginsystem/logout.php">LogOut</a>
                </div>
            </li>
            </div>
        </nav>
    '
    ?>
    <?php
    if(isset($_SESSION['appointrequest']) && $_SESSION['appointrequest']!=''){
        echo ' <div class="alert alert-success alert-dismissible fade show" role="alert">
            <strong>Success!</strong> '.$_SESSION['appointrequest'].'
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div> ';
        unset($_SESSION['appointrequest']);
    }
    if(isset($_SESSION['appointrequesterror']) && $_SESSION['appointrequesterror']!=''){
        echo ' <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <strong>Error!</strong> '.$_SESSION['appointrequesterror'].'
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div> ';
        unset($_SESSION['appointrequesterror']);
    }
    ?>
    <?php
        $server = "localhost";
        $username = "root";
        $password = "";
        $database = "servicelagbe";
        
        $conn = mysqli_connect($server, $username, $password, $database);
        if (!$conn){
            die("Error". mysqli_connect_error());
        }
        $sql = "select * from services order by servicetype asc";
        $query_run =  mysqli_query($conn, $sql);
    ?>

    <div class="container">
        <div class="row">
            <?php
            if(mysqli_num_rows($query_run) > 0)        
            {
                while($row = mysqli_fetch_assoc($query_run))
                {
            ?>
            <div class="col-md-4">
                <div class="card my-4" style="width: 18rem;">
                    <img src="/servicelagbe/img/ac.jpg" class="card-img-top" alt="...">
                    <div class="card-body">
                        <h5 class="card-title"><?php  echo $row['servicetype']; ?></h5>
                        <h7 class="card-title">BDT <?php  echo $row['servicecost']; ?></h7>
                        <p class="card-text"></p>


                        <button type="button" class="btn btn-primary my-2" data-toggle="modal"
                            data-target="#exampleModal">Appoint <?php  echo $row['servicetype']; ?></button>

                        <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog"
                            aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLabel">Select your service</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        <form action="postuserlogin.php" method="post">
                                            <div class="form-group">
                                                <label for="appointuserservicetype">Service Type:</label>
                                                <div class="input-group mb-3">
                                                    <select name="appointuserservicetype" class="custom-select" id="appointuserservicetype"
                                                        required>
                                                        <option selected>Choose...</option>
                                                        <?php
                                                $sql1 = "Select * from services order by servicetype asc";
                                                $query_run1 =  mysqli_query($conn, $sql1);
                                                if(mysqli_num_rows($query_run1) > 0){        
                                                    while($row1=mysqli_fetch_assoc($query_run1))
                                                    {
                                                ?>
                                                        <option value="<?php echo $row1['servicetype']; ?>">
                                                            <?php echo $row1['servicetype']; ?></option>
                                                        <?php
                                                    }
                                                }
                                                ?>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label for="appointuserlocation">Location:</label>
                                                <input type="text" maxlength="20" class="form-control"
                                                    id="appointuserlocation" name="appointuserlocation"
                                                    aria-describedby="emailHelp">
                                            </div>
                                            <div class="modal-footer">
                                                <button type="submit" name="appointuserservice"
                                                    class="btn btn-success">Request</button>
                                                <button type="button" class="btn btn-danger"
                                                    data-dismiss="modal">Close</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
            <?php
                } 
            }
            else {
                echo "No Record Found";
            }
        ?>



        </div>
    </div>


    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js"
        integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"
        integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.4.1/dist/js/bootstrap.min.js"
        integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous">
    </script>
</body>

</html>