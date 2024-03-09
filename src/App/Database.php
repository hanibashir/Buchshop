<?php

declare(strict_types=1);

namespace App;

use PDO;

class Database
{
    // to cache database connection
    private ?PDO $pdo_obj = null;
    public function __construct(
        private string $host,
        private string $db_name,
        private string $db_user,
        private string $password,
    )
    {
    }

    public function getConnection(): PDO
    {
        if ($this->pdo_obj === null) {

            $dsn = "mysql:host=$this->host;dbname=$this->db_name;charset=utf8;port=3306";

            $this->pdo_obj = new PDO($dsn, $this->db_user, $this->password, [
                PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
            ]);

        }
        return $this->pdo_obj;
    }

}