<?php

include_once $_SERVER['DOCUMENT_ROOT']."/JotForm.php";
include_once $_SERVER['DOCUMENT_ROOT']."/Storage.php";

/* create_form function is creating new form and send 
createForm() request when user type '/end'. 
*/

function create_form(){
        $count = 0;
        $file = fopen("create_form.txt" , "r");
        while(!feof($file)){
            $command = fgets($file);
            $count++;
            if( $command == "1".PHP_EOL){
                array_push($form['questions'][$count-1]=
                    array(
                        'type' => 'control_fullname',
                        'text' => 'Full Name',
                        'name' => 'Full Name',
                        'validation' => 'None',
                        'required' => 'No',
                        'readonly' => 'No',
                        'size' => '20',
                        'labelAlign' => 'Auto',
                        'hint' => '',
                    ));
                

            }
            else if( $command == "2".PHP_EOL){
                array_push($form['questions'][$count-1]=
                    array(
                        'type' => 'control_email',
                        'text' => 'Email',
                        'name' => 'Email',
                        'validation' => 'None',
                        'required' => 'No',
                        'readonly' => 'No',
                        'size' => '20',
                        'labelAlign' => 'Auto',
                        'hint' => '',
                    ));
                
            }
            else if( $command == "3".PHP_EOL){
                array_push($form['questions'][$count-1]=
                    array(
                        'type' => 'control_address',
                        'text' => 'Address',
                        'name' => 'Address',
                        'validation' => 'None',
                        'required' => 'No',
                        'readonly' => 'No',
                        'size' => '20',
                        'labelAlign' => 'Auto',
                        'hint' => '',
                    ));
            }
            else if( $command == "4".PHP_EOL){
                
                array_push($form['questions'][$count-1]=
                    array(
                        'type' => 'control_phone',
                        'text' => 'Phone Number',
                        'name' => 'Phone Number',
                        'validation' => 'None',
                        'required' => 'No',
                        'readonly' => 'No',
                        'size' => '20',
                        'labelAlign' => 'Auto',
                        'hint' => '',
                    ));
            }
            else{
                $form = array(
                    'questions' =>array(
                    array(
                        'type' => 'control_head',
                        'text' => $command,
                        'name' => 'Header',
                    )),
                    'properties' => array(
                        'title' => $command,
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
                        ),),);
            }
        }
        array_push($form['questions'][$count]=
                    array(
                        'type' => 'control_button',
                        'text' => 'Submit ',
                        'name' => 'Submit',
                        'validation' => 'None',
                        'required' => 'No',
                        'size' => '20',
                        'labelAlign' => 'Auto',
                        'hint' => '',
                    ));
        fclose($file);
/* Send create form request to jotform.com */
        $jotformAPI = new JotForm("53f94ff42756396aee1f2159ec9a486d");
        //return $form['questions'][1]['text'];
        $response =$jotformAPI->createForm($form);
        $str = explode("/" , $response['url']);
        return $str[3];
}

    
