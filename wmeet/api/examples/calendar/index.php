<?php
session_start();
?>

<!DOCTYPE html>
<html manifest="offline.appcache">
<head>
<meta charset="UTF-8" />
<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
<link rel="stylesheet" type="text/css" href="style/style.css?v=8211289" />	
<title>WMeet</title>
</head>
<body>
	<div id = "container">
	Welcome to WMeet! With use it will be a lot easy for you to meet your buddies!<br/>
	
	Login!
	<form action = "login.php" method = "post">
		<input type = "text" name = "username" value = "password">
		<input type = "password" name = "password" value = "password">
		<input type = "submit" name = "login" value = "Login!">
	</form>
	
	Register!
	<form action = "register.php" method = "post">
		<input type = "text" name = "username" value = "username">
		<input type = "password" name = "password" value = "password">
		<input type = "password" name = "password2" value = "password">
		<input type = "text" name = "email" value = "email">
		<input type = "submit" name = "register" value = "Register!">
	</form>
<?php echo $_SESSION['login_attempt'];?>
</div>
</body>
</html>