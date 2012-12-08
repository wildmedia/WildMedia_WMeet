<?php
include_once'config.php';
if($_SESSION['auth'] == 1)
{}else{
	header('Location: index.php');
	}
echo "Hello, " . $_SESSION['user_name'] . "!";
//include_once"GmailConnect.php";
echo "</br>";
$username = $_SESSION['user_name'];
$contacts = mysql_query("SELECT * FROM users WHERE `username` = '$username'") or die (mysql_error());
$contacts = mysql_fetch_array($contacts) or die (mysql_error());
$contacts = $contacts['friend_list'];
$contacts = explode("|",$contacts);
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
	<div id = "body"><div id = "navigator"></div></div>
	<div id = "container">
		Here is your list of friends, you can also invite others.
	<div id = "friend_list">
		<?php
		for($i=0;$i<=count($contacts);$i++){
			if($contacts[$i]!=""){
			echo $contacts[$i] . "</br>";	
			}	
		}
		?>
	</div>
	</div>