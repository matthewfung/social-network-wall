<?php
	session_start();
?>
<html>
<head>
	<title>Login Successful</title>
	<style type="text/css">
		input{
			border: 1px solid blue;
			color: white;
			font-weight: bold;
			background-color: blue;
			border-radius: 20px;
		}
	</style>
</head>
<body>
	<h1>Welcome <?=$_SESSION['first-name']." ".$_SESSION['last-name']?></h1>
	<form action="process.php" method="post">
		<input type="hidden" value="logoff" name="logoff">
		<input type="submit" value="Log Off">
	</form>
</body>
</html>