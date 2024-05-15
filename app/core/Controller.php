<?php
namespace app\core;
abstract class Controller{
    protected $route;
    protected $view;
    protected $model;
    public function __construct($route) {
        $this->route = $route;
        $this->include_model($route);
        $this->view = new View($route);
        
    }
    private function include_model($route){
        $model_name = '\app\models\\' . $route['controller'];
        if (class_exists($model_name)){
            $this->model = new $model_name;
        }else {
            if(PROD){
                echo '
                <script> 
                alert("неудалось подключиться к бд ");
             </script>
             ';
                
    
            } else{
                echo 'модель' . $model_name .'не существует';
            }
        }
    }

}