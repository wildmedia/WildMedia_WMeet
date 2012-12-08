<?php
require_once '../../src/Google_Client.php';
require_once '../../src/contrib/Google_CalendarService.php';
session_start();


// VIEW calendars

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
// <iframe src="https://www.google.com/calendar/embed?height=600&amp;wkst=1&amp;bgcolor=%23FFFFFF&amp;src=adevar.net_nicft0cal0un7flm3q8qm14l70%40group.calendar.google.com&amp;color=%232952A3&amp;ctz=Europe%2FBucharest" style=" border-width:0 " width="800" height="600" frameborder="0" scrolling="no"></iframe>
// 


	$event = new Google_Event();
	$event->sendNotifications = true;
	$reminder = new Google_EventReminder();
	$reminder->method = 'email';
	$event->setSummary('Intalnire de urgenta');
	$event->setLocation('Regie, P18');
	$start = new Google_EventDateTime();
	$start->setDateTime('2012-12-17T10:00:00.000-07:00');
	$event->setStart($start);
	$end = new Google_EventDateTime();
	$end->setDateTime('2012-12-17T10:25:00.000-07:00');
	$event->setEnd($end);
	$attendee1 = new Google_EventAttendee();
	$attendee2 = new Google_EventAttendee();
	$attendee1->setEmail('mihaialin@wildmedia.ro');
	$attendee1->setResponseStatus("needsAction");
	$attendee2->setEmail('cristian.carp@wildmedia.ro');
	$attendee2->setResponseStatus("needsAction");
// ...
$attendees = array($attendee1,
                  $attendee2
                  );
$event->attendees = $attendees;

//$notif = boolean;
$notif = True;

//$cal->events->
$optParams = array('sendNotifications' => true);


$createdEvent = $cal->events->insert('crys@adevar.net', $event,$optParams);

echo $createdEvent->getId();
	
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


  //print "<h1>Calendar List</h1><pre>" . print_r($calList, true) . "</pre>";


$_SESSION['token'] = $client->getAccessToken();
} else {
  $authUrl = $client->createAuthUrl();
  print "<a class='login' href='$authUrl'>Connect Me!</a>";
}