<?php
include "Storage.php";



/* basic Command class, it shows all commands of bot (it will be more command when some steps completed)*/

class command {
function commandlist ($msg) {


    switch($msg){

    case"hello":
        return "Hi , welcome to Jotform. I'm your assistant for Jotform. You can easily create new form with me if you want to create form just say /create_form";
    case"how are you":
        return "I'm Fine";
    break;
    case"/create_form":
        return "Alright, Lets start \r\nPlease type form title";

    }
}

}