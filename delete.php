<?php
session_start();
//connecting database
$conn = mysqli_connect("localhost","root","","login_register");


if(isset($_GET['id']))
{
    

     $id = $_GET['id'];
     
     

    $query =" DELETE FROM tasks WHERE id = $id ";
    $run = mysqli_query($conn,$query);
    var_dump($run);

    if ($run)
    {
        echo '';
        header("location: welcome.php");
       
    }
    else{
         echo "data not deleted";
    }
}



?>