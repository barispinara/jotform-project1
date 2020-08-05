<?php
include "command.php";
include_once "Storage.php";
include "create_form.php";

$token = "1296708550:AAFcfS9g3UdqNM6jazSNQbVnVR8v85364uY";
$website = "https://api.telegram.org/bot".$token;
$web = "https://api.telegram.org/file/bot".$token;
$update = file_get_contents('php://input');
$update = json_decode($update , TRUE);
$chatID = $update['message']['from']['id'];
$firstname = $update['message']['from']['first_name'];
$username = $update['message']['from']['username'];
$text = $update['message']['text'];

function sendMessage($chatID , $text){
    $url = $GLOBALS[website]."/sendMessage?chat_id=$chatID&text=".urlencode($text);
    file_get_contents($url);
}

$command = new command();
$cache = new Storage();
$form = new form();

sendMessage($chatID, $command->commandlist($text));

if(empty($cache->getFormInfo())){
    if($cache->getInfo() == "/create_form"){
    $cache->Form_progress($text);
    $form->create_form($text);
    
    }
}
if(!empty($cache->getFormInfo()) && $text != "/end"){
    sendMessage($chatID, "What do you want in your form ");
    sendMessage($chatID, "1-) Full Name Field");
    sendMessage($chatID, "2-) Email Field");
    sendMessage($chatID, "3-) Address Field");
    sendMessage($chatID, "4-) Phone Number Field");
    $form->field($text);
}
if($text == "/create_form"){
    $cache->Start();
    $cache->progress($text);
}

if($text == "/end"){
    $cache->End();
    $form->field($text);
    sendMessage($chatID, "Form created succesfully");
}


?>



