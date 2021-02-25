<?php

namespace App;

class DB {
    static $db = null;
    static function getDB() {
        if(self::$db == null) {
            self::$db = new \PDO("mysql:host=localhost;dbname=fund9;charset=utf8mb4", "root", "", [
                19 => 5,
                3 => 2
            ]);
        }
        return self::$db;
    }

    static function query($sql, $data = []) {
        $q = self::getDB()->prepare($sql, $data);
        $q->execute($data);
        return $q;
    }

    static function fetch($sql, $data = []) {
        return self::query($sql, $data)->fetch();
    }
    
    static function fetchAll($sql, $data = []) {
        return self::query($sql, $data)->fetchAll();
    }

    static function who($user_email) {
        return self::fetch("SELECT * FROM users WHERE user_email = ?", [$user_email]);
    }    

    static function find($table, $id) {
        return self::fetch("SELECT * FROM $table WHERE id = ?", [$id]);
    }    

}

