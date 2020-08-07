<?php

/* Storage.php is the cache class of bot system, this system creating and deleting txt files with /create_form and /end commands */
class Storage{

    public function Start(){
        file_put_contents("cache.txt");
        file_put_contents("create_form.txt");
        ob_start();

    }
    public function progress($msg){
        file_put_contents("cache.txt" , $msg);
    }
    
    public function End(){
        unlink("cache.txt");
        unlink("create_form.txt");
        ob_clean();
    }
    public function getInfo(){
        return file_get_contents("cache.txt");
    }
    public function Form_progress($msg){
        file_put_contents("create_form.txt", $msg. PHP_EOL , FILE_APPEND);
    }
    public function getFormInfo(){
        return file_get_contents("create_form.txt");
    }
    

}