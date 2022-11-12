<?php
session_start();
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

    <div class="container-fluid my-2">
        <div class="card shadow mb-4 my-2">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-info">Appointed Services</h6>
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
                    
                    
                    $userid = $_SESSION['userid'];
                    $sql = "Select * from userprovider where userid='$userid' && appointstatus=0";
                    $query_run =  mysqli_query($conn, $sql);
                    ?>

                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th> OrderId </th>
                                <th> ProviderId </th>
                                <th> Provider Username </th>
                                <th> Provider Email </th>
                                <th> Provider Phone </th>
                                <th> Service Type </th>
                                <th> Service Cost </th>
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

                                <!-- appointmentstatus -->
                                <!-- <?php
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
                                ?> -->

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