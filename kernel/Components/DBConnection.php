<?php

namespace Kernel\Components;

use Exception;
use PDO;
use PDOException;
use RuntimeException;

class DBConnection
{
    private static array $instances = [];

    private function __construct()
    {
    }

    protected function __clone()
    {
    }

    /**
     * @throws Exception
     */
    public function __wakeup()
    {
        throw new RuntimeException('Cannot unserialize a singleton.');
    }

    private static function createPDOConnection(): ?PDO
    {
        try {
            $connection = new PDO
            (
                $_ENV['DB_TYPE'] . ":host=" . $_ENV['DB_HOST'] . ";dbname=" . $_ENV['DB_NAME'],
                $_ENV['DB_USERNAME'],
                $_ENV['DB_PASSWORD']
            );
            $connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            return $connection;
        } catch (PDOException $e) {
            echo 'Connection failed: ' . $e->getMessage();

            return null;
        }
    }

    public static function getInstance(): ?PDO
    {
        $className = self::class;
        if (!isset(self::$instances[$className])) {
            self::$instances[$className] = self::createPDOConnection();
        }

        return self::$instances[$className];
    }
}