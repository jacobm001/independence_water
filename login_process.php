<?php
	session_start();
	require_once '/api/queries/AbzuDB.php';

	if(isset($_POST['btn-login']))
	{
		$user_name = trim($_POST['username']);
		$user_password = trim($_POST['password']);
		
		$password = md5($user_password);
		
		try
		{ 
		//	$stmt = $db_con->prepare("SELECT * FROM tbl_users WHERE user_email=:email");
		//	$stmt->execute(array(":email"=>$user_name));
		//	$row = $stmt->fetch(PDO::FETCH_ASSOC);
		//	$count = $stmt->rowCount();
			
			if(check_credentials($user_name, $user_password)==true){
				echo "ok"; // log in
			//	$_SESSION['user_session'] = $row['username'];
			}
			else{
				echo "Username or password does not exist."; // wrong details 
			}
			
		}
		catch(PDOException $e){
			echo $e->getMessage();
		}
	}
?>