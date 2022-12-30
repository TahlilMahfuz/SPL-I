<?php
session_start();
$server = "localhost";
$username = "root";
$password = "test123";
$database = "servicelagbe";

$conn = mysqli_connect($server, $username, $password, $database);
if (!$conn){
    die("Error". mysqli_connect_error());
}

//Send email implementation

require '../includes/PHPMailer.php';
require '../includes/SMTP.php';
require '../includes/Exception.php';


use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

function send_password_reset($recipient,$subject,$message)
{
    $mail = new PHPMailer();
    //Server settings
    $mail->isSMTP();
    $mail->SMTPAuth = true;                                            //Send using SMTP
    $mail->Host       = 'smtp.gmail.com';                     //Set the SMTP server to send through
    $mail->SMTPAuth   = true;                                   //Enable SMTP authentication
    $mail->Username   = 'servicelagbe@gmail.com';                     //SMTP username
    $mail->Password   = 'fxjraufpgwdtmfzq';                               //SMTP password
    $mail->SMTPSecure = 'tls';            //Enable implicit TLS encryption
    $mail->Port       = 587;                                    //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`
    $mail->addAddress($recipient, "recipient-name");     //Add a recipient

    //Recipients
    $mail->setFrom('servicelagbe@gmail.com', 'ServiceLagbe');

    // $mail->addAddress('ellen@example.com');               //Name is optional
    // $mail->addReplyTo('info@example.com', 'Information');
    // $mail->addCC('cc@example.com');
    // $mail->addBCC('bcc@example.com');

    //Attachments
    // $mail->addAttachment('/var/tmp/file.tar.gz');         //Add attachments
    // $mail->addAttachment('/tmp/image.jpg', 'new.jpg');    //Optional name

    //Content
    $mail->isHTML(true);                                  //Set email format to HTML
    $mail->Subject = $subject;
    $content = $message;
    $mail->msgHTML($content);
    $mail->Body    = $message;
    $mail->AltBody = 'Please let this message go through...non-html client';

    if(!$mail->send()){
        echo"Error while sending Email. ";
        var_dump($mail);
    }
}




if(isset($_POST['arrived-btn'])){
    $_SESSION['notarrived']="true";
    $acceptedemail=$_SESSION["email"];
    $providerid=$_SESSION['providerid'];
    $token=rand()%1000000;


    $server = "localhost";
    $username = "root";
    $password = "test123";
    $database = "servicelagbe";

    $conn = mysqli_connect($server, $username, $password, $database);
    if (!$conn){
        die("Error". mysqli_connect_error());
    }
    $ordernumber=$_SESSION['order'];
    $sqlorder="select * from userprovider where orderid='$ordernumber'";
    $query_run5 =  mysqli_query($conn, $sqlorder);
    if(mysqli_num_rows($query_run5) > 0)
    {
        while($row = mysqli_fetch_assoc($query_run5))
        {
            $usermail=$row['useremail'];
            $providermail=$row['provideremail'];
        }
    }
    send_password_reset($usermail,"Service Provider Varification code",$token);
    send_password_reset($providermail,"Service Provider Varification code",$token);

    // $sendtothisemail="servicelagbe@gmail.com";
    // send_password_reset($sendtothisemail,"Service Provider Varification code",$token);
    // send_password_reset($sendtothisemail,"Service Provider Varification code",$token);
    $_SESSION['muazmarakha'] = "<strong>Email sent successfully.</strong> Please provide the token to client and assure your identity.";


}


if(isset($_POST["done-btn"])){
    $proid=$_SESSION['providerid'];
    $order=$_SESSION["order"];
    $sqlupdate = "UPDATE userprovider SET appointstatus=1 WHERE orderid='$order'";
    $sqlupdate2 = "UPDATE approvedserviceproviders SET availability=1 WHERE approvedproviderid='$proid'";
    // $servicecountvariable=$_SESSION['servicecount'];
    // $servicecountvariable++;
    // $updateservicecount = "UPDATE approvedserviceproviders SET servicecount='$servicecountvariable' WHERE email='$provideremail'";
    $query_run_update =  mysqli_query($conn, $sqlupdate);
    $query_run_update2 =  mysqli_query($conn, $sqlupdate2);
    // $query_run_update1 =  mysqli_query($conn, $updateservicecount);

    if($query_run_update && $query_run_update2){
        //send email implemention required
        //implement user payment portion
        //as user logs in session will automatically tell him to pay. As he presses done review system arrives.
        //then everything becomes normal.
        header("location:Provider_Paid.php");
    }
    else{
        echo '<h5 class="text-center">Something went wrong.</h5>';
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
            </div><span class="actions"> <a class="btn btn-light action-button" role="button" href="./Post%20Provider%20Login.php">Welcome <?php echo $_SESSION['username'] ?></a>  <a class="btn btn-light action-button" role="button" href="./Logout.php">Logout</a></span></div>
    </nav>
    <?php
    if(isset($_SESSION['muazmarakha'])){
        echo '<h5 class="text-center">'.$_SESSION['muazmarakha'].'</h5>';
    }
    ?>
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


        $appointedproviderid = $_SESSION['providerid'];
        $sql = "Select * from userprovider where providerid='$appointedproviderid' and appointstatus=0";
        $query_run =  mysqli_query($conn, $sql);
        ?>
        <table class="table">
            <thead>
                <tr>
                    <th>OrderID</th>
                    <th>ProviderID</th>
                    <th>Provider Username</th>
                    <th>User Email</th>
                    <th>User Phone</th>
                    <th>User Detailed Location</th>
                    <th>User Location</th>
                    <th>Service Type</th>
                    <th>Service Cost</th>
                    <th>Status</th>
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
                        <td><?php  echo $row['orderid'];$_SESSION['order']=$row['orderid'] ?></td>
                        <td><?php  echo $row['providerid']; ?></td>
                        <td><?php  echo $row['providerusername']; ?></td>
                        <td><?php  echo $row['useremail']; $_SESSION['useremail']=$row['useremail'];?></td>
                        <td><?php  echo $row['userphone']; ?></td>
                        <td><?php  echo $row['detailedlocation']; ?></td>
                        <td><?php  echo $row['userlocation']; ?></td>
                        <td><?php  echo $row['servicetype']; ?></td>
                        <td><?php  echo $row['servicecost'];$_SESSION['providerpayment']=$row['servicecost'];?></td>
                        <?php
                        if(!isset($_SESSION['notarrived'])){
                        ?>
                        <td>

                            <form action="./Post%20Provider%20Login.php" method="post">
                                <input type="hidden" name="arrived-btn" value="<?php echo $row['orderid']; ?>">
                                <button type="submit" name="arrived-btn"
                                        class="btn btn-warning">Arrived</button>
                            </form>
                        </td>
                        <?php
                        }
                        else{
                        ?>
                        <td>
                            <form action="./Post%20Provider%20Login.php" method="post">
                                <input type="hidden" name="done-btn" value="<?php echo $row['orderid']; ?>">
                                <button type="submit" name="done-btn" class="btn btn-success">Done</button>
                            </form>
                        </td>
                        <?php
                        }
                        ?>
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
                <li class="list-inline-item"><a href="#">Terms</a></li>
                <li class="list-inline-item"><a href="#">Privacy Policy</a></li>
            </ul>
            <p class="copyright">ServiceLagbe © 2022</p>
        </footer>
    </div>
    <script src="assets/js/jquery.min.js"></script>
    <script src="assets/bootstrap/js/bootstrap.min.js"></script>
</body>

</html>