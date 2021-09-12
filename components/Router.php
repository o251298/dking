<?php
/*
                                                    ОСНОВНЫЕ ЗАДАЧТИ РОУТЕРА
    АНАЛИЗ ЗАПРОСА
        а) Получить строку запроса
        б) возвратить строку запроса
        в) Подключить данные из массива и перенести их в массив роуты в компоненте Роут
        г) Получить все доступные запросы из массива роутов в виде ключ(паттерн_запроса) и значение (путь_к_обработчику)
        д) Сравнить запрос пользователя и паттерн_запроса, в путь_к_обработчику хранится инфа о контроллере и екшене
    ПОДКЛЮЧЕНИЕ КОНТРОЛЛЕРОВ
        а) После получения путь_к_обработчику разделить эту строчку в массив
        б) Выбрать имя контроллера и переобразовать к виду ProductController
        в) Выбрать имя екшена и переобразовать к виду actionIndex
        г) Получить имя полного доступа к контроллеру к виду http://localhost/controllers/NewsController.php
        д) Если такой файл существует в директории - подключаем данный файл
    ПЕРЕДАЧА УПРАВЛЕНИЯ КОНТРОЛЛЕРУ
        а) Передать новому обьекту $controllerObject класс с именем $controllerName
        б) Теперь мы имеем доступ к методам контроллера
 */

class Router
{
    private $routes;
    private function getUri(){
        if (!empty($_SERVER['REQUEST_URI'])){
            return trim($_SERVER['REQUEST_URI'], '/');
        }
    }

    public function __construct(){
        $routesPath = ROOT.'/config/routes.php';
        $this->routes = include($routesPath);
    }

    public function run(){
        $uri = $this->getUri();
        foreach ($this->routes as $uriPattern => $path){
            if (preg_match("~$uriPattern~", $uri)){
                $newPath = preg_replace("~$uriPattern~", $path, $uri);
                $segments = explode('/', $newPath);
                $controllerName = ucfirst(array_shift($segments)).'Controller';
                $actionName = 'action'.ucfirst(array_shift($segments));
                $param = $segments;
                $controllerFile = ROOT.'/controllers/'.$controllerName.'.php';
                if (file_exists($controllerFile)){
                    include_once($controllerFile);
                    $controllerObj = new $controllerName;
                    $result = call_user_func_array(array($controllerObj, $actionName), $param); // call_user_func_array --  Вызывает пользовательскую функцию с массивом параметров
                    if ($result != null){
                        // если результата нету - обрываем поиск
                        break;
                    }
                }
            }
        }
    }
}