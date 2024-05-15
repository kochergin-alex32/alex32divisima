<?
namespace app\core;

class View{
    private $route;
    private $view;
    private $layout = 'default';
    public function __construct($route)
    {
        $this->route = $route;
        $this->view = 'app/views/' . $route['controller'] . '/index.php';
        $this->render();
        // include $this->view;
    }
    private function render($data = null){

        $layout = 'app/views/layouts/' . $this->layout . '.php';
       
        if (file_exists($this->view)){
            ob_start();
            // echo $this->view;
          include $this->view;
          $content = ob_get_clean();
        } else {
            if(PROD) {
                include 'app/views/503/index.php';
            } else {
                echo 'вид: ' . $this->view . ' не найден';
            }
        }
        // лайоут должен подключаться внизупосле проверок и определения переменной контент иначе мейпейж не отображается
        if (file_exists($layout)){
            include $layout;
        }

    }

}