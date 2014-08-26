<?php
	session_start();
	include("include/connection.php");

	if(isset($_POST['register'])){
		$error = false;
		$_SESSION['registration-errors'] = array();

		if(empty($_POST['first-name'])){
			$_SESSION['registration-errors'][] = "Please enter your first name<br>";
			$error = true;
		}
		if(empty($_POST['last-name'])){
			$_SESSION['registration-errors'][] = "Please enter your last name<br>";
			$error = true;
		}
		if(strpbrk($_POST['first-name'], "1234567890") || strpbrk($_POST['last-name'], "1234567890")){
			$_SESSION['registration-errors'][] = "Your first or last name should not contain any digits<br>";
			$error = true;
		}
		if(empty($_POST['email'])){
			$_SESSION['registration-errors'][] = "Please enter your email address<br>";
			$error = true;
		}
		if(empty($_POST['password'])){
			$_SESSION['registration-errors'][] = "Please enter a password<br>";
			$error = true;
		}
		if($_POST['password'] != $_POST['confirm-password']){
			$_SESSION['registration-errors'][] = "Your passwords don't match!<br>";
			$error = true;
		}
		//Send back to original page to warn of error.
		if($error){
			$_SESSION['register-success'] = false;
			header("Location: index.php");
		} else{
			$sql = "SELECT * FROM users WHERE email= '".$_POST['email']."' AND password= '".$_POST['password']."'";
			$check = fetchRecords($sql);
			if(count($check) > 0){
				echo "Already registered";
			} else{
				$sql = "INSERT INTO users (first_name, last_name, email, password, created_at, updated_at) VALUES 
						('".$_POST['first-name']."','".$_POST['last-name']."', '".$_POST['email']."', '".$_POST['password']."', NOW(), NOW())";
				runQuery($sql);
				$_SESSION['register-success'] = true;
			}
		}
	}

	if(isset($_POST['login'])){
		$sql = "SELECT * FROM users WHERE email= '".$_POST['email']."' AND password= '".$_POST['password']."'";
		$login = fetchRecords($sql);
		if(count($login) > 0){
			echo "got here";
			$_SESSION['login-error'] = false;
			$_SESSION['logged-in'] = true;
			$_SESSION['user-id'] =  $login[0]['id'];
			$_SESSION['first-name'] = $login[0]['first_name'];
			$_SESSION['last-name'] = $login[0]['last_name'];
		} else{
			$_SESSION['login-error'] = true;
		}
		//var_dump($_SESSION);
		header("Location: index.php");
	}

	if(isset($_POST['logoff'])){
		if($_POST['logoff']){
			$_SESSION['logged-in'] = false;
			session_destroy();
			header("Location: index.php");
		}
	}


?>
