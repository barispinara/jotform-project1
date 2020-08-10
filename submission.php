<?php

include_once $_SERVER['DOCUMENT_ROOT']."/JotForm.php";

function question($number){
    $jotformAPI = new JotForm("53f94ff42756396aee1f2159ec9a486d");
    $response = $jotformAPI->getFormQuestions($number);
    for($i = 0 ; $i <= count($response) ; $i++){
        file_put_contents("question.txt" , $response[$i]['type'].PHP_EOL , FILE_APPEND);
    }
}
function response(){
    $file = fopen ("question.txt" , "r");
    $data;
    while(!feof($file)){
        $command = fgets($file);
        if($command == "control_fullname".PHP_EOL){
            $data .= "1-) Please Enter Your Full Name\r\n";
        }
        else if($command == "control_email".PHP_EOL){
            $data .= "2-) Please Enter Your Email\r\n";
        }
        else if($command == "control_phone".PHP_EOL){
            $data .= "3-) Please Enter Your Phone\r\n";
        }




    }
    fclose($file);
    $data .= "Please Answer Like this '1 Name Surname' or \r\n '2 example@example.com' \r\n type '/done' for complete submission";
    return $data;

}

function Send(){
    $file = fopen("response.txt" , "r");
    $form_number = fgets($file);
    $jotformAPI = new JotForm("53f94ff42756396aee1f2159ec9a486d");
    $response = $jotformAPI->getFormQuestions($form_number);
    for($i = 0 ; $i <= count($response) ; $i++){
     while(!feof($file)){
            $command = fgets($file);
            $data = explode(" " , $command);
            if($response[$i]['type'] == "control_fullname".PHP_EOL){
                if($data[0] == "FullName"){
                    $submission = array(
                        $i."_first" => $data[1],
                        $i."_last" => $data[2]
                    );
                }
            }
            else if($response[$i]['type'] == "control_phone".PHP_EOL){
                if($data[0] == "PhoneNumber"){
                    array_push($submission = array(
                        $i => $data[1],
                    ));
                }
            }
            else if($response[$i]['type'] == "control_email".PHP_EOL){
                if($data[0] =="Email"){
                    array_push($submission = array(
                        $i => $data[1],
                    ));
                }
            }

    }
}
$result = $jotformAPI->createFormSubmission($form_number, $submission);
}
    
