<?php
session_start();
include 'partials/_dbconnect.php';

if(isset($_POST['delete_btn']))
{
    $id = $_POST['delete_id'];

    $query = "DELETE FROM users WHERE id='$id' ";
    $query_run = mysqli_query($conn, $query);

    if($query_run)
    {
        $_SESSION['deleteduser'] = "User Removed";
    }
    else
    {
        $_SESSION['deletedusererror'] = "Sorry, Deletion could be processed. Something went wrong";
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
    <nav class="navbar navbar-light navbar-expand-md navigation-clean-search" style="background-color: rgb(237,237,237);"">
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
    <h3><br>User List<br><br></h3>
    <?php
    if(isset($_SESSION['deleteduser']) && $_SESSION['deleteduser']!=''){
        echo '<h5 class="text-center">Service Provider Removed</h5>';
        unset($_SESSION['deleteduser']);
    }
    if(isset($_SESSION['deleteduserror']) && $_SESSION['deletedusererror']!=''){
        echo '<h5 class="text-center">'.$_SESSION['deletedusererror'].'</h5>';
        unset($_SESSION['deletedusererror']);
    }
    ?>
    <?php
        $sql = "Select * from users";
        $query_run =  mysqli_query($conn, $sql);
    ?>
    <div class="table-responsive">
        <table class="table">
            <thead>
                <tr>
                    <th>UserID</th>
                    <th>Username</th>
                    <th>Email</th>
                    <th>Phone</th>
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
                        <td><?php  echo $row['id']; ?></td>
                        <td><?php  echo $row['username']; ?></td>
                        <td><?php  echo $row['email']; ?></td>
                        <td><?php  echo $row['phone']; ?></td>
                        <td>
                            <form action="./Admin_User%20List.php" method="post">
                                <input type="hidden" name="delete_id" value="<?php echo $row['id']; ?>">
                                <button type="submit" name="delete_btn" class="btn btn-danger"> DELETE</button>
                            </form>
                        </td>

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