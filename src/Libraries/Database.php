<?php

namespace App\Libraries;

class Database
{

    public function __construct()
    {

    }

    public function connect()
    {
        $db = new \PDO(getenv('DB_DRIVER') . ':dbname=' . getenv('DB_NAME') . ';host=' . getenv('DB_HOST'), getenv('DB_USER'), getenv('DB_PASS'));
        if (getenv('DEBUG')) {
            $db->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);
        }
        return $db;
    }
}
