<?php
require_once '../../src/Google_Client.php';
require_once '../../src/contrib/Google_CalendarService.php';
session_start();

$client = new Google_Client();
$client->setApplicationName("Google Calendar PHP Starter Application");


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
  
	echo $calList[kind]."<br />";
	echo $calList[items][0][kind]."<br />";
	

	
	echo "<br /><br />";


  print "<h1>Calendar List</h1><pre>" . print_r($calList, true) . "</pre>";


$_SESSION['token'] = $client->getAccessToken();
} else {
  $authUrl = $client->createAuthUrl();
  print "<a class='login' href='$authUrl'>Connect Me!</a>";
}






$calendar = new Google_Calendar();
$calendar->setSummary('Test summary');
$calendar->setTimeZone('America/Los_Angeles');



$createdCalendar = $cal->calendars->insert($calendar);

echo $createdCalendar->getId();
