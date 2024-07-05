<?php

namespace App\Utils;

use PDO;

class Database
{
    private $dbh;
    private static $_instance;

    private function __construct()
    {
        /**
         *parse_ini_file() charge le fichier filename et retourne les configurations qui s'y trouvent 
         * sous forme d'un tableau associatif.
         */
        $configConnect = parse_ini_file(__DIR__ . '/../config.ini');

        try {
            $this->dbh = new PDO(
                "mysql:host={$configConnect['DB_HOST']};dbname={$configConnect['DB_NAME']}",
                $configConnect['DB_USERNAME'],
                $configConnect['DB_PASSWORD']
            );
        } catch (\Exception $exception) {
            echo 'Exception reçue : ',  $exception->getMessage(), "\n";
        }
    }

    public static function getPDO()
    {
        if(empty(self::$_instance))
        {
            self::$_instance = new Database;
        }
        return self::$_instance->dbh;
    }
}
