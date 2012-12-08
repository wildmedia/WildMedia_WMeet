<?php
require_once 'src/Google_Client.php';
require_once 'src/contrib/Google_CalendarService.php';
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
 
	
	$email1 = trim($_POST['attendee']);
	$summary = $_POST['summary'];
	$location = $_POST['location'];
	$datestart = trim($_POST['start_date']);
	$timestart = trim($_POST['start_time']);
	$dateend = trim($_POST['end_date']);
	$timeend = trim($_POST['end_time']);
	$email2 = $_SESSION['user_email'];
	
	
	$final_date = $datestart."T".$timestart.".000-02:00";
	$end_date = $dateend."T".$timeend.".000-02:00";
	
	
	
	$event = new Google_Event();
	$event->sendNotifications = true;
	$reminder = new Google_EventReminder();
	$reminder->method = 'email';
	$event->setSummary($summary);
	$event->setLocation($location);
	$start = new Google_EventDateTime();
	$start->setDateTime($final_date); // 2012-12-17T10:00:00.000-07:00
	$event->setStart($start);
	$end = new Google_EventDateTime();
	$end->setDateTime($end_date); // 2012-12-17T10:25:00.000-07:00
	$event->setEnd($end);
	$attendee1 = new Google_EventAttendee();
	//$attendee2 = new Google_EventAttendee();
	$attendee1->setEmail($email1);
	$attendee1->setResponseStatus("needsAction");
	
	
	
	
	$calid =  $calList[items][2][id];

$attendees = array($attendee1
                  );
$event->attendees = $attendees;

//$cal->events->
$optParams = array('sendNotifications' => true);

//echo $_SESSION['calid'];
$createdEvent = $cal->events->insert($calid,$event,$optParams);

echo "<meta http-equiv='refresh' content=\"0;URL='http://google.wildmedia.ro/members.php?sent=1'\">";



$_SESSION['token'] = $client->getAccessToken();
} else {
  $authUrl = $client->createAuthUrl();
  print "<a class='login' href='$authUrl'>Connect Me!</a>";
}