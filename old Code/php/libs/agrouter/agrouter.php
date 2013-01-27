<?php
require 'libs/router/Router.php';
require 'libs/router/Route.php';

class AgRouter {
    private $router = null;
    
    function __construct() {
        $this->router = new Router();
        $this->router->setBasePath('/php');        

        $this->router->map('/groups/',array('controller' => 'Elements', 'action' => 'getGroups'));   
        $this->router->map('/keps/:group',array('controller' => 'Elements', 'action' => 'getElements'));   
        $this->router->map('/satellitedata/:catalognumber',array('controller' => 'Satellites', 'action' => 'getData'));   
    }    
    
    private function loadAndCheckRoute($target) {

        $basePath = dirname(dirname(dirname(__FILE__)));
        $result = false;
        $controllerName = $target['controller'] . 'Controller';
        if (!class_exists($controllerName)) {
            $path = $basePath . '/controllers/' . strtolower($target['controller']) . '.php';
            @include($path);
        }
        if (class_exists($controllerName)) {
            if (method_exists($controllerName,$target['action'])) {
                $result = true;
            } 
        }
        return $result;   
    }
    
    private function sendError($code, $errorText) {
        $result = Array(
            'error'=>true,
            'code'=>$code,
            'text'=>$errorText
        );
        $this->sendXHRData($result);
    }
    
    private function sendXHRData($data) {
        header('Content-type: application/json');
        echo(json_encode($data));        
        die();
    }
    
    public function run() {
    
        $route = $this->router->matchCurrentRequest();
        if ($route !== false) {
        $parameters = $route->getParameters();                
            $target = $route->getTarget();
            if ($this->loadAndCheckRoute($target)) {
                $className = $target['controller'] . 'Controller';     
                $actionName = $target['action'];     
                
                $class = new $className();
                $class->$actionName($parameters);
            } else {
                $this->sendError(100, 'Missing controller or method');
            }
            die();
        } else {
            $this->sendError(200, 'Bad Route');
        }
    }    
}

function pr($data) {
echo '<pre>';    
print_r($data);
echo '</pre>';   
}

function prd($data) {
pr($data);
die();   
}