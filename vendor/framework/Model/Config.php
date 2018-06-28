<?php

namespace framework\Model;

if ($_SERVER['SERVER_NAME'] == "localhost" || $_SERVER['SERVER_NAME'] == "192.168.1.4") {

    ini_set('display_errors', '1');

    //Dados para a conexão
    define('DB_USER', 'root');
    define('DB_PASS', 'root');
    define('DB_NAME', 'lojavirtual');
    define('DB_HOST', 'localhost');
} else {

    ini_set('display_errors', '0');

    //Dados para a conexão
    define('DB_USER', '');
    define('DB_PASS', '');
    define('DB_NAME', '');
    define('DB_HOST', '');
}

class Config {

    private static $pdo;

    public static function getDataBase() {

        if (!$this->pdo) {

            $this->pdo = new \PDO("mysql:host=" . DB_HOST . ";dbname=" . DB_NAME, DB_USER, DB_PASS);
            $this->pdo->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);
        }

        return $this->pdo;
    }

    /**
     * Verifica se o usuário está logado
     */
    public static function isLoggedIn() {
        if (!isset($_SESSION['logged_in']) || $_SESSION['logged_in'] !== true) {
            return false;
        }

        return true;
    }

    protected function __construct() {
        
    }

    private function __clone() {
        
    }

    private function __wakeup() {
        
    }

}
