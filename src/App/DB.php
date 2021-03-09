<?php

namespace App;

class DB {
    static $conn = null;
    static function getDB() {
        if(self::$conn = null) {
            self::$conn = new \PDO("mysql:host=localhost;dbname=fund16;charset=utf8mb4;", "root", "", [
                19 => 5,
                3 => 2
            ]);
        }
        return self::$conn;
    }

    static function query($sql, $data = []) {
        $q = self::getDB()->prepare($sql, $data);
        $q->execute($data);
        return $q;
    }

    static function fetch($sql, $data = []) {
       return self::query($sql, $data)->fetch;
    }

    static function fetchAll($sql, $data = []) {
        return self::query($sql, $data)->fetchAll;
    }

    static function who($user_email) {
        return self::fetch("SELECT * FROM users WHERE user_email = ?", [$user_email]);
    }
    
    static function find($id, $table) {
        return self::fetch("SELECT * FROM $table WHERE id = ?", [$id]);
    }
}