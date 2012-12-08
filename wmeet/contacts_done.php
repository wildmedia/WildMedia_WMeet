<?php
include_once 'GmailOath.php';
include_once 'Config.php';
include_once 'config.php';
session_start();
$oauth =new GmailOath($consumer_key, $consumer_secret, $argarray, $debug, $callback);
$getcontact_access=new GmailGetContacts();
$request_token=$oauth->rfc3986_decode($_GET['oauth_token']);
$request_token_secret=$oauth->rfc3986_decode($_SESSION['oauth_token_secret']);
$oauth_verifier= $oauth->rfc3986_decode($_GET['oauth_verifier']);
$contact_access = $getcontact_access->get_access_token($oauth,$request_token, $request_token_secret,$oauth_verifier, false, true, true);
$access_token=$oauth->rfc3986_decode($contact_access['oauth_token']);
$access_token_secret=$oauth->rfc3986_decode($contact_access['oauth_token_secret']);
$contacts= $getcontact_access->GetContacts($oauth, $access_token, $access_token_secret, false, true,$emails_count);
//Email Contacts 
foreach($contacts as $k => $a)
{
$final = end($contacts[$k]);
foreach($final as $email)
{
	if($email['address']!=''){
		$friends_string = $friends_string . "|" . $email["address"];
		$counter++;
	}
 }
$friends_list = $_SESSION['user_friend_list']."|".$friends_string;
$user = $_SESSION['user_name'];
$_SESSION['contacts_counter'] = $counter;
mysql_query("UPDATE `users` SET `friend_list` = '$friends_list' WHERE `username` = '$user'") or die(mysql_error());
header('Location: members.php');
}?>