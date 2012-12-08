<?php

include_once 'config.php';
session_start();
$user = $_SESSION['user_name'];

if(isset($_POST['addcontact'])){
	$email = $_POST['email'];
	$user_data = mysql_query("SELECT * FROM `users` WHERE `username` = '$user'") or die (mysql_error());	
	$friends_list = mysql_fetch_array($user_data);
	$friends_list = $friends_list['friend_list'] . "|" . $email;
	mysql_query("UPDATE `users` SET `friend_list` = '$friends_list' WHERE `username` = '$user'") or die(mysql_error());
	header('Location: members.php');
}
?>