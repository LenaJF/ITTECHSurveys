<?php

class DB {
    private static $dbname = 'ittechsurveys';
    private static $host = 'localhost';
    private static $login = 'root';
    private static $pass = '';
    private static $db;
    public static function init(){ // инициализация
        if(!isset(DB::$db)){
            DB::$db = new mysqli(DB::$host,DB::$login,DB::$pass,DB::$dbname);
        }
    }
    public static function getDb(){ // возвращает обьект для запросов
        if(isset(DB::$db)){
            return DB::$db;
        }
    }

}