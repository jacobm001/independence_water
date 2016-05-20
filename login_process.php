<?php
	session_start();
	require_once 'api/AbzuDB.php';
	$db = new PDO("sqlite:storage/data.db");
	$AbzuDB = new AbzuDB($db);
//	var_dump($AbzuDB);

	if(isset($_POST['btn-login']))
	{
		$user_name = ($_POST['username']);
		$user_password = ($_POST['password']);
		
	//	var_dump($user_name);
	//	var_dump($user_password);

	//	$password = md5($user_password);
		
		try
		{ 
		//	$stmt = $db_con->prepare("SELECT * FROM tbl_users WHERE user_email=:email");
		//	$stmt->execute(array(":email"=>$user_name));
		//	$row = $stmt->fetch(PDO::FETCH_ASSOC);
		//	$count = $stmt->rowCount();
		//	echo $AbzuDB->check_credentials($user_name, $user_password);
			if($AbzuDB->check_credentials($user_name, $user_password) == 'True'){
				echo "ok"; // log in
				$_SESSION['user_session'] = $user_name;
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