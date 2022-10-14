<?php
include 'partials/_admindbconnect.php';

if(isset($_POST['delete_btn']))
{
    $id = $_POST['delete_id'];
    
    $query = "DELETE FROM serviceproviders WHERE providerid='$id' ";
    $query_run = mysqli_query($conn, $query);
    
    if($query_run)
    {
        session_start();
        $_SESSION['deletedprovider'] = "Service Provider Removed";
        header('Location: postadminlogin.php'); 
    }
    else
    {
        $_SESSION['deletedprovidererror'] = "Sorry, Deletion could be processed. Something went wrong";
        header('Location: postadminlogin.php'); 
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
    session_start();
    echo'
    <nav class="navbar sticky-top navbar-expand-lg navbar-dark bg-dark">
            <a class="navbar-brand" href="#">ServiceLagbe?</a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
                aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav mr-auto">
                <li>
                    <a class="btn btn-primary" href="#" id="navbarDropdown" role="button"
                    data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" href="/servicelagbe/adminloginsystem/postadminlogin.php">
                        Service provider request
                    </a>
                </li>
                </ul>
                <form class="form-inline my-2 my-lg-0">
                    <input class="form-control mr-sm-2" type="search" placeholder="Search" aria-label="Search">
                    <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Search</button>
                </form>
                <div class="mx-2">
                <li class="nav-item dropdown">
                <a class="btn btn-success" href="#" id="navbarDropdown" role="button"
                    data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <p class="text-light my-0 mx-2">Welcome Administrator '. $_SESSION['username']. ' </p>
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
    if(isset($_SESSION['deletedprovider']) && $_SESSION['deletedprovider']!=''){
        echo ' <div class="alert alert-success alert-dismissible fade show" role="alert">
            <strong>Success!</strong> Service Provider Removed
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div> ';
    }
    if(isset($_SESSION['deletedprovidererror']) && $_SESSION['deletedprovidererror']!=''){
        echo ' <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <strong>Error!</strong> '.$_SESSION['deletedprovidererror'].'
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div> ';
    }
    ?>

    <div class="container-fluid my-2">

        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-info">Admin Profile</h6>
            </div>
            <div class="card-body">
                <div class="table-responsive">

                    <?php
                    include 'partials/_admindbconnect.php';
                    $sql = "Select * from serviceproviders";
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
                                <th>Edit</th>
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
                                <td>
                                    <div class="input-group mb-3">
                                        <select class="custom-select" id="servicetype" required>
                                            <option selected>Choose...</option>
                                            <option value="1">Ac Service</option>
                                            <option value="2">Electrical Service</option>
                                            <option value="3">Car Care Service</option>
                                            <option value="4">Emergency Service</option>
                                        </select>
                                    </div>
                                </td>
                                <td>
                                    <form action="postadminlogin.php" method="post">
                                        <input type="hidden" name="addprovider" value="<?php echo $row['providerid']; ?>">
                                        <button type="submit" class="btn btn-success">ADD</button>
                                    </form>
                                </td>
                                <td>
                                    <form action="postadminlogin.php" method="post">
                                    <input type="hidden" name="delete_id" value="<?php echo $row['providerid']; ?>">
                                        <button type="submit" name="delete_btn" class="btn btn-danger"> DELETE</button>
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