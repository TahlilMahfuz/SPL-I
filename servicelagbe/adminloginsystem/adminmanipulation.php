<?php
include 'partials/_admindbconnect.php';

if(isset($_POST['delete_btn']))
{
    $id = $_POST['delete_id'];
    
    $query = "DELETE FROM serviceproviders WHERE providerid='$id' ";
    $query_run = mysqli_query($conn, $query);
    
    if($query_run)
    {
        session_start();
        $_SESSION['deletedprovider'] = "Service Provider Removed";
        header('Location: postadminlogin.php'); 
    }
    else
    {
        $_SESSION['deletedprovidererror'] = "Sorry, Deletion could be processed. Something went wrong";
        header('Location: postadminlogin.php'); 
    }    
}
?>