<?php
include "command.php";
include_once "Storage.php";
include "create_form.php";


/* DENEME DENEME DENEME */
/* basic connection part on telegram 
$update is main part of the connection on telegram
*/
$token = "BOT TOKEN";
$website = "https://api.telegram.org/bot".$token;
$web = "https://api.telegram.org/file/bot".$token;
$update = file_get_contents('php://input');
$update = json_decode($update , TRUE);
$chatID = $update['message']['from']['id'];
$firstname = $update['message']['from']['first_name'];
$username = $update['message']['from']['username'];
$text = $update['message']['text'];

/* Send Message function which is coming from api.telegram */
function sendMessage($chatID , $text){
    $url = "https://api.telegram.org/bot1296708550:AAFcfS9g3UdqNM6jazSNQbVnVR8v85364uY/sendMessage?chat_id=".$chatID."&text=".urlencode($text);
    file_get_contents($url);
}

$command = new command();
$cache = new Storage();


sendMessage($chatID, $command->commandlist($text));

/* if create_form.txt is empty thats mean user doesn't give Title of form so with this if clause bot will wait 
to respond for title */
if(empty($cache->getFormInfo())){
    if($cache->getInfo() == "/create_form"){
    $cache->Form_progress($text);

    }
}
/* if create_form.txt is not empty thats mean user gave title of form so this if clause triggers steps of createForm 
if user type '/end' then createForm questions will stop and bot will create from */
if(!empty($cache->getFormInfo()) && $text != "/end"){
    sendMessage($chatID, "What do you want in your form \r\n1-) Full Name Field \r\n2-) Email Field \r\n3-) Address Field \r\n4-) Phone Number Field \r\n Type '/end' for stop ");
    $cache->Form_progress($text);

}
/* This project have 2 txt file, cache.txt and create_form.txt when user type '/create_form' cache.txt is saving this type for 
starting create_form.php*/
if($text == "/create_form"){
    $cache->Start();
    $cache->progress($text);
}

/* Normally '/end' command should be in command.php it will be added when some steps are completed 
when user type '/end' cache files are deleted and create_form() which is comming from create_form.php method  starts */
if($text == "/end"){
    sendMessage($chatID , create_form());
    $cache->End();
    sendMessage($chatID, "Form created succesfully");
}


?>



