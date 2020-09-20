<?php

session_start();
error_reporting(0);
//echo "<pre>";
//var_dump($_SESSION);die;

$conn = mysqli_connect("localhost","root","","login_register");
//ini_set('display_error',1);
//ini_set('display_startup_errors',1);
//error_reporting(E_ALL);



$user_id =$_SESSION["id"];
$_SESSION["name"] = $data['name'];


$msg = "";


$qry = "SELECT t.* ,  r.name FROM register AS r INNER JOIN  tasks AS t ON(r.id = t.user_id)";
$result = mysqli_query($conn,$qry);









?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>All tasks</title>
</head>
<style>
table {
  font-family: arial, sans-serif;
  border-collapse: collapse;
  width: 100%;
}

td, th {
  border: 1px solid #dddddd;
  text-align: left;
  padding: 8px;
}


</style>
</head>
<body>

<h2><center>All Tasks</center></h2>

<table>
  <tr>
    <th>Name</th>
    <th>Problem</th>
    <th>Description</th>
    <th>Edit</th>
    
  </tr>
  <?php  while($row = mysqli_fetch_array($result)) { ?>
    <tr>
    <?php //var_dump($row);die;?>
     <td><?php echo $row['name'] ?> </td>
     <td><?php echo $row['problem'] ?> </td>
     <td><?php echo $row['description'] ?> </td>
     <td><?php 
           if (isset($_SESSION['login']) && $_SESSION['login'] == true){
                if (isset($_SESSION['id']) && $_SESSION['id'] == $row['user_id']){
                  
                    echo "<a href='welcome.php?edit=<?php echo $row["id"]; ?>'>Edit</a>";
}
               
                      
           }
     ?></td>    <!--editing data in database-->
   
    
    
    </tr>
    <?php } ?>
</table>
    
</body>
</html>