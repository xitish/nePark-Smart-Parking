<?php
session_start();
if(!isset($_SESSION['user_id']))
{
	header("Location: login.php");
}
require_once('../mysqli_connect.php');
$user = $_SESSION['user'];
$mck='';
$mco='';
$ms1='';
if(isset($_POST['In']))
{
	if(!empty($_POST['carnumber']) && !empty($_POST['oname']))
	{
		$cnum=trim($_POST['carnumber']);
		$oname=trim($_POST['oname']);
		
		$query = "SELECT * FROM $user WHERE `avail` = 1 LIMIT 1";
		$response = @mysqli_query($dbc, $query);
		if($response)
		{ 
			$row = mysqli_fetch_array($response);
			$x= $row['id'];
			$query = 'UPDATE  `' . $user . '` SET car_num ="'. $cnum .'", owner = "'.$oname.'", avail = 0 WHERE id ="'. $x. '"';
			if(mysqli_query($dbc, $query))
				{ 
					$query = 'SELECT * FROM list WHERE `user_name` ="'. $user .'"';
					$response = @mysqli_query($dbc, $query);
					if($response)
					{
						$row = mysqli_fetch_array($response);
						$av=$row['available'];
						if($av>0)
						{
							$x=$row['id'];
							$av=$av-1;
							$query = 'UPDATE list SET available ="'. $av.'"WHERE id ="'. $x. '"';
							if(mysqli_query($dbc, $query))
							{
								$mck = "Checked In successfully.";							
							}
						}
						else
						{
							$mck = 'Parking Lot FULL. Could Not Check IN';
						}
					}				
				}
				else 
					{ $mck =  "ERROR: Could not Check In" . mysqli_error($dbc); }
		}
		else{echo 'Full';}
	}
	else { $mck="Please Fill all the fields.";}
}

if(isset($_POST['Out']))
{
	if(!empty($_POST['carnum']))
	{
		$cnum=trim($_POST['carnum']);
		$query = "SELECT * FROM $user";
		$response = @mysqli_query($dbc, $query);
		
		if($response){
			while($row = mysqli_fetch_array($response))
			{
				if($row['car_num'] == $cnum)
				{
					$x=$row['id'];
					$empty='';
					$query = 'UPDATE  `' . $user . '` SET car_num ="'.$empty.'", owner = "'.$empty.'", avail = 1 WHERE id ="'. $x. '"';
					if(mysqli_query($dbc, $query))
					{ 
						$query = 'SELECT * FROM list WHERE `user_name` ="'. $user .'"';
						$response = @mysqli_query($dbc, $query);
						if($response)
						{
							$row = mysqli_fetch_array($response);
							$av=$row['available'];
							$x=$row['id'];
							$av=$av+1;
							$query = 'UPDATE list SET available ="'. $av.'"WHERE id ="'. $x. '"';
							if(mysqli_query($dbc, $query))
							{
								$ms1 = "Checked Out successfully.";							
							}
						}
						else 
							{ $ms1 =  "ERROR: Could not Check Out" . mysqli_error($dbc); }
					}
			}
		}
				
	}
}
	else
	{
		$ms1='Please Provide Car Number';
	}
}
?>

<html>
<head>
	<title> Manage | NEPARK </title>
	<link rel="stylesheet" type="text/css" href="css/bootstrap.css">
	<link rel="stylesheet" href="assets/css/main.css" />
</head>
<body>
	<section id="One" class="wrapper style3">
		<div class="inner">
			<header class="align-center">
			<a href="index.html"><image src="images/np.png" alt="logo" ></a>
			<p></p>
				<h2><?php echo $_SESSION['gname']; ?></h2>
				<p><?php echo $_SESSION['adress']; ?></p>
			</header>
		</div>
	</section>
	
	<div class="container" style="padding-top:20px;">
		<div>
			<span class="well pull-left" style="font-size:20px;"> Total Spaces :  <?php echo $_SESSION['total']; ?>	</span>
			<span class="well pull-right" style="font-size:20px;"> Available Spaces: 
				<?php 
					$query = 'SELECT * FROM list WHERE `user_name` ="'. $user .'"';
						$response = @mysqli_query($dbc, $query);
						if($response)
						{
							$row = mysqli_fetch_array($response);
							echo $row['available'];
						}
				?>	
			</span>
		<div>
		<div class="clearfix"></div>
		<div class="row" style="padding-top:20px;">
			<div class="col-lg-8">
				<table class="table table-bordered">
					<thead style="font-size:20px;">
						<tr>
							<td> S. N </td>
							<td> Car No. </td>
							<td> Owner </td>
							<td> Parked Time </td>
						</tr>
					</thead>
					<tbody style="font-size:17px;">
						<?php
							$count =1;
							$query = "SELECT * FROM $user";
							$response = mysqli_query($dbc, $query);
							while($row = mysqli_fetch_array($response))
							{
								echo '<tr>';
								echo '<td>'. $count .'</td>';
								if(!empty($row['car_num']))
								{
									echo '<td>'. $row['car_num'].'</td>';
									echo '<td>'. $row['owner'].'</td>';
									echo '<td>'. $row['date_entered'].'</td>';
								}
								else
								{
									echo '<td> Empty </td>';
								}
								echo '</tr>';
								$count = $count +1;
							}
						?>
					</tbody>
				</table>
			</div>
			
			<div class="col-lg-4">
			<form style="padding:10px; border:2px solid #E6E6E6;" action="list.php" method="POST">
			<div class="text-center" style="font-size:20px;">Check In </div>
				<div class="form-group">
				<label for="carnumber" class="control-label">Car Number</label>
				<div>
				  <input type="text" name= "carnumber" class="form-control" id="carnumber" placeholder="Eg : 1235">
				</div>
			  </div>
			  
			  <div class="form-group">
				<label for="oname" class="control-label">Owner Name</label>
				<div>
				  <input type="text" name= "oname" class="form-control" id="oname" placeholder="Eg : Pukar">
				</div>
			  </div>
			  
			  <div class="form-group">
				<div class="col-sm-12" >
				  <center><button type="submit" name="In" class="btn btn-info" style="width:300px;">Check In</button></center>
				</div>
			  </div>
			  <center><?php	echo $mck;?></center>
			</form>
			
			<form  style="padding:10px; border:2px solid #E6E6E6;" action="list.php" method="POST">
				<div class="text-center" style="font-size:20px;">Check Out </div>
				<div class="form-group">
					<label for="carnum" class="control-label">Car Number</label>
					<div>
					  <input type="text" name= "carnum" class="form-control" id="carnum" placeholder="Eg : 1244">
					</div>
				  </div>
				  
				  <div class="form-group">
					<div class="col-sm-12" >
					  <center><button type="submit" name="Out" class="btn btn-info" style="width:300px;">Check Out</button></center>
					</div>
				  </div>
				  
				  <center><?php	echo $ms1;?></center>
			</form>
			</div>
		</div>
	
	
	</div>
	
	
</body>
</html>