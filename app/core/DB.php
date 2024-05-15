<?php
namespace app\core;



class DB {
    protected $db;
    public function __construct() {
         $db_config_file = 'app/config/db-config.php';
         if(file_exists($db_config_file)){
            $db_config = require_once $db_config_file;
            $this->connect_db($db_config);


         } else {
            if(PROD){
                echo '
                <script> 
                alert("неудалось подключиться к бд ");
             </script>
             ';
                
    
            } else{
                echo 'не удалось найти файл:' . $db_config_file;
            }
         }
    }
    private function connect_db($db_config){
        try {
          $this->db = new \PDO("mysql:host={$db_config['host']}; dbname={$db_config['db_name']}", $db_config['user'], $db_config['password']);
        } catch (\PDOException $err) {
            if(PROD){
               die("неудалось подключиться к бд ");
            
            } else{
                die ('не удалось подключиться к бд:' . $err->getMessage());
            }
        }

    }
}