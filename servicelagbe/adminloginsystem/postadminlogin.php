<?php
session_start();
include 'partials/_admindbconnect.php';

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

//Mod running
// if(isset($_POST['addservicetype']))
// {
//     $addservicetype = $_POST['addservicetype'];
//     $addservicetypecost = $_POST['addservicetypecost'];
//     $query1 = "INSERT INTO `services` ( `servicetype`,`servicecost`) VALUES ('$addservicetype','$addservicetypecost')";
//     $query_run1 = mysqli_query($conn, $query1);
//     if($query_run1){
//         echo ' <div class="alert alert-successs alert-dismissible fade show" role="alert">
//         <strong>Successs!</strong> Service has been added.
//         <button type="button" class="close" data-dismiss="alert" aria-label="Close">
//             <span aria-hidden="true">&times;</span>
//         </button>
//         </div> ';
//     }
//     else{
//         echo ' <div class="alert alert-warning alert-dismissible fade show" role="alert">
//         <strong>Warning!</strong> Sorry!error while inserting service type
//         <button type="button" class="close" data-dismiss="alert" aria-label="Close">
//             <span aria-hidden="true">&times;</span>
//         </button>
//         </div> ';
//     }
    
// }


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
            <a class="navbar-brand" href="#">ServiceLagbe?</a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
                aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav mr-auto">
                
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
        echo ' <div class="alert alert-warning alert-dismissible fade show" role="alert">
            <strong>Success!</strong> '.$_SESSION['deletedprovider'].'
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div> ';
        unset($_SESSION['deletedprovider']);
    }
    if(isset($_SESSION['deletedprovidererror']) && $_SESSION['deletedprovidererror']!=''){
        echo ' <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <strong>Error!</strong> '.$_SESSION['deletedprovidererror'].'
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div> ';
        unset($_SESSION['deletedprovidererror']);
    }
    if(isset($_SESSION['approvedprovider']) && $_SESSION['approvedprovider']!=''){
        echo ' <div class="alert alert-success alert-dismissible fade show" role="alert">
            <strong>Success!</strong> '.$_SESSION['approvedprovider'].'
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div> ';
        unset($_SESSION['approvedprovider']);
    }
    if(isset($_SESSION['approvedprovidererror']) && $_SESSION['approvedprovidererror']!=''){
        echo ' <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <strong>Error!</strong> '.$_SESSION['deletedprovidererror'].'
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div> ';
        unset($_SESSION['approvedprovidererror']);
    }
    ?>

    <div class="container-fluid my-2">
        <div>
            <a href="/servicelagbe/adminloginsystem/postadminlogin.php" class="btn btn-primary">Service providers
                request</a>
            <a href="/servicelagbe/adminloginsystem/approvedserviceproviders.php" class="btn btn-primary">Approved
                Service providers</a>
            <a href="/servicelagbe/adminloginsystem/adminuserlist.php" class="btn btn-primary">Userlist</a>

        </div>
        <div class="card shadow mb-4 my-2">
            <div class="card-header py-3">
                <h7 class="m-0 font-weight-bold text-info">Admin Profile</h7>



                <!-- <a href="/servicelagbe/adminloginsystem/adminuserlist.php" class="btn btn-primary">Userlist</a> -->
                <!-- <button type="button" class="btn btn-secondary my-2" data-toggle="modal" data-target="#exampleModal"
                    data-whatever="@getbootstrap">Add new service</button>
                <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog"
                    aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel">Add a new service</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <form action="postadminlogin.php" method="post">
                                    <div class="form-group">
                                        <label for="addservicetype" class="col-form-label">Service Type:</label>
                                        <input type="text" class="form-control" id="addservicetype">
                                    </div>
                                    <div class="form-group">
                                        <label for="addservicetypecost" class="col-form-label">Service cost:</label>
                                        <input type="text" class="form-control" id="addservicetypecost">
                                    </div>
                                    <div class="form-group">
                                        <label for="masterkey" class="col-form-label">Masterkey:</label>
                                        <input type="text" class="form-control" id="masterkey">
                                    </div>
                                </form>
                            </div>
                            <div class="modal-footer">
                                <form action="postadminlogin.php" method="post">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                    <button type="submit" name="addservice" class="btn btn-primary">Add</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div> -->









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
                                <form action="postadminlogin.php" method="post">
                                    <td>
                                        <div class="input-group mb-3">
                                            <select name="servicetype" class="custom-select" id="servicetype" required>
                                                <option selected>Choose...</option>
                                                <option value="Ac Service">Ac Service</option>
                                                <option value="Electrical Service">Electrical Service</option>
                                                <option value="Car Care Service">Car Care Service</option>
                                                <option value="Emergency Service">Emergency Service</option>
                                            </select>
                                        </div>
                                    </td>
                                    <td>
                                        <input type="hidden" name="add_id" value="<?php echo $row['providerid']; ?>">
                                        <button type="submit" name="add_btn" class="btn btn-success">ADD</button>
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