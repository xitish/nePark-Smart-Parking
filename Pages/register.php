<?php
require('../mysqli_connect.php');
$msg="";
if(isset($_POST['Send']))
{
	if(!empty($_POST['name']) && !empty($_POST['loc']) && !empty($_POST['oname']) && !empty($_POST['uname']) && !empty($_POST['password']) && !empty($_POST['num']) && !empty($_POST['lat'])  && !empty($_POST['long']) )
	{
		$pname=  trim($_POST['name']);
		$padd= trim($_POST['loc']);
		$owner=trim($_POST['oname']);
		$uname = trim($_POST['uname']);
		$password= trim($_POST['password']);
		$num = $_POST['num'];
		$lat = $_POST['lat'];
		$long = $_POST['long'];
		
		$query = "INSERT INTO list (name, location,latitude,longitude, owner, user_name, password, total,available) VALUES (?,?,?,?,?,?,?,?,?)";
		$stmt = mysqli_prepare($dbc, $query);
		mysqli_stmt_bind_param($stmt, "sssssssss",$pname,$padd,$lat,$long, $owner, $uname, $password,$num,$num);
		mysqli_stmt_execute($stmt);

		$query= "CREATE TABLE $uname(`id` INT NOT NULL AUTO_INCREMENT  , `car_num` VARCHAR(30) NOT NULL ,`date_entered` TIMESTAMP NOT NULL , PRIMARY KEY (`id`), `avail` BOOLEAN NOT NULL, `owner` VARCHAR(50) NOT NULL)";
		$stmt = mysqli_prepare($dbc, $query);
		mysqli_stmt_execute($stmt);
		mysqli_stmt_close($stmt);
		
		$var='';
		$var1=TRUE;
		
		$query = "INSERT INTO $uname (car_num, owner, avail) VALUES (?,?,?)";
		$stmt = mysqli_prepare($dbc, $query);
		mysqli_stmt_bind_param($stmt, "sss",$var,$var,$var1);
		for ($x = 0; $x < $num; $x++) 
		{
		mysqli_stmt_execute($stmt);
		}
		mysqli_close($dbc);
	}
	else {$msg='<b style="font-size:20px;">Please Fill in all the fields</b>';}
}
?>
<html>
<head>
<title> Register Your Parking Lot </title>
<link rel="stylesheet" type="text/css" href="css/bootstrap.css">
<link rel="stylesheet" href="assets/css/main.css" />
</head>
<body>
	<section id="One" class="wrapper style3">
		<div class="inner">
			<header class="align-center">
			<a href="index.html"><image src="images/np.png" alt="logo" ></a>
			<p></p>
				<h2>Register Your Parking</h2>
				<p>YOUR SMART PARKING SOLUTION</p>
			</header>
		</div>
	</section>
	<div style="padding-top:20px;">
		<div class="container">
		<center><p> <?php echo $msg ?> </p></center>
			<form class="form-horizontal col-sm-10 col-sm-offset-1" action="register.php" method="POST">
			
			  <div class="form-group">
				<label for="name" class="col-sm-4 control-label">Parking Lot Name</label>
				<div class="col-sm-6">
				  <input type="text" name= "name" class="form-control" id="name" placeholder="Eg : Purwanchal Parking Garage">
				</div>
			  </div>
			  
			  <div class="form-group">
				<label for="location" class="col-sm-4 control-label">Parking Lot Location</label>
				<div class="col-sm-6">
				  <input type="text" name= "loc" class="form-control" id="location" placeholder="Eg : Dharan Nepal">
				</div>
			  </div>
			  
			   <div class="form-group">
				<label for="lat" class="col-sm-4 control-label">Latitude</label>
				<div class="col-sm-6">
				  <input type="text" name= "lat" class="form-control" id="lat" placeholder="Eg : 47.5678">
				</div>
			  </div>
			  
			  <div class="form-group">
				<label for="lat" class="col-sm-4 control-label">Longitude</label>
				<div class="col-sm-6">
				  <input type="text" name= "long" class="form-control" id="long" placeholder="Eg : 68.5678">
				</div>
			  </div>
			  
			  <div class="form-group">
				<label for="oname" class="col-sm-4 control-label">Owner's Full Name</label>
				<div class="col-sm-6">
				  <input type="text" name= "oname" class="form-control" id="oname" placeholder="Eg : Pukar Ghimire">
				</div>
			  </div>
			  
			  <div class="form-group">
				  <label for="number" class="col-sm-4 control-label">Total Spaces</label>
				    <div class="col-sm-6">
					  <select class="form-control" id="number" name="num">
						  <option>10</option>
						  <option>20</option>
						  <option>30</option>
						  <option>40</option>
						  <option>50</option>
						</select>
					</div>
				</div>
				
				<div class="form-group">
				<label for="uname" class="col-sm-4 control-label">Username</label>
				<div class="col-sm-6">
				  <input type="text" name= "uname" class="form-control" id="uname" placeholder="User Name" aria-describedby="helpBlock">
					<span class="col-sm-12" id="helpBlock" class="help-block"><small style="font-size:13px;">Username shold contain only letters and numbers and no special symbols.</small></span>
				</div>
			  </div>
			  
			  <div class="form-group">
				<label for="password" class="col-sm-4 control-label">Password</label>
				<div class="col-sm-6">
				  <input type="password" name= "password" class="form-control" id="password" placeholder="Password">
				</div>
			  </div>
			  <div class="align-center"> Username and Password combination is used to log in. </div>
			  <br>
			  <div class="form-group">
				<div class="col-sm-12" >
				  <center><button type="submit" name="Send" class="btn btn-info" style="width:300px;">Register</button></center>
				</div>
			  </div>
			</form>
		</div>
    </div>
	
</body>
</html>
	