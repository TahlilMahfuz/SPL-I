<?php
include 'partials/_admindbconnect.php';
$delete = false;
$showError = false;
if(isset($_POST['delete_btn']))
{
    $id = $_POST['delete_id'];
    
    $query = "DELETE FROM serviceproviders WHERE providerid='$id' ";
    $query_run = mysqli_query($conn, $query);
    
    if($query_run)
    {
        session_start();
        $delete = true;
        header('Location: postadminlogin.php'); 
    }
    else
    {
        $showError = "Sorry, Deletion could be processed. Something went wrong";
    }    
}
?>