<?php
$BOT_TOKEN = "6033413619:AAG5Nolan9xSh9N6q3e88IkGEyQbu74lVxE";

$update = file_get_contents('php://input');
$update = json_decode($update,true);
$userChatId = $update['message']['from']['id']?$update['message']['from']['id']:null;

if($userChatId){
    $userMessage = $update['message']['text']?$update['message']['text']:'Mr';
    $firstName = $update['message']['from']['first_name']?$update['message']['from']['first_name']:'';
    $lastName = $update['message']['from']['last_name']?$update['message']['from']['last_name']:'';
    $fullName = $firstName." ".$lastName;
    $replyMsg = "Hello ".$fullName."\n".$userMessage;


    $paramaters = array(
        "chat_id" =>$userChatId,
        "text" =>$replyMsg,
        "perseMode" => "html"
  );
  send("sendMessage",$paramaters);
}

function send($method,$data){
    global $BOT_TOKEN;
    $url = "https://api.telegram.org/bot$BOT_TOKEN/$method";

    if(!$curld = curl_init()){
        exit;   
    }

    curl_setopt($curld,CURLOPT_POST,true);
    curl_setopt($curld,CURLOPT_POSTFIELDS,$data);
    curl_setopt($curld,CURLOPT_URL,$url);
    curl_setopt($curld,CURLOPT_RETURNTRANSFER,true);
    $output = curl_exec($curld);
    curl_close($curld);
    return $output;
}

?>