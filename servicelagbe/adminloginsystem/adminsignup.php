<?php
$showAlert = false;
$showError = false;
if($_SERVER["REQUEST_METHOD"] == "POST"){
    include 'partials/_admindbconnect.php';
    $adminusername = $_POST["adminusername"];
    $adminemail = $_POST["adminemail"];
    $adminphone = $_POST["adminphone"];
    $adminaddress = $_POST["adminaddress"];
    $adminpassword = $_POST["adminpassword"];
    $admincpassword = $_POST["admincpassword"];
    $adminsignupmasterkey = $_POST["adminsignupmasterkey"];
    // $exists=false;

    $exists=false;
    if($adminsignupmasterkey=='1234'){
        // Check whether this username exists
        $existSql = "SELECT * FROM `admins` WHERE email = '$adminemail'";
        $result = mysqli_query($conn, $existSql);
        $numExistRows = mysqli_num_rows($result);
        if($numExistRows > 0){
            // $exists = true;
            $showError = "An account already exists against this email";
        }
        else{
            // $exists = false; 
            if(($adminpassword == $admincpassword)){
                $hash = password_hash($adminpassword, PASSWORD_DEFAULT);
                $sql = "INSERT INTO `admins` ( `username`,`email`,`phone`,`address`, `password`, `dt`) VALUES ('$adminusername','$adminemail','$adminphone', '$adminaddress','$hash', current_timestamp())";
                $result = mysqli_query($conn, $sql);
                if ($result){
                    $showAlert = true;
                }
            }
            else{
                $showError = "Passwords do not match";
            }
        }
    }
    else {
        $showError = "Invalid Masterkey";
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
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css"
        integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">

    <title>SignUp</title>
</head>

<body>
    <?php require 'partials/_adminnav.php' ?>
    <?php
    if($showAlert){
    echo ' <div class="alert alert-success alert-dismissible fade show" role="alert">
        <strong>Success!</strong> Your account is now created and you can login
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div> ';
    }
    if($showError){
    echo ' <div class="alert alert-danger alert-dismissible fade show" role="alert">
        <strong>Error!</strong> '. $showError.'
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div> ';
    }
    ?>

    <div class="container my-4">
        <h1 class="text-center">Signup to ServiceLagbe as Administrator</h1>
        <form action="/servicelagbe/adminloginsystem/adminsignup.php" method="post">
            <div class="form-group">
                <label for="adminsignupmasterkey">Master Key</label>
                <input type="password" maxlength="23" class="form-control" id="adminsignupmasterkey"
                    name="adminsignupmasterkey" placeholder="Enter the master key provided by the authority" required>
            </div>
            <div class="form-group">
                <label for="adminusername">Username</label>
                <input type="text" maxlength="20" class="form-control" id="adminusername" name="adminusername"
                    aria-describedby="emailHelp" placeholder="Not email" required>
            </div>
            <div class="form-group">
                <label for="adminemail">Email</label>
                <input type="email" maxlength="50" class="form-control" id="adminemail" name="adminemail"
                    aria-describedby="emailHelp" required>
            </div>

            <div class="form-group">
                <label for="adminphone">phone</label>
                <input type="tel" class="form-control" id="adminphone" name="adminphone" maxlength="11"
                    pattern="[0-9]{11}" placeholder="01XXXXXXXXX(Use only digits)" required>
            </div>

            <div class="form-group">
                <label for="adminaddress">Address</label>
                <input type="text" class="form-control" id="adminaddress" name="adminaddress"
                    aria-describedby="emailHelp" required>
            </div>

            <div class="form-group">
                <label for="adminpassword">Password</label>
                <input type="password" maxlength="23" class="form-control" id="adminpassword" name="adminpassword"
                    required>
            </div>
            <div class="form-group">
                <label for="admincpassword">Confirm Password</label>
                <input type="password" maxlength="23" class="form-control" id="admincpassword" name="admincpassword"
                    required>
                <small id="emailHelp" class="form-text text-muted">Make sure to type the same password</small>
            </div>

            <button type="submit" class="btn btn-primary">SignUp</button><br><br>
            <a href="/servicelagbe/serviceproviders/providersignup.php" class="btn btn-info">Click here to signup as
                ServiceProvider</a>
            <a href="/servicelagbe/loginsystem/signup.php" class="btn btn-info">Click here to signup as Client</a>
        </form>
    </div>

    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js"
        integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"
        integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous">
    </script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"
        integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous">
    </script>
</body>

</html>