<?php
session_start();
?>
<!--
This code is for demonstration purpose and it is registered under the EULA AGREEMENT.

If you wish to see the LIVE demo please visit http://google.wildmedia.ro

E-mail: office@wildmedia.ro

Authors: 
Mihai Alin Diaconu <mihaialin@wildmedia.ro>
Cristian Carp <cristian.carp@wildmedia.ro>

-->


<!DOCTYPE html>
<html manifest="offline.appcache">
<head>
<meta charset="UTF-8" />
<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
<link rel="stylesheet" type="text/css" href="style/style.css?v=8211289" />	
<title>WMeet</title>
</head>
<body>
	<div id = "body"><div id = "logo"></div><div id = "navigator"></div></div>
	<div id = "container">
	<div id = "header">
	Welcome to WMeet! With use it will be a lot easy for you to meet your buddies!<br/>
	</div>
	
	<div id = "left_pannel">
	<form action = "login.php" method = "post">
		<input type = "text" name = "username" value = "username" onfocus="if(this.value == 'username'){this.value = '';}" type="text" onblur="if(this.value == ''){this.value='username';}"><br/>
		<input type = "password" name = "password" value = "password" onfocus="if(this.value == 'password'){this.value = '';}" type="text" onblur="if(this.value == ''){this.value='password';}" ><br/>
		<input type = "submit" name = "login" value = "Login!" class = "button"><br/>
	</form>
	</div>
	
	<div id = "right_pannel">
	<form action = "register.php" method = "post">
		<input type = "text" name = "username" value = "username" onfocus="if(this.value == 'username'){this.value = '';}" type="text" onblur="if(this.value == ''){this.value='username';}"><br/>
		<input type = "password" name = "password" value = "password" onfocus="if(this.value == 'password'){this.value = '';}" type="text" onblur="if(this.value == ''){this.value='password';}"><br/>
		<input type = "password" name = "password2" value = "password" onfocus="if(this.value == 'password'){this.value = '';}" type="text" onblur="if(this.value == ''){this.value='password';}"><br/>
		<input type = "text" name = "email" value = "email" onfocus="if(this.value == 'email'){this.value = '';}" type="text" onblur="if(this.value == ''){this.value='email';}"><br/>
		<input type = "submit" name = "register" value = "Register!" class = "button"><br/>
	</form>
	</div>

</div>
</body>
</html>