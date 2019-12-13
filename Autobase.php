<?php
ini_set('display_errors', 1);
require_once('TwitterAPIExchange.php');

/** Ambil data hari : https://developer.twitter.com/en/apps **/
$settings = array(
'oauth_access_token' => 1203869204262211584-embZ96Jo9zO4rYBc5RJfdUJ21PZKRZ
'oauth_access_token_secret' => 1UT5O5LbHttGzQTeckEpHw4bp55aegbuOBjSRSiWlpJHF
'consumer_key' => xIX6S3M5L0t4xrHK01E2BkqNk
'consumer_secret' => ekm7zhMWKeaRP7KqDMWjOynuHRk5QHOIcLP4ZYUrXH64zMhUrW
);

$url = 'https://api.twitter.com/1.1/direct_messages/events/list.json';
$getfield = '';
$requestMethod = 'GET';
$twitter = new TwitterAPIExchange($settings);
$data = $twitter->setGetfield($getfield)
->buildOauth($url, $requestMethod)
->performRequest();

$someObject = json_decode($data);
foreach ($someObject->events as $item) {
if( strpos($item->message_create->message_data->text, '/rmf') !== false) {
ngetweet($item->message_create->message_data->text);
}
}

function ngetweet($kata) {
/** URL for REST request, see: https://dev.twitter.com/docs/api/1.1/ **/
$url = 'https://api.twitter.com/1.1/statuses/update.json';
$requestMethod = 'POST';

$postfields = array(
'status' => $kata
);

$twitter = new TwitterAPIExchange($GLOBALS['settings']);
echo $twitter->buildOauth($url, $requestMethod)
->setPostfields($postfields)
->performRequest();
}
?>
