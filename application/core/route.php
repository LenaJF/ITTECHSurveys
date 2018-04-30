<?php

class Route{

    public static function start(){
        // инициализируем базу
        DB::init();

        // дефолтные имена контроллера и экшена
        $controller_name = 'Main';
        $action_name = 'index';

        // разбиваем урл
        $routes = explode('/', $_SERVER['REQUEST_URI']);

        // получаем имя контроллера
        if(!empty($routes[1])) {
            $controller_name = $routes[1];
        }

        // получаем имя экшна
        if(!empty($routes[2])) {
            $action_name = $routes[2];
        }

        // префиксы
        $controller_name = 'Controller_'.ucfirst(strtolower($controller_name));
        $action_name = "action_".$action_name;

        // подцепляем файл контроллера
        $controller_file = $controller_name.'.php';
        $controller_path = 'application/controllers/'.$controller_file;
        if(file_exists($controller_path)){
            include 'application/controllers/'.$controller_file;

        }else {
            echo '404';
        }

        // создаем контроллер
        $controller = new $controller_name;
        $action = $action_name;
        if(method_exists($controller, $action_name)){
            $controller->$action();

        }else {
            echo '404';
        }
    }
}