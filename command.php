<?php

/* basic Command class, it shows all commands of bot (it will be more command when some steps completed)*/

class command {
function commandlist ($msg) {
    $msg = strtolower($msg);

    switch($msg){

    case"hello":
        return "Hi , welcome to Jotform. I'm your assistant for Jotform. You can easily create new form with me if you want to create form just say /create_form";
    case"how are you":
        return "I'm Fine";
    break;
    case"/create_form":
        return "Alright, Lets start \r\nPlease type form title";

    case"merhaba":
        return "Merhaba, Jotform'a hoşgeldin, Jotform için senin yeni asistanınım. Bana vereceğiniz komutlarla form oluşturabilirsin başlamak için /create_form yazman yeterli";
    case"nasılsın":
        return "İyiyim";
    
    case"naber":
        return "iyiyim, teşekkürler";
    }

}

}