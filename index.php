<?php
	session_start();
	include("include/connection.php");
?>
<html>
<head>
	<title>Wall Assignment</title>
	<style type="text/css">
		input[type="submit"]{
			background-color: blue;
			border: 2px solid blue;
			color: white;
			font-weight: bold;
			display: block;
			margin-left:600px;
			border-radius: 20px;
		}
		#message-box{
			width: 700px;
			height: 120px;
		}
		#comment-box{
			margin-left: 30px;
		}
		#header{
			background-color: black;
			color: white;
			padding-left: 200px;
			height: 100px;
			width: 960px;
		}
		a{
			color: white;
			font-weight: bold;
			padding-left: 200px;
		}
		img{
			padding: 10px 400px 10px 40px;
			height: 70px;
		}
		#credentials{
			display: inline-block;
			width: 280px;
			background-color: green;
		}
		#messages-section{
			width: 960px;
			padding-left: 200px;
			background-color: silver;
		}
		.message{
			display: block;
			font-weight: bold;
			font-size: 15px;
		}
		.comment{
			margin-left: 20px;
		}
	</style>
</head>
<body>
	<div id="header">
		<img src="coding_dojo_logo.png" alt="">
		<div id="credentials">
			<!-- <form action="login.php" method="post">
				<input type="hidden" name="login" value="login">
				<input type="text" name="login-email" placeholder="Email Address">
				<input type="text" name="login-password" placeholder="Password">
				<button type="submit">Login</button>
			</form> -->
<?php       if(isset($_SESSION['user-id'])){
				echo "Welcome ".$_SESSION['first-name'];
			}?>
			<a href="registration.php">Register</a>
		</div>
	</div>
	<div id="messages-section">
		<h2>Post a message</h2>
		<form action="process.php" method="post">
			<textarea name="message" id="message-box"></textarea>
			<input type="hidden" name = "message" value="post">
			<input type="submit" value="Post a message">
		</form>
<?php 	$sql = "SELECT * from messages ORDER BY updated_at DESC";
		$values = fetchRecords($sql);

		foreach($values as $value){
			$sqlcomments = "SELECT comments.comment, comments.updated_at, CONCAT(users.first_name,' ', users.last_name) AS name FROM comments 
							LEFT JOIN users ON comments.user_id=users.id WHERE message_id=".$value['id'];
			$comments = fetchRecords($sqlcomments);?>
			<p class = "message"><?=$value['message'];?></p>
<?php 		foreach($comments as $comment){?>
				<h4><?=$comment['name']." - ".date('F d Y', strtotime($comment['updated_at']))?></h4>
				<p class = "comment"><?=$comment['comment']?></p>
<?php		}?>
			Post a comment
			<form action="process.php" method="post" id="comment-box">
				<textarea name="comment" id="comment"></textarea>
				<input type="hidden" name = "message-id" value="<?=$value['id']?>">
				<input type="submit" value="Post a comment">
			</form>
<?php	}?>
	</div>
</body>
</html>