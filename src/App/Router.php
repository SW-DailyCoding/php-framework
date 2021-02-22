<?php
namespace App;

class Router {
    static $pages = [];
    static function __callStatic($name, $arg) {
        if(strtolower($_SERVER["REQUEST_METHOD"]) == $name) {
            self::$pages[] = $arg;
        } // 앞에 뭐가 붙어쓰..아 self
    }

    //explode(), page[1], Controller\\{$a....}[0];, $name = $arg;, page[0], forEach($pages as $page), stro..., REQUEST_METHOD ? REQUEST_URI, 

    static function start() {
        $url = explode("?", $_SERVER["REQUEST_URI"])[0];

        //여기도 self
        forEach(self::$pages as $page) {
            if($url == $page[0]) {
                $action = explode("@", $page[1]);
                $conName = "Controller\\{$action[0]}";
                $con = new $conName();
                $con->{$action[1]}();
                exit;
            }
        }
    }
}