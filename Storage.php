<?php

/* Storage.php is the cache class of bot system, this system creating and deleting txt files with /create_form and /end commands */
class Storage{

    public function Start(){
        file_put_contents("cache.txt");
        file_put_contents("create_form.txt");
        file_put_contents("question.txt");
        file_put_contents("response.txt");
        ob_start();

    }
    public function progress($file , $msg){
        if($file == "cache.txt"){
        file_put_contents($file , $msg);
        }
        else{
            file_put_contents($file , $msg.PHP_EOL , FILE_APPEND);
        }
    }
    
    public function End(){
        unlink("cache.txt");
        unlink("create_form.txt");
        unlink("question.txt");
        unlink("response.txt");
        ob_clean();
    }
    public function getInfo($file){
        return file_get_contents($file);
    }

    

}