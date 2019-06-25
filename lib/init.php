<?php

function mvc_autoloader($class_name){
    $lib_path = 'lib'.'/'.strtolower($class_name).'.class.php';
    $controllers_path = 'controllers'.'/'.str_replace('controller', '', strtolower($class_name)).'.controller.php';
    $model_path = 'models'.'/'.strtolower($class_name).'.php';

    if ( file_exists($lib_path) ){
        require_once($lib_path);
    } elseif ( file_exists($controllers_path) ){
        require_once($controllers_path);
    } elseif ( file_exists($model_path) ){
        require_once($model_path);
    } else {
        throw new Exception('Failed to include class: '.$class_name);
    }
}

spl_autoload_register('mvc_autoloader');

function runApp($uri){
    // 1. Get controller and action names
    $dispach_data = Dispatcher::dispatch($uri);
    // 2. Include controller' file
    $controller_name = $dispach_data['controller'];
    $controller_file = "controllers/{$controller_name}.controller.php";
    if(!file_exists($controller_file)){
        header("HTTP/1.0 404 Not Found");
        exit;
    }
    include $controller_file;
    // 3. Run controller' function (action)

    $controller_class = ucfirst($controller_name).'Controller';
    $controller_method = strtolower($dispach_data['action']);
    $controller_object = new $controller_class();


    if ( method_exists($controller_object, $controller_method) ){
        // Controller's action may return a view path
        $action = $controller_object->$controller_method();

        $layout_path = "views/{$controller_name}/{$controller_method}.html";
        $view_object = new View($controller_object->getData(), $layout_path);
        $content = $view_object->render();
    } else {
        throw new Exception('Method '.$controller_method.' of class '.$action.' does not exist.');
    }


    // 5. Echo data to end-user
    include 'views/default.php';


}





