<?php

include_once $_SERVER['DOCUMENT_ROOT']."/JotForm.php";

/* create_form function is creating new form and send 
createForm() request when user type '/end'. 
*/

function create_form(){
        $count = 0;
        $file = file_get_contentes("ftp://admin: @localhost/create_form.txt");
        if ( !file_exists($file) ) {
            throw new Exception('File not found.');
        }
        while(!feof($file)){
            $command = fgets($file);
            $count++;
            if( $command == 1){
                $form = array(
                    'questions' =>array(
                    array(
                        'type' => 'control_textbox',
                        'text' => 'Full Name',
                        'order' => $count,
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
            else if( $command == 2){
                $form = array(
                    'questions' =>array(
                    array(
                        'type' => 'control_email',
                        'text' => 'Email',
                        'order' => $count,
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
            else if( $command == 3){
                $form = array(
                    'questions' =>array(
                    array(
                        'type' => 'control_address',
                        'text' => 'Address',
                        'order' => $count,
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
            else if( $command == 4){
                $form = array(
                    'questions' =>array(
                    array(
                        'type' => 'control_phone',
                        'text' => 'Phone Number',
                        'order' =>  $count,
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
            else{
                $form = array(
                    'questions' =>array(
                    array(
                        'type' => 'control_head',
                        'text' => $command,
                        'order' => $count,
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
                        ),
                    ),
                );
            }
        }
        fclose($file);

        $jotformAPI = new JotForm("53f94ff42756396aee1f2159ec9a486d");
        $response =$jotformAPI->createForm($form);
}

    
