<?php
	session_start();

?>
<html>
<head>
	<title>Login and Registration</title>
	<style type="text/css">
		h1{
			margin-left: 100px;
		}
		label{
			display: block;
			margin-left: 100px;
		}
		input[type="submit"]{
			margin-left: 100px;
			border: 1px solid blue;
			color: white;
			background-color: blue;
			border-radius: 25px;
			font-weight: bold;
			width: 80px;
			height: 30px;
		}
		#reg-error, #login-error{
			width: 300px;
			margin-left: 100px;
			background-color: pink;
			height: auto;
		}
	</style>
</head>
<body>
	<h1>Register</h1>
	<div id="reg-error">
<?php 		if(!empty($_SESSION['registration-errors'])){
				foreach($_SESSION['registration-errors'] as $value){?>
					<p><?= $value?></p>
<?php			}
			}?>
	</div>
	<form action="login.php" method="post">
		<input type="hidden" name="register" value="register">
		<label>First name: <input type="text" name="first-name"></label>
		<label>Last name: <input type="text" name="last-name"></label>
		<label>Email address: <input type="text" name="email"></label>
		<label>Password: <input type="text" name="password"></label>
		<label>Confirm Password: <input type="text" name="confirm-password"></label>
		<input type="submit" value="Register">
	</form>
	<h1>Login</h1>
	<div id="login-error">
<?php	if(isset($_SESSION['login-error']) && $_SESSION['login-error'] == true){
			$_SESSION['login-error'] = false;?>
			<p>Your login credentials do not match our records!</p>
<?php	}?>
	</div>
	<form action="login.php" method="post">
		<input type="hidden" name="login" value="login">
		<label>Email address: <input type="text" name="email"></label>
		<label>Password: <input type="text" name="password"></label>
		<input type="submit" value="Login">
	</form>
</body>
</html>