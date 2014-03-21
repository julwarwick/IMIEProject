<?php

class PDO2 extends PDO {
    
     private static $_instance;
     
    public function __construct() {
        
    }
    
    public static function getInstance() {
     $hote = "localhost";
     $database = "imieproject";
     $user = "root";
     $password = "";
        
        if (!isset(self::$_instance)) {
            try {
                self::$_instance = new PDO('mysql:host='.$hote.';dbname='.$database, $user, $password);
            }
            catch (PDOException $e) {
                echo $e;
            }
        }
    }

}

