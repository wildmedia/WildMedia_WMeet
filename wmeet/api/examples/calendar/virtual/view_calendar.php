<?php
require_once '../../src/Google_Client.php';
require_once '../../src/contrib/Google_CalendarService.php';
session_start();


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
	
	$calid = 'crys@adevar.net';
	$events = $cal->events->listEvents($calid);

	// title, start, end
	// title: 'Lunch',
	// start: new Date(y, m, d, 12, 0),
	// end: new Date(y, m, d, 14, 0),
	
	//
	
	/*
	echo $events[items][0][id] . "<br />";
	echo $events[items][0][summary] . "<br />"; 
	echo $events[items][0][organizer][email] . "<br />";
	echo $events[items][0][start][dateTime]. "<br />";
	echo $events[items][0][end][dateTime] . "<br />";
	$events[items][0][attendees][displayName];
	// $calList[items][0][kind]
	
	print "<pre>".print_r($events,true)."</pre>";
	*/
	
	
	
	
	
	//  [start] => Array ( [dateTime] => 2012-12-08T11:30:00+02:00 ) [end] => Array ( [dateTime] => 2012-12-08T12:30:00+02:00 
	
	
  //$jsrc = "https://ajax.googleapis.com/ajax/services/search/images?v=1.0&q=test";
    //$jsrc = $calList;
	//$json = file_get_contents($jsrc);
//	$jset = json_decode($calList, true);
// <iframe src="https://www.google.com/calendar/embed?height=600&amp;wkst=1&amp;bgcolor=%23FFFFFF&amp;src=adevar.net_nicft0cal0un7flm3q8qm14l70%40group.calendar.google.com&amp;color=%232952A3&amp;ctz=Europe%2FBucharest" style=" border-width:0 " width="800" height="600" frameborder="0" scrolling="no"></iframe>
// 

	/*
	$i = 2;
	while ($id = $calList[items][$i][id]) {
		$timezone = $calList[items][$i][timeZone];
		echo "$i. http://www.google.com/calendar/embed?src=$id&ctz=$timezone <br />";
		echo "<iframe src=\"https://www.google.com/calendar/embed?mode=WEEK&wkst=2&amp;height=600&amp;wkst=1&amp;bgcolor=%23FFFFFF&amp;src=$id&amp;color=%232952A3&amp;ctz=$timezone\" style=\" border-width:0 \" width=\"800\" height=\"600\" frameborder=\"0\" scrolling=\"no\"></iframe><br />";
		++$i;
	}
	echo $calList[kind]."<br />";
	echo $calList[items][0][kind]."<br />";
	
	*/
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
				{
					title: 'All Day Event',
					start: new Date(y, m, 1)
				},
				{
					title: 'Long Event',
					start: new Date(y, m, d-5),
					end: new Date(y, m, d-2)
				},
				{
					id: 999,
					title: 'Repeating Event',
					start: new Date(y, m, d-3, 16, 0),
					allDay: false
				},
				{
					id: 999,
					title: 'Repeating Event',
					start: new Date(y, m, d+4, 16, 0),
					allDay: false
				},
				{
					title: 'Meeting',
					start: new Date(y, m, d+4, 7, 30),
					end: new Date(y, m, d+4, 8, 0),
					allDay: false
				},
				{
					title: 'Lunch',
					start: new Date(y, m, d+4, 20, 0),
					end: new Date(y, m, d+4, 21, 0),
					allDay: false
				},
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
					while (($events[items][$i]) && ($i < 1)) {
						$title = $events[items][$i][summary];
						$start = $events[items][$i][start][dateTime]; //[dateTime] => 2012-12-10T19:00:00+02:00
						$end = $events[items][$i][end][dateTime]; // [dateTime] => 2012-12-10T19:25:00+02:00 length = 24
						
						$start_y = substr($start, 0,-21);
						$start_m = int(substr($start, 5,-18));
						$start_d = substr($start, 8,-15);
						//$start_d = ltrim($start_d, '0');
						$start_hr = substr($start, 11, -12);
						$start_min = substr($start, 14, -9);
						
						$end_y = substr($end, 0,-21);
						$end_m = substr($end, 5,-18);
						$end_d = substr($end, 8,-15);
						//$end_d = ltrim($end_d, '0');
						$end_hr = substr($end, 11, -12);
						$end_min = substr($end, 14, -9);
						
						echo "
						{
						title: '$title',
						start: new Date($start_y, $start_m, $start_d, $start_hr, $start_min),
						end: new Date($end_y, $end_m, $end_d, $end_hr, $end_min),
						allDay: false
						},
						";
						$i++;
					}
						
				
				?>
				
				{
					title: '<?=$test; ?>',
					start: new Date(y, m, d+3, 14, 0),
					end: new Date(y, m, d+3, 16, 0),
					allDay: false
				},
				{
					title: 'Birthday Party',
					start: new Date(y, m, d+1, 19, 0),
					end: new Date(y, m, d+1, 22, 30),
					allDay: false
				},
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

<?php
echo "
							{
							title: '$title',
							start: new Date($start_y, $start_m, $start_d, $start_hr, $start_min),
							end: new Date($end_y, $end_m, $end_d, $end_hr, $end_min),
							allDay: false
							},
							";

?>
</body>
</html>

