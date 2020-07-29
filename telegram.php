<?php
include "D:\Jotform\Project 1 (Whatsapp)/JotForm.php";
$jotformAPI = new JotForm("API KEY");

$submissions = $jotformAPI->getFormSubmissions("FORM ID");


function telegram($msg) {
    global $telegrambot,$telegramchatid;
    $url='https://api.telegram.org/bot'.$telegrambot.'/sendMessage';$data=array('chat_id'=>$telegramchatid,'text'=>$msg);
    $options=array('http'=>array('method'=>'POST','header'=>"Content-Type:application/x-www-form-urlencoded\r\n",'content'=>http_build_query($data),),);
    $context=stream_context_create($options);
    $result=file_get_contents($url,false,$context);
    return $result;
}


$telegrambot= 'Telegram-BOT-ID';
$telegramchatid=-Chat-ID;

echo "Name ".$submissions[0]["answers"][4]["answer"]["first"];
echo "\n";
echo "Surname ".$submissions[0]["answers"][4]["answer"]["last"];
echo "\n";
echo "Email ".$submissions[0]["answers"][5]["answer"];
echo "\n";
echo "Phone Number ".$submissions[0]["answers"][6]["answer"]["area"];
echo " ".$submissions[0]["answers"][6]["answer"]["phone"];

telegram("new form submission has been received");
telegram("Name ".$submissions[0]["answers"][4]["answer"]["first"]);
telegram("Surname ".$submissions[0]["answers"][4]["answer"]["last"]);
telegram("Email ".$submissions[0]["answers"][5]["answer"]);
telegram("Phone Number ".$submissions[0]["answers"][6]["answer"]["area"]." ".$submissions[0]["answers"][6]["answer"]["phone"])

?>
