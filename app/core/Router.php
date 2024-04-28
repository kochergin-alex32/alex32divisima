<?
namespace  app\core;
class Router{
    private $routes = [];
    private $params = [];
    public function __construct() {
        // echo __CLASS__;
        $routes_arr = require_once "app/config/routes.php";
        foreach ($routes_arr as $route => $params) {
         $this->add_patern_route($route, $params);
        }
    }
    private function add_patern_route($route,$params){
         $templqte_route = '#^'. trim($route, '/') . '$#';
         $this->routes[$templqte_route] = $params;

        
    }
    private function math(){
        $url_width_query = trim($_SERVER['REQUEST_URI'], '/');
        $url = $this->removeQueryString($url_width_query);
        foreach ($this->routes  as $route => $params) {
            if(preg_match($route, $url, $mathes)){
                $this->params = $params;
                return true;
            }
            return false;
        }
    }
    private function removeQueryString($url) {
       $parts = explode('?',$url);
       return trim($parts[0], '/');
    }
    public function run(){
        if($this->math()){
            $controller_name ="\app\controllers\\" . $this->params['controller'] . 'Controller';
            // echo $controller_name;
            if(class_exists($controller_name)){
                echo 'yes';
            } else {
                echo "no";
            }
        }
    }
}