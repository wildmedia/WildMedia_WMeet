<?php
include_once'config.php';
session_start();
if(isset($_POST['login'])){
	$username = $_POST['username'];
	$password = md5($_POST['password']);
	$mysql_data = mysql_query("SELECT * FROM `users` WHERE `username` = '$username' AND `password` = '$password'");
	if(mysql_num_rows($mysql_data)>0){
		$user_data = mysql_fetch_array($mysql_data);
		$_SESSION["auth"] = 1;
		$_SESSION['user_email'] = $user_data['email'];
		$_SESSION['user_name'] = $user_data['username'];
		$_SESSION['user_friend_list'] = $user_data['friend_list'];
		header('Location: members.php');
	}else{
		$_SESSION['login_attempt'] = $_SESSION['login_attempt'] + 1;
		header('Location: index.php');
	}
}else{
	header('Location: index.php');
}
?>