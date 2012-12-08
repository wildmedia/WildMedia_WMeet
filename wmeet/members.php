<?php
include_once'config.php';
if($_SESSION['auth'] == 1)
{}else{
	header('Location: index.php');
	}
$username = $_SESSION['user_name'];
$contacts = mysql_query("SELECT * FROM users WHERE `username` = '$username'") or die (mysql_error());
$contacts = mysql_fetch_array($contacts) or die (mysql_error());
$contacts = $contacts['friend_list'];
$contacts = explode("|",$contacts);
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
	<div id = "body"><div id = "logo"></div><div id = "navigator"><a href = "logout.php" style = "color:white;text-decoration:none;">Logout</a>
		<a href = "view_calendar.php" style = "color:white;text-decoration:none;">| View Appointments</a>
		</div></div>
	<div id = "container">
	<div id = "friend_list">
		<?php
		
		for($i=0;$i<=count($contacts);$i++){
			if($contacts[$i]!=""){
			$attendee = $contacts[$i];	
			echo "<a href = 'makeappointment.php?attendee=$attendee' style = 'color:black;text-decoration:none;'><div id = 'friend'>".$contacts[$i] ."</div></a>";	
			}	
		}
		?>
	</div>
	
	<div id = "right_pannel" style = "padding:5px;">
		Add new contact:</br>
		<form action = "addcontact.php" method = "post">
		<input type = "text" name = "email" value = "email" onfocus="if(this.value == 'email'){this.value = '';}" type="text" onblur="if(this.value == ''){this.value='email';}">
		<input type = "submit" name = "addcontact" value = "Add!" class = "button">
		</form>
		Or import from:<br>
		<?php include_once"GmailConnect.php"; 
		if(isset($_SESSION['contacts_counter'])){
			echo "<br>" . $_SESSION['contacts_counter'] . " friends were added!";
			unset($_SESSION['contacts_counter']);
		}
		?>
		
	</div>
	<div id = "right_pannel" style = "padding:5px;"><br>
		<?php if($_GET['sent'] == 1){
			echo "Your appointment invitation was sent!";
		}else{?>
		You can click on one of your friends and invite him wherever you need him. <br>
		After you invite him, your friend will receive a notification and a SMS with your invite.<br>
		You will be notified when he will accept/decline your invitation<br>
		You can add friends by using the form in the upper right, or import them via Google Contacts!<br>
		<?}?>
		
	</div>
	</div>