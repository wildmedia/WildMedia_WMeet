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
//$events = new Google_EventsServiceResource($client);

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
	$events = $cal->events->listEvents('crys@adevar.net');
	
	echo $events[items][0][id] . "<br />";
	echo $events[items][0][summary] . "<br />"; 
	echo $events[items][0][organizer][email] . "<br />";
	echo $events[items][0][start][dateTime]. "<br />";
	echo $events[items][0][end][dateTime] . "<br />";
	
	// $calList[items][0][kind]
	
	print "<pre>".print_r($events,true)."</pre>";
	
	
	// title, start, end
	// title: 'Lunch',
	// start: new Date(y, m, d, 12, 0),
	// end: new Date(y, m, d, 14, 0),
	
	
	
	//  [start] => Array ( [dateTime] => 2012-12-08T11:30:00+02:00 ) [end] => Array ( [dateTime] => 2012-12-08T12:30:00+02:00 
	
	
  //$jsrc = "https://ajax.googleapis.com/ajax/services/search/images?v=1.0&q=test";
    //$jsrc = $calList;
	//$json = file_get_contents($jsrc);
//	$jset = json_decode($calList, true);
// <iframe src="https://www.google.com/calendar/embed?height=600&amp;wkst=1&amp;bgcolor=%23FFFFFF&amp;src=adevar.net_nicft0cal0un7flm3q8qm14l70%40group.calendar.google.com&amp;color=%232952A3&amp;ctz=Europe%2FBucharest" style=" border-width:0 " width="800" height="600" frameborder="0" scrolling="no"></iframe>
// 


	$i = 2;
	while ($id = $calList[items][$i][id]) {
		$timezone = $calList[items][$i][timeZone];
		echo "$i. http://www.google.com/calendar/embed?src=$id&ctz=$timezone <br />";
		echo "<iframe src=\"https://www.google.com/calendar/embed?mode=WEEK&wkst=2&amp;height=600&amp;wkst=1&amp;bgcolor=%23FFFFFF&amp;src=$id&amp;color=%232952A3&amp;ctz=$timezone\" style=\" border-width:0 \" width=\"800\" height=\"600\" frameborder=\"0\" scrolling=\"no\"></iframe><br />";
		++$i;
	}
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


  //print "<h1>Calendar List</h1><pre>" . print_r($calList, true) . "</pre>";


$_SESSION['token'] = $client->getAccessToken();
} else {
  $authUrl = $client->createAuthUrl();
  print "<a class='login' href='$authUrl'>Connect Me!</a>";
}