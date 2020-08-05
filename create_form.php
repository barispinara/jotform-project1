<?php
include "JotForm.php";

$jotformAPI = new JotForm("53f94ff42756396aee1f2159ec9a486d");

class form{
    public function create_form($title){
      
        $form = array(
            'questions' =>array(
            array(
                'type' => 'control_head',
                'text' => $title,
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

    public function field($text){
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
        else if($text == "2"){
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
        else if($text == "3"){
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
        else if($text == "4"){
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
        else if($text == "/end"){
            $response = $jotformAPI->createForm($form);
        }


    }



}