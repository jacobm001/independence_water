<?php
session_start();//session starts here

?>

<html>
<head lang="en">
	<meta charset="UTF-8">
	<link type="text/css" rel="stylesheet" href="bootstrap\css\bootstrap.css">
	<title>Login</title>
</head>
<style>
	.login-panel {
		margin-top: 150px;

</style>

<body>


<div class="container">
	<div class="row">
		<div class="col-md-4 col-md-offset-4">
			<div class="login-panel panel panel-success">
				<div class="panel-heading">
					<h3 class="panel-title">Sign In</h3>
				</div>
				<div class="panel-body">
					<form role="form" method="post" action="login.php">
						<fieldset>
							<div class="form-group"  >
								<input class="form-control" placeholder="Username" name="username" type="text" autofocus>
							</div>
							<div class="form-group">
								<input class="form-control" placeholder="Password" name="pass" type="password" value="">
							</div>


								<input class="btn btn-lg btn-success btn-block" type="submit" value="login" name="login" >

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

include("database/db_conection.php");

if(isset($_POST['login']))
{

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
	if($.get("../api/" + $user_username + $user_pass))
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