<?php

class Router
{
    private $routes;

    private function getUri(){
        if (!empty($_SERVER['REQUEST_URI'])){
            return trim($_SERVER['REQUEST_URI'], '/');
        }
    }

    public function __construct(){
        $routerPath = ROOT.'/config/routes.php';
        $this->routes = include($routerPath);
    }

    public function run(){
        $uri = $this->getUri();
        foreach ($this->routes as $patternUri => $path){
            if (preg_match("~$patternUri~", $uri)){
                $newPath = preg_replace("~$patternUri~", $path, $uri);
                $segments = explode('/', $newPath);
                $controllerName = ucfirst(array_shift($segments)).'Controller';
                $actionName = 'action'.ucfirst(array_shift($segments));
                $params = $segments;
                $controllerFile = ROOT.'/controllers/'.$controllerName.'.php';

                if (file_exists($controllerFile)){
                    require_once($controllerFile);
                    $controllerObject = new $controllerName;
                    $result = call_user_func_array(array($controllerObject, $actionName), $params);
                    if ($result != null){
                        break;
                    }
                }
            }
        }
    }
}