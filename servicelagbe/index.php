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
    <?php include 'partials/_header.php';?>

    <?php
        $server = "localhost";
        $username = "root";
        $password = "";
        $database = "servicelagbe";
        
        $conn = mysqli_connect($server, $username, $password, $database);
        if (!$conn){
            die("Error". mysqli_connect_error());
        }
        $sql = "select * from services order by servicetype asc";
        $query_run =  mysqli_query($conn, $sql);
    ?>

    <div class="container">
        <div class="row">
            <?php
                    if(mysqli_num_rows($query_run) > 0)        
                    {
                        while($row = mysqli_fetch_assoc($query_run))
                        {
                    ?>
            <div class="col-md-4">
                <div class="card my-4" style="width: 18rem;">
                    <img src="/servicelagbe/img/ac.jpg" class="card-img-top" alt="...">
                    <div class="card-body">
                        <h5 class="card-title"><?php  echo $row['servicetype']; ?></h5>
                        <h7 class="card-title">BDT <?php  echo $row['servicecost']; ?></h7>
                        <p class="card-text"></p>
                        <a href="/servicelagbe/loginsystem/login.php" class="btn btn-primary">Appoint
                            <?php  echo $row['servicetype']; ?></a>
                    </div>
                </div>
            </div>
            <?php
                        } 
                    }
                    else {
                        echo "No Record Found";
                    }
                    ?>



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