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

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

require 'inlcudes/PHPMailer.php';
require 'inlcudes/Exception.php';
require 'inlcudes/SMTP.php';

function send_password_reset($username,$forgotemail,$token){
    $mail = new PHPMailer(true);
    $mail->isSMTP(); 
    $mail->SMTPAuth   = true;

    $mail->Host       = 'smtp.gmail.com';                                                  
    $mail->Username   = 'servicelagbe@gmail.com';        //Create an account             
    $mail->Password   = '@tmsServiceLagbe123';                               
    $mail->SMTPSecure ="tls";                               
    $mail->Port       =587;                                                             
    $mail->setFrom('servicelagbe@gmail.com');
    $mail->addAddress($forgotemail);
    
    $mail->isHTML(true);                                  
    $mail->Subject = 'Varify account for forgot password';

    $emailtemplate="
    <h2>Hello '$username',</h2><br>
    <h3>You are receiving this email form servicelagbe because we receieved a password reset request for your account</h3>
    <br><br>
    <h3>Your varification code is '$token'</h3>";

    $mail->Body=$emailtemplate;
    $mail->send();
}

if(isset($_POST['forgotemail'])){
    

    $token=md5(rand());
    $forgotemail=$_POST['forgotemail'];

    $sql = "SELECT * from users WHERE email='$forgotemail'";
    $query_run =  mysqli_query($conn, $sql);
    if($query_run){
        $sql1 = "UPDATE users SET token='$token' WHERE email='$forgotemail'";
        $query_run1 =  mysqli_query($conn, $sql1);
        if($query_run1){
            $row=mysqli_fetch_array($query_run);
            $username=$row['username'];    
            send_password_reset($username,$forgotemail,$token);   
            header("location: /servicelagbe/loginsystem/varify.php");
        }
        else{
            echo ' <div class="alert alert-warning alert-dismissible fade show" role="alert">
        <strong>Warning!</strong> Something went wrong!
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
        </div> ';    
        }
    }
    else{
        echo ' <div class="alert alert-warning alert-dismissible fade show" role="alert">
        <strong>Warning!</strong> Email does not exist. You can sign up with this email.
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
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css"
        integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">

    <title>Login</title>
</head>

<body>
    <?php require 'partials/_nav.php' ?>
    
    <div class="container my-4">
        <h1 class="text-center">Forgot password</h1>

        <form action="/servicelagbe/loginsystem/userforgotpassword.php" method="post">
            <div class="form-group">
                <label for="forgotemail">Email</label>
                <input type="email" class="form-control" id="forgotemail" name="forgotemail" aria-describedby="emailHelp" required>

            </div>
            <button type="submit" class="btn btn-primary">Submit</button><br><br><br>
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