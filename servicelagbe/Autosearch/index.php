<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <title>Document</title>
</head>
<body class="bg-dark">
    
    <div class="container">
        <div class="row">
            <div class="col-lg-6 m-auto">
                <div class="card mt-5">
                    <div class="card-header">
                        <h4 class="text-center">Searchbox</h4>
                    </div>
                     <div class="card-body">
                        <form method="POST" class="form-inline">
                            <input type="text" class="form-control w-75" id="search" placeholder="Search Category">
                            <button type="button" id="btn_search" class="btn btn-primary">Search</button>
                        </form>
                     </div>

                     <div class="card-body">
                        <div class ="list-group list-group-item-action" id="content">
                            
                        </div>
                     </div>
                </div>    
            </div>
        </div>
    </div>

<script src="js/jquery-3.6.3.min.js"></script>
<script src="js/main.js"></script>
</body>
</html>   