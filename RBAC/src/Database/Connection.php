<?php

namespace Seguranca\Rbac\Database;

class Connection
{
    private static \PDO|null $pdo = null;
    private function __construct() {}

    public static function getConnection(): \PDO
    {
        if(is_null(self::$pdo)) {
            self::$pdo = new \PDO('mysql:host=localhost;dbname=test', 'root', '');
        }
        return self::$pdo;
    }
}