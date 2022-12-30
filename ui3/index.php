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
<!--                    <li class="nav-item" role="presentation"><a class="nav-link" href="#"></a></li>-->
                </ul>
<!--                <form class="form-inline mr-auto" target="_self">-->
<!--                    <div class="form-group">-->
<!--                        <a onclick="myFunction()" class="btn btn-light action-button dropbtn" role="button" href="#">Search&nbsp;</a>-->
<!---->
<!--                        <div id="myDropdown" class="dropdown-content">-->
<!--                            <div class="form-group"><label for="search-field"></label><input class="border-secondary form-control search-field" type="text" id="myInput" name="search" onkeyup="filterFunction()"></div>-->
<!--                            <a href="#about">About</a>-->
<!--                            <a href="#base">Base</a>-->
<!--                            <a href="#blog">Blog</a>-->
<!--                            <a href="#contact">Contact</a>-->
<!--                            <a href="#custom">Custom</a>-->
<!--                            <a href="#support">Support</a>-->
<!--                            <a href="#tools">Tools</a>-->
<!--                        </div>-->
<!--                    </div>-->
<!--                </form>-->


            </div>
                <span class="actions">
                    <a class="btn btn-light action-button" role="button" href="./Login%20Options.php">Log In</a>

                    <a class="btn btn-light action-button" role="button" href="./Signup%20Options.php">Sign Up</a>
                </span>
        </div>
    </nav>
<!--    <div id="navcol-1" class="collapse navbar-collapse">-->
<!--    <div class="row">-->
<!--        <div class="text-center">-->
<!--    <div class="dropdown btn-group" style="text-align: center">-->
<!--        <button onclick="myFunction()" class="dropbtn">Search for Services</button>-->
<!--        <div id="myDropdown" class="dropdown-content">-->
<!--            <input type="text" placeholder="Search.." id="myInput" onkeyup="filterFunction()">-->
<!--            <a href="#about">About</a>-->
<!--            <a href="#base">Base</a>-->
<!--            <a href="#blog">Blog</a>-->
<!--            <a href="#contact">Contact</a>-->
<!--            <a href="#custom">Custom</a>-->
<!--            <a href="#support">Support</a>-->
<!--            <a href="#tools">Tools</a>-->
<!--        </div>-->
<!--    </div>-->
<!--        </div>-->
<!--    </div>-->
    <h1>  </h1>
    <div class="row">
        <div class="col-md-12 school-options-dropdown text-center">
            <div class="dropdown btn-group" style="">

                <button onclick="myFunction()" class="dropbtn" style="width: 250px; background-color: #56c6c6">Search for Services</button>


                <div id="myDropdown" class="dropdown-content">
                    <input style="width: 250px" type="text" placeholder="Search.." id="myInput" onkeyup="filterFunction()">
                    <div class="visible" id="muaz">
                    <?php
                        include 'partials/_dbconnect.php';
                        $sql = "Select * from services";
                        $result = mysqli_query($conn, $sql);
                        if(mysqli_num_rows($result) > 0) {
                            while ($row = mysqli_fetch_assoc($result)) {
                                ?>
                                <a href = "#" class="text-center"><?php echo $row['servicetype'] ?> BDT <?php echo $row['servicecost'] ?></a >
                            <?php
                            }
                        }
                    ?>
                    </div>
                </div>

            </div>
        </div>
    </div>

<!--    </div>-->
    <div class="article-clean">
        <div class="container">
            <div class="row">
                <div class="col-lg-10 col-xl-8 offset-lg-1 offset-xl-2">
                    <div class="intro">
                        <h1 class="text-center">Get any service from the comfort of your home and office.<br></h1>
                        <img class="img-fluid" src="assets/img/ac%20service.png"></div>
                    <div class="text">
                        <p>Our workers are always at your hands to help you out of the problem.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>


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