<!DOCTYPE html>
<html>
	<head lang="en">
		<meta charset="UTF-8">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<link rel="stylesheet" href="/bootstrap/css/bootstrap.css">
		<link rel="stylesheet" href="/bootstrap/css/bootstrap-theme.css">
		<link href="/css/signin.css" rel="stylesheet">
		<script type="text/javascript" src="/jquery/jquery-2.2.0.js"></script>
		<script type="text/javascript" src="/jquery/jquery.csv.js"></script>
		<script type="text/javascript" src="/bootstrap/js/bootstrap.js"></script>
		<script type="text/javascript" src="/js/login.js"></script>
		<title>Login - Abzu: Water Visualization</title>
	</head>
	<style>
		.login-panel {
			margin-top: 150px;
		}
	</style>

	<body>
		<div class="signin-form">
			<div class="container">
				<form class="form-signin" method="post" id="login-form">
					<h2 class="form-signin-heading">Log In to Abzu</h2><hr />

					<div id="error">
						<!-- error will be shown here ! -->
					</div>

					<div class="form-group">
						<label class="control-label">Username</label>
						<div class="input-group">
							<span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
							<input type="text" class="form-control" placeholder="Username" name="username" id="username" />
						</div>
					</div>

					<div class="form-group">
						<label class="control-label">Password</label>
						<div class="input-group">
							<span class="input-group-addon"><i class="glyphicon glyphicon-lock"></i></span>
							<input type="password" class="form-control" placeholder="Password" name="password" id="password" />
						</div>
					</div>

					<hr />

					<div class="form-group">
						<button type="submit" class="btn btn-default" name="btn-login" id="btn-login">
						<span class="glyphicon glyphicon-log-in"></span> &nbsp; Sign In
					</button> 
					</div>  
				</form>
			</div>
		</div>
	</body>
</html>
