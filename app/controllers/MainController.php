<?
namespace app\controllers;
class MainController {
    public function __construct() {
        echo __CLASS__;
    }
    public function indexAction()
    {
        echo __METHOD__;
    }
}