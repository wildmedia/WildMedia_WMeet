<?
/*
This code is for demonstration purpose and it is registered under the EULA AGREEMENT.

If you wish to see the LIVE demo please visit http://google.wildmedia.ro

E-mail: office@wildmedia.ro

Authors: 
Mihai Alin Diaconu <mihaialin@wildmedia.ro>
Cristian Carp <cristian.carp@wildmedia.ro>

*/

function yahoo_login($email_id, $password)
{

$url = "https://login.yahoo.com/config/login?";
$query_string = ".tries=2&.src=ym&.md5=&.hash=&.js=&.last=&promo=&.intl=us&.bypass=";
$query_string .= "&.partner=&.u=4eo6isd23l8r3&.v=0&.challenge=gsMsEcoZP7km3N3NeI4mX";
$query_string .= "kGB7zMV&.yplus=&.emailCode=&pkg=&stepid=&.ev=&hasMsgr=1&.chkP=Y&.";
$query_string .= "done=http%3A%2F%2Fmail.yahoo.com&login=$email_id&passwd=$password";
$url_login = $url . $query_string;


//  Execute Curl For Login
$ch = curl_init();
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($ch, CURLOPT_URL, $url_login);
curl_setopt($ch, CURLOPT_HTTPAUTH, CURLAUTH_ANY);
curl_setopt ($ch, CURLOPT_COOKIEJAR, ‘cookie.txt’);
curl_setopt($ch, CURLOPT_HEADER , 1);
ob_start();
$response = curl_exec ($ch);
ob_end_clean();
curl_close ($ch);
unset($ch);
//  End Execute Curl For Login

//  Call Address Book Page Through Curl
$url_addressbook = "http://address.yahoo.com/yab/us";
$ch = curl_init();
curl_setopt($ch, CURLOPT_RETURNTRANSFER,1);
curl_setopt($ch, CURLOPT_COOKIEFILE, “cookie.txt”);
curl_setopt($ch, CURLOPT_HEADER , 1);
curl_setopt($ch, CURLOPT_URL, $url_addressbook);
$result = curl_exec ($ch);
curl_close ($ch);
unset($ch);
//  End Call Address Book Page Through Curl

//  Manuplate String
$result = preg_replace("([\r\n\t])"," ",$result);
$result = strip_tags($result);
$arr_result = explode("[", $result);
$arr_result = explode("{",$arr_result[2]);

$arr_filter = array();
for($i=0; $i<sizeof($arr_result); $i++)
{
if(strpos($arr_result[$i], "@") > 0 && strpos($arr_result[$i], ".") > 0)
{
if(!in_array($arr_result[$i], $arr_filter, TRUE))
$arr_filter[] = $arr_result[$i];
}
}
//  End Manuplate String

//  Return Result Array
return $arr_filter;
//  End Return Result Array
}
$res = yahoo_login("","");
var_dump($res);
?>