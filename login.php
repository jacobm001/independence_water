<?php
session_start();//session starts here

?>
<!DOCTYPE html>
<html>
<head lang="en">
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" href="bootstrap/css/bootstrap.css">
	<link href="/css/signin.css" rel="stylesheet">
	<script src="jquery/jquery-2.2.0.js"></script>
	<script src="jquery/jquery.csv.js"></script>
	<script src="bootstrap/js/bootstrap.js"></script>
	<title>Login - Abzu: Water Visualization</title>
</head>
<style>
	.login-panel {
		margin-top: 150px;
	}
</style>

<body>


<div class="container">
	<div class="row">
		<div class="col-md-4 col-md-offset-4">
			<div class="login-panel panel panel-primary">
				<div class="panel-heading">
					<h3 class="panel-title">Please sign in to Abzu</h3>
				</div>
				<div class="panel-body">
					<form role="form" method="post" action="login.php">
						<fieldset>
							<div class="form-group">
								<label class="control-label">Username</label>
								<div class="input-group">
									<span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
									<input class="form-control" placeholder="Username" name="username" type="text" autofocus>
								</div>
							</div>
							<div class="form-group">
								<label class="control-label">Password</label>
								<div class="input-group">
									<span class="input-group-addon"><i class="glyphicon glyphicon-lock"></i></span>
									<input class="form-control" placeholder="Password" name="pass" type="password" value="">
								</div>
							</div>
							<input class="btn btn-lg btn-primary btn-block" type="submit" value="Login" name="login" >

							<!-- Change this to a button or input when using this as a form -->
						  <!--  <a href="index.html" class="btn btn-lg btn-success btn-block">Login</a> -->
						</fieldset>
					</form>
				</div>
			</div>
		</div>
	</div>
</div>


</body>

</html>

<?php

//include("database/db_conection.php");

if(isset($_POST['login']))
{
	include 'api/Init.php';
	include 'api/DataImporter.php';
	include 'api/AbzuDB.php';
	
	$AbzuDB = new AbzuDB($db);

	$user_username=$_POST['username'];
	$user_pass=$_POST['pass'];
/*
	$check_user="select * from users WHERE user_username='$user_username'AND user_pass='$user_pass'";

	$run=mysqli_query($dbcon,$check_user);

	if(mysqli_num_rows($run))
	{
		echo "<script>window.open('welcome.php','_self')</script>";

		$_SESSION['username']=$user_username;//here session is used and value of $user_username store in $_SESSION.

	}
	else
	{
		echo "<script>alert('username or password is incorrect!')</script>";
	}
*/	
	$user_pass_valid = $AbzuDB->check_credentials($user_username, $user_pass);
	
	echo $user_pass_valid;

	if($user_pass_valid = true)
	{
		echo "<script>window.open('index.html','_self')</script>";
		$_SESSION['username']=$user_username;//here session is used and value of $user_username store in $_SESSION.

	}
	else
	{
		echo "<script>alert('username or password is incorrect!')</script>";
	}
}
?>