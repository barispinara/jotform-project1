<?php

/* Storage.php is the cache class of bot system, this system creating and deleting txt files with /create_form and /end commands */

/* these cache methods will unite when some steps are completed */
class Storage{

    /* Start() method creates new 2 txt file */
    public function Start(){
        file_put_contents("cache.txt");
        file_put_contents("create_form.txt");
        ob_start();

    }
    /* progress($msg) adds new values on cache.txt */
    public function progress($msg){
        file_put_contents("cache.txt" , $msg);
    }
    /* End() method deletes 2 txt file */
    public function End(){
        unlink("cache.txt");
        unlink("create_form.txt");
        ob_clean();
    }
    /* getInfo() method gets values of cache.txt file */
    public function getInfo(){
        return file_get_contents("cache.txt");
    }
    /* Form_progress($msg) adds new values on create_form.txt */
    public function Form_progress($msg){
        file_put_contents("create_form.txt", $msg. PHP_EOL , FILE_APPEND);
    }
    /* getFormInfo() method gets values of create_form.txt */
    public function getFormInfo(){
        return file_get_contents("create_form.txt");
    }
    

}
