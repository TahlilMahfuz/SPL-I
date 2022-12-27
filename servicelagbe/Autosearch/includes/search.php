<?php

require_once 'co.php';

        if($_SERVER['REQUEST_METHOD'] =='POST')
        {
            $Search = $_POST['search'];
            $sql = "select * from services where servicetype like '%".$Search."%' ";
            $result = mysqli_query($con,$sql);

            if(mysqli_num_rows($result))
            {
                while($row = mysqli_fetch_assoc($result))
                {
                    echo '<a href="#" class="list-group list-group-item-action border p-2">'.$row['servicetype'].'</a>';
                }
            }
            else
                {
                    echo '<p class="list-group list-group-item">Not found </p>';
                }
        }

?>