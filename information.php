<?php
include_once "JotForm.php";

//This is submission class of $Jotform_bot it reading all submission and adding into $data string
function information($formid){
    $jotformAPI = new JotForm("53f94ff42756396aee1f2159ec9a486d");
    $submission = $jotformAPI->getFormSubmissions($formid);
    for($x = 0; $x<count($submission); $x++){
        for($i = 1; $i < count($submission[0]["answers"]); $i++){
            if($submission[$x]["answers"][$i]["text"] =="Full Name" ){
                $data .= "Full Name: ".$submission[$x]["answers"][$i]["prettyFormat"];
            }
            else if($submission[$x]["answers"][$i]["text"] == "Phone Number"){
                $data .= "Phone Number: ".$submission[$x]["answers"][$i]["answer"];
            }
            else if($submission[$x]["answers"][$i]["text"] == "Email"){
                $data .= "Email: ".$submission[$x]["answers"][$i]["answer"];
            }
            else if($submission[$x]["answers"][$i]["text"] == "Address"){
                $data .= "Address: ".$submission[$x]["answers"][$i]["answer"];
            }
            else if($i == 1){
                $data .= "Form Title: ".$submission[$x]["answers"][$i]["text"];
                $data .= "Submission Date: ".$submission[$x]['created_at']."\r\n";
            }
        }
        $data .= "\r\n";
    }

    return $data;
}