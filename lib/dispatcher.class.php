<?php
class Dispatcher{
    public static $params;
    public static function dispatch($uri){
        // Defaults
        $controller = 'main';
        $action = 'index';
        $params = array();

        // Put to lower
        $uri = strtolower($uri);
        // 1. Remove /mvc from URI
        $uri = str_replace('/tz.laracode.space/', '', $uri);

        // 2. Clean
        $uri = trim($uri, '/');
        if($uri) {
        // 3. Explode
        $path_parts = explode('/', $uri);
        if ($path_parts) {
        // 4. Get controller
        $controller = array_shift($path_parts);
        }
        if ($path_parts) {
        // 5. Get controller
        $action = array_shift($path_parts);

        }
        // 6. Get params
        self::$params = $path_parts;
        }
        return compact('controller', 'action', 'params');
        }
}