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
            echo ' <div class="alert alert-success alert-dismissible fade show" role="alert">
            <strong>Success!</strong>New rating added successfully.
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
             </div> ';
             header("location:http://localhost/servicelagbe/index.php",true,301);
        }
        else
        {
            echo ' <div class="alert alert-success alert-dismissible fade show" role="alert">
            <strong>Success!</strong>Something went wrong.
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
            </div> ';
        }
        
    }
?>




<html>

<head>
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
                <div class="mx-2">
                <li class="nav-item dropdown">
                <a class="btn btn-success" href="#" id="navbarDropdown" role="button"
                    data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <p class="text-light my-0 mx-2">Welcome '. $_SESSION['username']. ' </p>
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
    <div class="jumbotron jumbotron-fluid">
        <div class="container">
            <div class="row">

                <form action="addratetoprovider.php" method="post">

                    <div>
                        <h6>Thank you for engaging with the services of service lagbe. Please provide your valuable rating our service provider <?php echo "<h2>" . $_SESSION['providername'] . "</h2>";?>
                        </h6>
                    </div>

                    <div class="rateyo" id="rating" data-rateyo-rating="4" data-rateyo-num-stars="5"
                        data-rateyo-score="3">
                    </div>

                    <span class='result'>0</span>
                    <input type="hidden" name="rating">

            </div>
            
            <div>
                <button type="submit" class="btn btn-primary">Submit</button>
            </form>
        </div>
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
</body>

</html>