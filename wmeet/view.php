<?php
require_once 'src/Google_Client.php';
require_once 'src/contrib/Google_CalendarService.php';
session_start();
/*

This code is for demonstration purpose and it is registered under the EULA AGREEMENT.

If you wish to see the LIVE demo please visit http://google.wildmedia.ro

E-mail: office@wildmedia.ro

Authors: 
Mihai Alin Diaconu <mihaialin@wildmedia.ro>
Cristian Carp <cristian.carp@wildmedia.ro>

*/

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
  

	$i = 2;
	while ($id = $calList[items][$i][id]) {
		$timezone = $calList[items][$i][timeZone];
		echo "$i. http://www.google.com/calendar/embed?src=$id&ctz=$timezone <br />";
		echo "<iframe src=\"https://www.google.com/calendar/embed?mode=WEEK&wkst=2&amp;height=600&amp;wkst=1&amp;bgcolor=%23FFFFFF&amp;src=$id&amp;color=%232952A3&amp;ctz=$timezone\" style=\" border-width:0 \" width=\"800\" height=\"600\" frameborder=\"0\" scrolling=\"no\"></iframe><br />";
		++$i;
	}
	echo $calList[kind]."<br />";
	echo $calList[items][2][id]."<br />";

	echo "<br /><br />";





$_SESSION['token'] = $client->getAccessToken();
} else {
  $authUrl = $client->createAuthUrl();
  print "<a class='login' href='$authUrl'>Connect Me!</a>";
}