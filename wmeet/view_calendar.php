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
	
	$calid =  $calList[items][2][id];
	if ($calid) 
		$test=1;
	else
		$calid = $calList[items][1][id];

	if ($calid) 
		$test=1;
	else
		$calid = $calList[items][0][id];
		
	$events = $cal->events->listEvents($calid);

	

  //print "<h1>Calendar List</h1><pre>" . print_r($calList, true) . "</pre>";


$_SESSION['token'] = $client->getAccessToken();
} else {
  $authUrl = $client->createAuthUrl();
  print "<a class='login' href='$authUrl'>Connect Me!</a>";
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html>
<head>
<link rel='stylesheet' type='text/css' href='fullcalendar/fullcalendar.css' />
<link rel='stylesheet' type='text/css' href='fullcalendar/fullcalendar.print.css' media='print' />
<script type='text/javascript' src='jquery/jquery-1.8.1.min.js'></script>
<script type='text/javascript' src='jquery/jquery-ui-1.8.23.custom.min.js'></script>
<script type='text/javascript' src='fullcalendar/fullcalendar.min.js'></script>

<?php

$test = 'Congrats bastard';
?>
<script type='text/javascript'>

	$(document).ready(function() {
	
		var date = new Date();
		var d = date.getDate();
		var m = date.getMonth();
		var y = date.getFullYear();
		//alert(d);
		var calendar = $('#calendar').fullCalendar({
			header: {
				left: 'prev,next today',
				center: 'title',
				right: 'month,agendaWeek,agendaDay'
			},
			selectable: true,
			selectHelper: true,
			select: function(start, end, allDay) {
				var title = prompt('Event Title:');
				if (title) {
					calendar.fullCalendar('renderEvent',
						{
							title: title,
							start: start,
							end: end,
							allDay: allDay
						},
						true // make the event "stick"
					);
				}
				calendar.fullCalendar('unselect');
			},
			editable: true,
			events: [
				<?
					/*echo "
					{
					title: 'Pana mea',
					start: new Date(y, m, d, 16, 0),
					end: new Date(y, m, d, 20, 0),
					allDay: false
					},
					";*/
					
					$i = 0;
					while (($events[items][$i])) {
						$title = $events[items][$i][summary];
						$start = $events[items][$i][start][dateTime]; //[dateTime] => 2012-12-10T19:00:00+02:00
						$end = $events[items][$i][end][dateTime]; // [dateTime] => 2012-12-10T19:25:00+02:00 length = 24
						
						$start_y = substr($start, 0,-21);
						$start_m = substr($start, 5,-18);
						$start_d = substr($start, 8,-15);
						$start_d = ltrim($start_d, '0');
						$start_hr = substr($start, 11, -12);
						$start_min = substr($start, 14, -9);
						
						$end_y = substr($end, 0,-21);
						$end_m = substr($end, 5,-18);
						$end_d = substr($end, 8,-15);
						$end_d = ltrim($end_d, '0');
						$end_hr = substr($end, 11, -12);
						$end_min = substr($end, 14, -9);
						
						$day = date('d');
						$month = date('m');
						
					    $n_s1 = $start_m - $month;
						$n_e1 = $end_m - $month;
						
						$m_s1 = $start_d - $day;
						$m_e2 = $end_d - $day;
						
						echo "
						{
						title: '$title',
						start: new Date(y, m+$n_s1, d+$m_s1, $start_hr, $start_min),
						end: new Date(y, m+$n_e1, d+$m_e2, $end_hr, $end_min),
						allDay: false
						},
						";
						$i++;
					}
						
				
				?>
				{
					title: 'Click for Google',
					start: new Date(y, m, 28),
					end: new Date(y, m, 29),
					url: 'http://google.com/'
				}
			]
		});
		
	});

</script>
<style type='text/css'>

	body {
		margin-top: 40px;
		text-align: center;
		font-size: 14px;
		font-family: "Lucida Grande",Helvetica,Arial,Verdana,sans-serif;
		}

	#calendar {
		width: 900px;
		margin: 0 auto;
		}

</style>
</head>
<body>
<div id='calendar'></div>


</body>
</html>

