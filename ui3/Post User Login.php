<?php
    session_start();
?>

<!DOCTYPE html>
<html>

<head>
    <style>
        .dropbtn {
            background-color: #04AA6D;
            color: white;
            padding: 16px;
            font-size: 16px;
            border: none;
            cursor: pointer;
        }

        .dropbtn:hover, .dropbtn:focus {
            background-color: #3e8e41;
        }

        #myInput {
            box-sizing: border-box;
            background-image: url('searchicon.png');
            background-position: 14px 12px;
            background-repeat: no-repeat;
            font-size: 16px;
            padding: 14px 20px 12px 45px;
            border: none;
            border-bottom: 1px solid #ddd;
        }

        #myInput:focus {outline: 3px solid #ddd;}

        .dropdown {
            position: relative;
            display: inline-block;
        }

        .dropdown-content {
            display: none;
            position: absolute;
            background-color: #f6f6f6;
            min-width: 230px;
            overflow: auto;
            border: 1px solid #ddd;
            z-index: 1;
        }

        .dropdown-content a {
            color: black;
            padding: 12px 16px;
            text-decoration: none;
            display: block;
        }

        .dropdown a:hover {background-color: #ddd;}

        .show {display: block;}
    </style>
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
    <?php
    $server = "localhost";
    $username = "root";
    $password = "test123";
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
        header("location:User_Rating.php");
    }
    ?>
    <?php
    $server = "localhost";
    $username = "root";
    $password = "test123";
    $database = "servicelagbe";

    $conn = mysqli_connect($server, $username, $password, $database);
    if (!$conn){
        die("Error". mysqli_connect_error());
    }
    $sql = "select * from services order by servicetype asc";
    $query_run =  mysqli_query($conn, $sql);
    ?>
    <nav class="navbar navbar-light navbar-expand-md navigation-clean-search" style="background-color: rgb(237,237,237);">
        <div class="container"><a class="navbar-brand" href="./index.php">ServiceLagbe</a><button data-toggle="collapse" class="navbar-toggler" data-target="#navcol-1"><span class="sr-only">Toggle navigation</span><span class="navbar-toggler-icon"></span></button>
            <div class="collapse navbar-collapse"
                id="navcol-1">
                <ul class="nav navbar-nav">
                    <li class="nav-item" role="presentation"><a class="nav-link" href="./About.php">About</a></li>
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
                <a class="btn btn-light action-button" role="button" href="./Post%20User%20Login.php">Welcome <?php echo $_SESSION['username']?></a>
                <a class="btn btn-light action-button" role="button" href="./Logout.php">Logout</a>
            </span>
        </div>
    </nav>

<!--    <div class="row">-->
<!--        <div class="col-md-12 school-options-dropdown text-center">-->
<!--            <div class="dropdown btn-group" style="">-->
<!---->
<!--                <button onclick="myFunction()" class="dropbtn" style="width: 250px; background-color: #56c6c6">Search for Services</button>-->
<!---->
<!---->
<!--                <div id="myDropdown" class="dropdown-content">-->
<!--                    <input style="width: 250px" type="text" placeholder="Search.." id="myInput" onkeyup="filterFunction()">-->
<!--                    <div class="visible" id="muaz">-->
<!--                        --><?php
//                        include 'partials/_dbconnect.php';
//                        $sql = "Select * from services";
//                        $result = mysqli_query($conn, $sql);
//                        if(mysqli_num_rows($result) > 0) {
//                            while ($row = mysqli_fetch_assoc($result)) {
//                                ?>
<!--                                <a href = "#" class="text-center">--><?php //echo $row['servicetype'] ?><!-- BDT --><?php //echo $row['servicecost'] ?><!--</a >-->
<!--                                --><?php
//                            }
//                        }
//                        ?>
<!--                    </div>-->
<!--                </div>-->
<!---->
<!--            </div>-->
<!--        </div>-->
<!--    </div>-->


    <nav class="navbar navbar-light navbar-expand-md navigation-clean-button">
        <div class="container"><button data-toggle="collapse" class="navbar-toggler" data-target="#navcol-1"><span class="sr-only">Toggle navigation</span><span class="navbar-toggler-icon"></span></button>
            <div class="collapse navbar-collapse" id="navcol-1"><span class="navbar-text actions"> <a class="btn btn-light action-button" role="button" href="./User_Appoint.php">Appoint</a></span></div>
        </div>
    </nav>
    <nav class="navbar navbar-light navbar-expand-md navigation-clean-button">
        <div class="container"><button data-toggle="collapse" class="navbar-toggler" data-target="#navcol-1"><span class="sr-only">Toggle navigation</span><span class="navbar-toggler-icon"></span></button>
            <div class="collapse navbar-collapse" id="navcol-1"><span class="navbar-text actions"> <a class="btn btn-light action-button" role="button" href="./User_Appointed%20Services.php">Appointed Services</a></span></div>
        </div>
    </nav>


    <script>
        /* When the user clicks on the button,
        toggle between hiding and showing the dropdown content */
        function myFunction() {
            document.getElementById("myDropdown").classList.toggle("show");
        }

        function filterFunction() {
            var input, filter, ul, li, a, i;
            input = document.getElementById("myInput");
            filter = input.value.toUpperCase();
            div = document.getElementById("myDropdown");
            a = div.getElementsByTagName("a");
            for (i = 0; i < a.length; i++) {
                txtValue = a[i].textContent || a[i].innerText;
                if (txtValue.toUpperCase().indexOf(filter) > -1) {
                    a[i].style.display = "";
                } else {
                    a[i].style.display = "none";
                }
            }
        }
    </script>
    <script src="assets/js/jquery.min.js"></script>
    <script src="assets/bootstrap/js/bootstrap.min.js"></script>





    <div class="row">
    <?php
    if(mysqli_num_rows($query_run) > 0)
    {

        while($row = mysqli_fetch_assoc($query_run))
        {
            $rn = rand(1, 5);
        ?>
        <div class="col-md-4">

            <div class="card my-4" style="padding: 40px; border: none">
                <img class="card-img-top w-100 d-block" src="<?php echo "$rn".".jpg" ?>">
                <div class="card-body">
                    <h4 class="card-title text-center"><?php echo $row['servicetype'] ?></h4>
                    <p class="card-text text-center"><?php echo $row['servicecost'] ?></p>
<!--                    <button class="btn btn-primary" type="button" style="background-color: #56c6c6; border: none">Appoint</button>-->
                </div>
            </div>


        </div>
            <?php
        }
    }
    else {
        echo '<h5 class="text-center">No record found.</h5>';
    }
    ?>
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