<?php
session_start();
//echo "<pre>";
//var_dump($_SESSION);die;

$conn = mysqli_connect("localhost","root","","login_register");
//ini_set('display_error',1);
//ini_set('display_startup_errors',1);
//error_reporting(E_ALL);


if (!(isset($_SESSION['login']) && $_SESSION['login'] != '')) {

	header ("Location: login.php");
	
	}


if(isset($_POST['answer'])){

	if(isset($_POST['id']) && $_POST['id'])
    {
        $id = $_POST['id'];
        $problem = $_POST['problem'];
        $description = $_POST['description'];
        
    
    
        $qry = "UPDATE tasks SET problem = '$problem', description = '$description' where id='$id' ";
		$result = mysqli_query($conn,$qry);
	 
		
       
    
        if($result)
        {
            echo "";
        }
        else{
            echo "something wronge with code";
        }
    }
    else{
	
	$problem = $_POST['problem'];
	$description = $_POST['description'];
     $user_id =$_SESSION["id"];
	

	$sql = "INSERT INTO tasks(user_id,problem,description,status)VALUES('".$user_id."','".$problem."','".$description."','completed')";
	$result = mysqli_query($conn,$sql);
	
	if($result)
	{
		echo "";
	}
	else
	{
		 mysqli_error($conn);
	}
	//var_dump($result);
	//mysqli_error($conn);

}}
$user_id =$_SESSION["id"];

$sql="SELECT status FROM tasks WHERE user_id = '$user_id'";
if ($result=mysqli_query($conn,$sql))
  {
  // Return the number of rows in result set
  $rowcount=mysqli_num_rows($result);
  
  // Free result set
  mysqli_free_result($result);
  }


$user_id =$_SESSION["id"];
$qry = "SELECT * FROM tasks WHERE user_id = '$user_id' ";
$result = mysqli_query($conn,$qry);

//editing and updating data in database

if(isset($_GET['edit']))


{
	$qry = "SELECT * FROM tasks WHERE id =".$_GET['edit'];
	$result = mysqli_query($conn,$qry);
	$data =  mysqli_fetch_row($result);
	
	$qry = "SELECT * FROM tasks WHERE user_id = '$user_id' ";
    $result = mysqli_query($conn,$qry);
	

   
}	







?>


<!DOCTYPE html>
<html>
<head>
	<title></title>
	<!-- Latest compiled and minified CSS -->
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">

	<!-- Optional theme -->
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap-theme.min.css" integrity="sha384-rHyoN1iRsVXV4nD0JutlnGaslCJuC7uwjduW9SVrLvRYooPp2bWYgmgJQIXwl/Sp" crossorigin="anonymous">

	<link rel="stylesheet" href="css/aos.css" />

	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
	

	<!-- Latest compiled and minified JavaScript -->
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>

</head>
<body>


	<br><br><br><br>
	<div class="container">
	<div class="col-md-6">
		<form action="" method="post">
			<div class="col-md-12">
				<div class="text-light bg-success">
					<h1>Welcome! <?php echo $_SESSION['name']; ?></h1> <a href="logout.php">Logout</a>&nbsp;&nbsp;&nbsp;&nbsp;<a href="public.php">View All</a>
				</div>
				<div><h2 class="text-center">Complete You Task</h2></div>
				
				<div class="form-group">
				<input type="hidden" name="id" value="<?php if(isset($data)) { echo $data[0];}?>">
					<label>Problem</label>
					<input class="form-control" type="text" name="problem" value="<?php if(isset($data)) { echo $data[2];}?>" placeholder="Problem" required>
				</div>
				
				
				<div class="form-group">
					<label>Enter Your Answer</label>
					<input class="form-control" type="text" name="description"  value="<?php if(isset($data)) { echo $data[3];}?>" placeholder="Enter Your Answer" required>
				</div>

				<div class="form-group">
						<input class="btn btn-success pull-right" type="submit" id="btnsubmit" name="answer" value="Submit Your Answer">
					</div>

				
			</div>

		</form>
	</div>
	<div class="col-md-6">
	
	  <h2 class="text-center text-light bg-primary">Your tasks: <?php  printf($rowcount);?></h2>


	  <div>
	        <?php
			 while($row=mysqli_fetch_assoc($result))
			
			 
            {
             ?>
             <div class="bg-light"><h3>problem: <?php echo $row["problem"]; ?>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a href="?edit=<?php echo $row['id']; ?>">Edit</a>&nbsp;<a href="delete.php?id=<?php echo $row['id']; ?>">Delete</a></h3></div>
             <div class="bg-success"> <p>Your description:  <?php echo $row["description"]; ?></p></div>
             <?php   }    ?>
	  </div>
	
	
	</div>
	</div>

	

	<div class="container">

		
	</div>
				

						
					
	
	

</body>
</html>