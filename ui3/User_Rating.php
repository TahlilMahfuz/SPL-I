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

if ($_SERVER["REQUEST_METHOD"] == "POST")
{
    $newrating = $_POST["rating"];

    $providerid= $_SESSION['providerid'];
    $sqlfetch = "select * from approvedserviceproviders where approvedproviderid=$providerid";
    $queryfetch=mysqli_query($conn, $sqlfetch);
    while($row = mysqli_fetch_assoc($queryfetch))
    {
        $rating=$row['rating'];
    }

    $rating=((int)$rating+(int)$newrating)/2;
    $sqlupdaterating = "UPDATE approvedserviceproviders SET rating='$rating' WHERE approvedproviderid='$providerid'";
    $sqlupdaterating1 = "UPDATE userprovider SET appointstatus=2 WHERE providerid='$providerid'";
    $queryupdaterating=mysqli_query($conn, $sqlupdaterating);
    $queryupdaterating1=mysqli_query($conn, $sqlupdaterating1);
    if ($queryupdaterating && $queryupdaterating1)
    {
        header("location:Post User Login.php",true,301);
    }
    else
    {
        $_SESSION['etamuazerkam'] = "Something went wrong";

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
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.0/css/bootstrap.min.css"
          integrity="sha384-SI27wrMjH3ZZ89r4o+fGIJtnzkAnFs3E4qz9DIYioCQ5l9Rd/7UAa8DHcaL8jkWt" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/rateYo/2.3.2/jquery.rateyo.min.css">
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.4.1/dist/css/bootstrap.min.css"
          integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
</head>

<body>
    <nav class="navbar navbar-light navbar-expand-md navigation-clean-search" style="background-color: rgb(237,237,237); height: 70px">
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
            </div><span class="actions"> <a class="btn btn-light action-button" role="button" href="./Post%20User%20Login.php">Welcome <?php echo $_SESSION['username'] ?></a>
                 <a class="btn btn-light action-button" role="button" href="./Login%20Options.php">Logout</a></span></div>
    </nav>
    <?php
    if(isset($_SESSION['etamuazerkam']))
    echo '<h5 class="text-center">'.$_SESSION['etamuazerkam'].'</h5>';
    ?>
    <div class="jumbotron jumbotron-fluid" style="background-color: #ffffff">
        <div class="container">
            <div class="row">

                <form action="./User_Rating.php" method="post">

                    <div>
                        <h6>Thank you for engaging with the services of service lagbe. Please provide your valuable rating our service provider <?php echo "<h2>" . $_SESSION['providername'] . "</h2>";?>
                        </h6><br>
                    </div>

                    <div class="rateyo" id="rating" data-rateyo-rating="4" data-rateyo-num-stars="5" data-rateyo-score="3">
                    </div>

                    <span class='result'>0</span>
                    <br>
                    <input type="hidden" name="rating">

                </div>
                <br>
                <div class="form-group">
                    <button style="background-color: #56c6c6; color: #ffffff;" type="submit" class="btn btn-light action-button">Submit</button>
                </div>
                </form>
        </div>
    </div>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/rateYo/2.3.2/jquery.rateyo.min.js"></script>

    <script>
        $(function() {
            $(".rateyo").rateYo().on("rateyo.change", function(e, data) {
                var rating = data.rating;
                $(this).parent().find('.score').text('score :' + $(this).attr('data-rateyo-score'));
                $(this).parent().find('.result').text('rating :' + rating);
                $(this).parent().find('input[name=rating]').val(rating); //add rating value to input field
            });
        });
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.4.1/dist/js/bootstrap.min.js"
            integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous">
    </script>
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
</body>

</html>