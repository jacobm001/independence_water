<?php
	session_start();
//	private $AbzuDB;
	require_once '/api/AbzuDB.php';
/*
	public function __construct(&$AbzuDB)
	{
		$this->AbzuDB = $AbzuDB;
	}
*/
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
			echo $db->check_credentials($user_name, $user_password);
			if($db->check_credentials($user_name, $user_password)==true){
				echo "ok"; // log in
			//	$_SESSION['user_session'] = $row['username'];
			}
			else{
				echo "Username or password does not exist."; // wrong details 
			}
			
		}
	}
?>