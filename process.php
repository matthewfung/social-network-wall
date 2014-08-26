<?php
	session_start();
	include("include/connection.php");

	if(isset($_POST['message'])){
		$sql = "INSERT INTO messages (message,created_at,updated_at, user_id) VALUES ('".$_POST['message']."', NOW(), NOW(), '".$_SESSION['user-id']."')";
		runQuery($sql);
		header("Location: index.php");
	}
	if(isset($_POST['comment'])){
		$sql = "INSERT INTO comments (comment,created_at,updated_at,message_id, user_id) VALUES ('".$_POST['comment']."', NOW(), NOW(), '".$_POST['message-id']."','".$_SESSION['user-id']."')";
		runQuery($sql);
		header("Location: index.php");
	}
?>
