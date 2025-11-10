<?php
declare(strict_types=1);

namespace App\Database;

use \PDO;

class Database {
    public static function connect(): PDO {
        return new PDO($_ENV["dsn"], $_ENV["user"], $_ENV["password"]);
    } 
}