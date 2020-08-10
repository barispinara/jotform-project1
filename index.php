<?php
include "command.php";
include_once "Storage.php";
include "create_form.php";
include "submission.php";

/* basic connection part on telegram 
$update is main part of the connection on telegram
*/
$token = "1296708550:AAFcfS9g3UdqNM6jazSNQbVnVR8v85364uY";
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
if(empty($cache->getInfo("create_form.txt"))){
    if($cache->getInfo("cache.txt") == "/create_form"){
    $cache->progress("create_form.txt" , $text);

    }
}


/* if create_form.txt is not empty thats mean user gave title of form so this if clause triggers steps of createForm 
if user type '/end' then createForm questions will stop and bot will create from */
if(!empty($cache->getInfo("create_form.txt")) && $text != "/end" && $text != "/done"){
    sendMessage($chatID, "What do you want in your form \r\n1-) Full Name Field \r\n2-) Email Field \r\n3-) Address Field \r\n4-) Phone Number Field \r\nType '/end' for stop ");
    $cache->progress("create_form.txt" , $text);

}
/* This project have 2 txt file, cache.txt and create_form.txt when user type '/create_form' cache.txt is saving this type for 
starting create_form.php*/
if($text == "/create_form"){
    $cache->Start();
    $cache->progress("cache.txt" , $text);
}

/* Normally '/end' command should be in command.php it will be added when some steps are completed 
when user type '/end' cache files are deleted and create_form() which is comming from create_form.php method  starts */
if($text == "/end"){
    //sendMessage($chatID , create_form());
    //sendMessage($chatID , submission('202205995700957'));
    $cache->End();
    sendMessage($chatID, "Form created succesfully");
}

/* When user type '/done' system will closed and Send() method will run which is coming from submission.php */
if($text == "/done"){
    Send();
    $cache->End();
    sendMessage($chatID , "Form response has been received");
}


/* seperated $text message for "1 Name Surname" or "2 example@example.com" answers*/
$data = explode(" " , $text);

/* submission command working with '/start /submission form_number' so when user enter this command, /submission command adding into cache.txt
and response.txt saving Form ID number */
if($data[1] == "/submission"){
    $cache->Start();
    $cache->progress("cache.txt" , $data[1]);
    $cache->progress("response.txt" , "202222411265036");
    sendMessage($chatID , question('202222411265036'));
}
/* After user used /submission command bot will ask question of form question and added into response.txt of user answers this if clause will user if user type '/end' 
or '/done' */
if($cache->getInfo("cache.txt") == "/submission" && $text != "/done" && $text != "/end"){
        if($data[0] == "1"){
            $name = $data[1]." ".$data[2];
            $cache->progress("response.txt" , "FullName ".$name);
        }
        else if($data[0] == "2") {
            $cache->progress("response.txt" , "Email ".$data[1]);
        }
        else if($data[0] == "3"){
            $cache->progress("response.txt" , "PhoneNumber ".$data[1]);
        }
        else if($data[0] == "4"){
            $cache->progress("response.txt" , "Address ".$data[1]);
        }
        sendMessage($chatID , response());
    }


?>



