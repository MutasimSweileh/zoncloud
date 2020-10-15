<?php
//Code to verify the website
$verify_token = $_GET['hub_verify_token'];
if (isset($verify_token)) {
 $challenge = $_GET['hub_challenge'];
 if ($verify_token == "verification_token") {
 print $challenge;
 } elseif ($verify_token != "verification_token") {
 print 'Error, wrong validation token';
 }
}
//Code to process requests
$postData = file_get_contents('php://input');
$postData = preg_replace('/"id":(\d+)/', '"id":"$1"', $postData); //Important - to prevent ID becoming a float
if(getMessage($postData)){
sendMessage(getSender($postData), "Echo: ".getMessage($postData));
}
function getMessage($input){
 $postdata = json_decode($input);
 return $postdata->entry[0]->messaging[0]->message->text;
}
function getSender($input){
 $postdata = json_decode($input);
 return $postdata->entry[0]->messaging[0]->sender->id;
}
function sendMessage($recipient, $textMessage) {
$token = "EAAL0MnaIZA84BAL6yIEOdznd6gG3DzlIiVI75OpZC3efh8zqZAChr4qmxfV7OAiKT9eoZAzqJUnEAbUBUJQKVz7HVjpx07DH1PREVfIOoEyNl8yoPH0gsbttvbjOy9QQD5c9xorb6Lo6hHBRtGZCDmCxF10HeJYu4kRXKki98M1Yx55OZBCoaZAFgltNfohdkEZD";
 $token = "EAADMj9IjR5IBAECTZAZCHzMcSh7rR0Vf6DfZB3v6Kj0PeKuLSlmib4wNAOKQYyV8vGwaFyEHyIOfGgHzW6fPwW1kYXWwZBFkTBG5zFe0kUaG4rLjp9A2SuBcjOkeEq5ZAlamAjKyASTBZAyJEcZCXvv3YZB3JByujxfKQFGTm0ZAPfJXJSJZAhnLb7A5fXDffaJlVYmqLltOM73tztZCY57TaDm";
 $json = '{
 "recipient":{"id":"' . $recipient . '"},
 "message":{
 "text":"' . $textMessage . '"
 }
}';
$options = array(
 'http' => array(
 'method' => 'POST',
 'content' => $json,
 'header' => "Content-Type: application/json\r\n" .
 "Accept: application/json\r\n"
 )
 );

 $url = 'https://graph.facebook.com/v2.6/me/messages?access_token=' . $token;
 $context = stream_context_create($options);
 $result = file_get_contents($url, false, $context);
 return $json;
}
