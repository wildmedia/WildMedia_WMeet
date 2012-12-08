<?php
require_once '../../src/Google_Client.php';
require_once '../../src/contrib/Google_CalendarService.php';
session_start();

echo "
<p>Make appointment []<br />
  View appointments/day agenda []<br />
  Publish appointment []<br />
  View calendar[]<br />
  Add calendar[]
</p>
";

$client = new Google_Client();
$client->setApplicationName("Google Calendar PHP Starter Application");

// Visit https://code.google.com/apis/console?api=calendar to generate your
// client id, client secret, and to register your redirect uri.
$client->setClientId('147602344817.apps.googleusercontent.com');
$client->setClientSecret('WkbQNRYCEKiRQydgQd3lpxCX');
$client->setRedirectUri('http://google.wildmedia.ro/api/examples/calendar/simple.php');
$client->setDeveloperKey('AIzaSyAlLzK1Lf3bMuvrby7sfWYZPAWS2DSIZ0Y');
$cal = new Google_CalendarService($client);
if (isset($_GET['logout'])) {
  unset($_SESSION['token']);
}

if (isset($_GET['code'])) {
  $client->authenticate($_GET['code']);
  $_SESSION['token'] = $client->getAccessToken();
  header('Location: http://' . $_SERVER['HTTP_HOST'] . $_SERVER['PHP_SELF']);
}

if (isset($_SESSION['token'])) {
  $client->setAccessToken($_SESSION['token']);
}

if ($client->getAccessToken()) {
  $calList = $cal->calendarList->listCalendarList();
  //$jsrc = "https://ajax.googleapis.com/ajax/services/search/images?v=1.0&q=test";
    //$jsrc = $calList;
	//$json = file_get_contents($jsrc);
//	$jset = json_decode($calList, true);
	echo $calList[kind]."<br />";
	echo $calList[items][0][kind]."<br />";
	
	// page to calendar:
	// http://www.google.com/calendar/embed?src=adevar.net_86a0q7t2bi53qq7nageu05ohg4%40group.calendar.google.com&ctz=Europe/Bucharest 
	//
	// adevar.net_86a0q7t2bi53qq7nageu05ohg4@group.calendar.google.com
	//
	// $id = $calList[items][n][id]
	// $timezone = $calList[items][n][timeZone]
	// http://www.google.com/calendar/embed?src=$id&ctz=$timezone
	// url for embed / iframe / calendar
	
	echo "<br /><br />";


  print "<h1>Calendar List</h1><pre>" . print_r($calList, true) . "</pre>";


$_SESSION['token'] = $client->getAccessToken();
} else {
  $authUrl = $client->createAuthUrl();
  print "<a class='login' href='$authUrl'>Connect Me!</a>";
}