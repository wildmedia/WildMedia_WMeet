<?php
include_once'config.php';
if(isset($_POST['register'])){
	$username = $_POST['username'];
	$password = md5($_POST['password']);
	$password2 = md5($_POST['password2']);
	$email = $_POST['email'];
	if($password != $password2){
		$_SESSION['register_report'] = "Passwords do not match!";
		header('Location: index.php');
	}else{
		mysql_query("INSERT INTO `users` VALUES ('','$username','$password','$email','')") or die('WOOPS!');
		header('Location: simple.php?first_contact=true');
	}
}
?>