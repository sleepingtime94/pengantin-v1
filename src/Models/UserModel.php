<?php

namespace App\Models;

use PDO;
use App\Databases\Mysql;

class UserModel
{
    private $mysql;
    private $connection;
    private $table = "users";

    public function __construct()
    {
        $this->mysql = new Mysql();
        $this->connection = $this->mysql->connect();
    }

    public function findById(string $username)
    {
        try {
            $stmt = $this->connection->prepare("SELECT * FROM $this->table WHERE username = :username");
            $stmt->bindParam(':username', $username);
            $stmt->execute();
            return json_encode([
                'data' => $stmt->fetchAll(PDO::FETCH_ASSOC)
            ]);
        } catch (\Exception $e) {
            return $e;
        }
    }
}
