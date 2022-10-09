
<?php

class Connection{
    
    protected static $pdo;

    private function __construct() {

        $host   = "localhost";
        $port   = "3306";
        $user   = "SEU_USUARIO";
        $pass   = "SUA_SENHA";
        $dbname = "SEU_DATABASE";

        $dsn = "mysql:host={$host};dbname={$dbname};port={$port}";

        try{
            self::$pdo = new \PDO($dsn, $user, $pass);
            self::$pdo->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);
            self::$pdo->setAttribute(\PDO::ATTR_DEFAULT_FETCH_MODE, \PDO::FETCH_OBJ);
            self::$pdo->exec('SET NAMES utf8');

        }catch(\PDOException $e){
            echo $e->getMessage();
        }

    }

    public static function getConnection() {
        
        if(!self::$pdo){
            new Connection();
        }
        return self::$pdo;
    }
}   
