<?php
session_start();
$server = "localhost";
$username = "root";
$password = "";
$database = "servicelagbe";

$conn = mysqli_connect($server, $username, $password, $database);
if (!$conn){
    die("Error". mysqli_connect_error());
}

if(isset($_POST['appoint_btn']))
{
    $appointproviderid = $_POST['appointacproviderid'];
    $appointproviderusername = $_POST['appointacproviderusername'];
    $appointprovideremail = $_POST['appointacprovideremail'];
    $appointproviderphone = $_POST['appointacproviderphone'];
    $appointprovideraddress = $_POST['appointacprovideraddress'];
    $appointproviderservicetype = $_POST['appointacproviderservicetype'];
    $appointproviderservicecost = $_POST['appointacproviderservicecost'];


    $appointuserid = $_SESSION['userid'];
    
    $query = "UPDATE approvedserviceproviders SET availability=0 WHERE approvedproviderid='$appointproviderid'";
    $query1 = "INSERT INTO `userprovider` ( `userid`,`providerid`,`providerusername`,`provideremail`, `providerphone`, `provideraddress`,`servicetype`,`servicecost`) VALUES ('$appointuserid','$appointproviderid','$appointproviderusername','$appointprovideremail','$appointproviderphone','$appointprovideraddress','$appointproviderservicetype','$appointproviderservicecost')";
    
    $query_run = mysqli_query($conn, $query);
    $query_run1 = mysqli_query($conn, $query1);
    
    if($query_run1)
    {
        $_SESSION['appointprovider'] = "Service Provider Appointed successfully";
    }
    else
    {
        $_SESSION['appointprovidererror'] = "Sorry, Something went wrong";
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
                    
                <button type="submit" class="btn btn-primary">Cart</button>

                <div class="mx-2">
                <li class="nav-item dropdown">
                <a class="btn btn-success" href="#" id="navbarDropdown" role="button"
                    data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <p class="text-light my-0 mx-2">Welcome '. $_SESSION['username']. ' </p>
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
    if(isset($_SESSION['appointprovider']) && $_SESSION['appointprovider']!=''){
        echo ' <div class="alert alert-warning alert-dismissible fade show" role="alert">
            <strong>Success!</strong> '.$_SESSION['appointprovider'].'
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div> ';

        unset($_SESSION['appointprovider']);
    }
    else if(isset($_SESSION['appointprovidererror']) && $_SESSION['appointprovidererror']!=''){
        echo ' <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <strong>Success!</strong> '.$_SESSION['appointprovidererror'].'
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div> ';
        unset($_SESSION['appointprovidererror']);
    }
    ?>

    <div class="container-fluid my-2">
        <div class="card shadow mb-4 my-2">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-info">List of Ac Service provoders</h6>
            </div>
            <div class="card-body">
                <div class="table-responsive">

                    <?php
                    $server = "localhost";
                    $username = "root";
                    $password = "";
                    $database = "servicelagbe";
                    
                    $conn = mysqli_connect($server, $username, $password, $database);
                    if (!$conn){
                        die("Error". mysqli_connect_error());
                    }
                    $sql = "select * from approvedserviceproviders natural join services where servicetype='Ac Service' and availability=1 order by address asc";
                    $query_run =  mysqli_query($conn, $sql);
                    ?>

                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th> ProviderId </th>
                                <th> Username </th>
                                <th>Email </th>
                                <th>Phone</th>
                                <th>Address</th>
                                <th>Service Type</th>
                                <th>Service Cost</th>
                                <th>Appoint</th>
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
                                <td><?php  echo $row['approvedproviderid']; ?></td>
                                <td><?php  echo $row['username']; ?></td>
                                <td><?php  echo $row['email']; ?></td>
                                <td><?php  echo $row['phone']; ?></td>
                                <td><?php  echo $row['address']; ?></td>
                                <td><?php  echo $row['servicetype']; ?></td>
                                <td><?php  echo $row['servicecost']; ?></td>
                                <td>
                                    <form action="acservice.php" method="post">
                                        <input type="hidden" name="appointacproviderid"
                                            value="<?php echo $row['approvedproviderid']; ?>">
                                        <input type="hidden" name="appointacproviderusername"
                                            value="<?php echo $row['username']; ?>">
                                        <input type="hidden" name="appointacprovideremail"
                                            value="<?php echo $row['email']; ?>">
                                        <input type="hidden" name="appointacproviderphone"
                                            value="<?php echo $row['phone']; ?>">
                                        <input type="hidden" name="appointacprovideraddress"
                                            value="<?php echo $row['address']; ?>">
                                        <input type="hidden" name="appointacproviderservicetype"
                                            value="<?php echo $row['servicetype']; ?>">
                                        <input type="hidden" name="appointacproviderservicecost"
                                            value="<?php echo $row['servicecost']; ?>">

                                        <button type="submit" name="appoint_btn" class="btn btn-success">
                                            Appoint</button>
                                    </form>
                                </td>
                            </tr>
                            <?php
                        } 
                    }
                    else {
                        echo "No Record Found";
                    }
                    ?>
                        </tbody>
                    </table>

                </div>
            </div>
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