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
$attendee = $_GET['attendee'];
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
	<div id = "body"><div id = "logo"></div><div id = "navigator"><a href = "logout.php" style = "color:white;text-decoration:none;">Logout</a><a href = "members.php" style = "color:white;text-decoration:none;"> | HOME</a></div></div>
	
	
	<div id = "container">
	<div id = "friend_list">
		<?php
		
		for($i=0;$i<=count($contacts);$i++){
			if($contacts[$i]!=""){
				
			echo "<div id = 'friend'>".$contacts[$i] . "</div>";	
			}	
		}
		?>
	</div>
	
	<div id = "right_pannel" style = "padding:5px;height:400px;">
		<form action = "event_add.php" method = "post">
		<input type = "text" name = "summary" value = "Summary">
		<input type = "text" name = "location" value = "Location">
		<input type = "text" name = "start_date" value = "yyyy-mm-dd">
		<input type = "text" name = "start_time" value = "hh:mm:ss">
		<input type = "text" name = "end_date" value = "yyyy-mm-dd">
		<input type = "text" name = "end_time" value = "hh:mm:ss">
        <input type = "hidden" name = "attendee" value="<?php echo $_GET['attendee']; ?>" />
		<input type = "submit" name = "event_add" value = "Invite!" class = "button">
		</form>
	</div>

	</div>

