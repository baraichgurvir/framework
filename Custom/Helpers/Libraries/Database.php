<?php

namespace Framework\Helpers\Libraries;

use PDO;

class Database {
    private static PDO $conn;

    public static function connect() {
        $conn = new PDO(conCat(medio()->DB_DRIVER, ":host=", medio()->DB_HOST, ";dbname=", medio()->DB_DATABASE), medio()->DB_USERNAME, medio()->DB_PASSWORD);
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        self::$conn = $conn;
    }

    public static function prepare(string $sql) {
        $query = self::$conn->prepare($sql);
        $query->execute();
        $query->setFetchMode(PDO::FETCH_ASSOC);

        $result = $query->fetchAll();
        return $result;
    }

    public static function quit() {
        self::$conn = null;
    }
}