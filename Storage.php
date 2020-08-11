<?php

/* Storage.php is the cache class of bot system, this system creating and deleting txt files with /create_form and /end commands */
// Update: Storage system is changed, Bot will save files according to chatID and username
class Storage{

    public function Start($chatID , $username){
        file_put_contents($chatID.$username."cache.txt");
        file_put_contents($chatID.$username."create_form.txt");
        file_put_contents($chatID.$username."question.txt");
        file_put_contents($chatID.$username."response.txt");
        ob_start();

    }
    public function progress($chatID , $username ,$file , $msg){
        if($file == $chatID.$username."cache.txt"){
        file_put_contents($file , $msg);
        }
        else{
            file_put_contents($file , $msg."\r\n" , FILE_APPEND);
        }
    }
    
    public function End($chatID , $username){
        unlink($chatID.$username."cache.txt");
        unlink($chatID.$username."create_form.txt");
        unlink($chatID.$username."question.txt");
        unlink($chatID.$username."response.txt");
        ob_clean();
    }
    public function getInfo($file){
        return file_get_contents($file);
    }

    

}