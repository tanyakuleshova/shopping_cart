<?php

class Model{

    protected static $db;

    public function __construct(){
        self::$db = 
            new DB(Config::$conf['db.host'], Config::$conf['db.login'], 
            Config::$conf['db.password'], Config::$conf['db.name']);
    }

}

