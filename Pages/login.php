<?php
session_start();
if(isset($_SESSION['user_id']))
{
	header("Location: list.php");
}
require('../mysqli_connect.php');
$message='';
$msg='';
if(isset($_POST['Send']))
{
	if(!empty($_POST['uname']) && !empty($_POST['password']))
	{
		$query = "SELECT * FROM list";
		$response = @mysqli_query($dbc, $query);
		
			if($response){
				while($row = mysqli_fetch_array($response))
				{
				if($row['user_name'] == $_POST['uname'] AND $_POST['password']==$row['password'])
				{
					$_SESSION['user_id'] = $row['id'];
					$_SESSION['gname'] = $row['lot_name'];
					$_SESSION['adress'] = $row['location'];
					$_SESSION['total'] = $row['total'];
					$_SESSION['avail'] = $row['avail'];
					$_SESSION['user'] = $row['user_name'];
					
					header("Location: list.php");
					}
				}
				$message = '<b style="font-size:17px;">Email OR Password Do not Match. Try Again </b>';
			}
	}
	else {$msg=  '<b style="font-size:20px;">Please Fill in all the fields</b>';}
}
mysqli_close($dbc);
?>

<html>
<head>
<title> Log in | NEPARK </title>
<link rel="stylesheet" type="text/css" href="css/bootstrap.css">
<link rel="stylesheet" href="assets/css/main.css" />
</head>
<body>
	<section id="One" class="wrapper style3">
		<div class="inner">
			<header class="align-center">
			<a href="index.html"><image src="images/np.png" alt="logo" ></a>
			<p></p>
				<h2>Log In to NEPARK</h2>
				<p>YOUR SMART PARKING SOLUTION</p>
			</header>
		</div>
	</section>
	<div style="padding-top:20px;">
	<center><p> <?php echo $msg ?> </p></center>
		<form class="form-horizontal col-sm-8 col-sm-offset-2" action="login.php" method="POST">
			<div class="form-group">
					<label for="uname" class="col-sm-4 control-label">Username</label>
					<div class="col-sm-8">
					  <input type="text" name= "uname" class="form-control" id="uname" placeholder="User Name" >
					</div>
			</div>
				  
		  <div class="form-group">
			<label for="password" class="col-sm-4 control-label">Password</label>
			<div class="col-sm-8">
			  <input type="password" name= "password" class="form-control" id="password" placeholder="Password">
			</div>
		  </div>
		  <center><p> <?php echo $message ?> </p></center>
		  
		  <div class="form-group">
			<div class="col-sm-12" >
			  <center><button type="submit" name="Send" class="btn btn-info" style="width:250px;">Log In</button></center>
			</div>
		  </div>
		</form>
	</div>

	</body>
</html>