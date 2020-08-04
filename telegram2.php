<?php

include "JotForm.php";

$jotformAPI = new JotForm("API KEY");
$token = "BOT_TOKEN";
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

$text = strtolower($text);
$form_title;
$create_form_command;
$create_form_check = FALSE;

switch($text){

    case"hello":
        sendMessage($chatID,"Hi $firstname, welcome to Jotform. I'm your assistant for Jotform. You can easily create new form with me if you want to create form just say /create_form");
    break;
    case"how are you":
        sendMessage($chatID, "I'm Fine $firstname");
    break;
    case"/create_form":
        sendMessage($chatID, "Alright, Lets start");
        sendMessage($chatID, "Please type Form Title");
        $create_form_command = $text;
    break;
}
if($create_form_command == "/create_form"){
    $form_title = $text;
    $create_form_command = "null";
    $create_form_check = TRUE;
    $form = array(
        'questions' =>array(
        array(
            'type' => 'control_head',
            'text' => $form_title,
            'order' => '1',
            'name' => 'Header',
        )),
        'properties' => array(
            'title' => 'New Form',
            'height' => '600',
        ),
        'emails' => array(
            array(
                'type' => 'notification',
                'name' => 'notification',
                'from' => 'default',
                'to' => 'noreply@jotform.com',
                'subject' => 'New Submission',
                'html' => 'false'
            ),
        ),
    );
}

if($creat_form_check == TRUE){
    while($text == "/end"){
        sendMessage($chatID, "What do you want in your form ");
        sendMessage($chatID, "1-) Full Name Field");
        sendMessage($chatID, "2-) Email Field");
        sendMessage($chatID, "3-) Address Field");
        sendMessage($chatID, "4-) Phone Number Field");
        if($text == "1"){
            $form = array('questions' =>array(
                array(
                    'type' => 'control_textbox',
                    'text' => 'Full Name',
                    'order' => '2',
                    'name' => 'Full Name',
                    'validation' => 'None',
                    'required' => 'No',
                    'readonly' => 'No',
                    'size' => '20',
                    'labelAlign' => 'Auto',
                    'hint' => '',
                )
                ));
        }
        if($text == "2"){
            $form = array('questions' =>array(
                array(
                    'type' => 'control_email',
                    'text' => 'Email',
                    'order' => '3',
                    'name' => 'Email',
                    'validation' => 'None',
                    'required' => 'No',
                    'readonly' => 'No',
                    'size' => '20',
                    'labelAlign' => 'Auto',
                    'hint' => '',
                )
                ));
        }
        if($text == "3"){
            $form = array('questions' =>array(
                array(
                    'type' => 'control_address',
                    'text' => 'Address',
                    'order' => '4',
                    'name' => 'Address',
                    'validation' => 'None',
                    'required' => 'No',
                    'readonly' => 'No',
                    'size' => '20',
                    'labelAlign' => 'Auto',
                    'hint' => '',
                )
                ));
        }
        if($text == "4"){
            $form = array('questions' =>array(
                array(
                    'type' => 'control_phone',
                    'text' => 'Phone Number',
                    'order' => '5',
                    'name' => 'Phone Number',
                    'validation' => 'None',
                    'required' => 'No',
                    'readonly' => 'No',
                    'size' => '20',
                    'labelAlign' => 'Auto',
                    'hint' => '',
                )
                ));
        }
    }
}
if($text == '/end'){
$create_form_check = FALSE;
$response = $jotformAPI->createForm($form);
sendMessage($chatID, "Congratulations your form has been created successfully");
sendMessage($chatID, $response->content->url);

}
?>
