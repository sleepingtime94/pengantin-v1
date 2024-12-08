<?php

namespace App\Models;

use PDO;
use App\Databases\Mysql;

class FileModel
{

    private $mysql;
    private $connection;
    private $table = 'product_files';
    private $temp = "temp_files";

    public function __construct()
    {
        $this->mysql = new Mysql();
        $this->connection = $this->mysql->connect();
    }

    public function createOne($params = array())
    {
        try {
            $total = count($params);
            $items = array();
            for ($i = 1; $i <= $total; $i++) {
                $items[] = "?";
            }

            $stmt = $this->connection->prepare('INSERT INTO `' . $this->table . '` (`' . implode('`, `', array_keys($params)) . '`) VALUES (' . implode(', ', $items) . ')');
            return $stmt->execute(array_values($params));
        } catch (\Exception $e) {
            return $e;
        }
    }

    public function createTemp($params = array())
    {
        try {
            $total = count($params);
            $items = array();
            for ($i = 1; $i <= $total; $i++) {
                $items[] = "?";
            }

            $stmt = $this->connection->prepare('INSERT INTO `' . $this->temp . '` (`' . implode('`, `', array_keys($params)) . '`) VALUES (' . implode(', ', $items) . ')');
            return $stmt->execute(array_values($params));
        } catch (\Exception $e) {
            return $e;
        }
    }

    public function findById($id)
    {
        try {
            $stmt = $this->connection->prepare("SELECT * FROM $this->table WHERE pid = ?");
            $stmt->execute([$id]);
            return json_encode([
                'data' => $stmt->fetchAll(PDO::FETCH_ASSOC)
            ]);
        } catch (\Exception $e) {
            return $e;
        }
    }

    public function findByIdLogs($id, $logs)
    {
        try {
            $stmt = $this->connection->prepare("SELECT * FROM $this->table WHERE pid = ? OR logs = ?");
            $stmt->execute([$id, $logs]);
            return json_encode([
                'data' => $stmt->fetchAll(PDO::FETCH_ASSOC)
            ]);
        } catch (\Exception $e) {
            return $e;
        }
    }

    public function findByLogs($logs)
    {
        try {
            $stmt = $this->connection->prepare("SELECT * FROM $this->table WHERE logs = ?");
            $stmt->execute([$logs]);
            return json_encode([
                'data' => $stmt->fetchAll(PDO::FETCH_ASSOC)
            ]);
        } catch (\Exception $e) {
            return $e;
        }
    }

    public function findByLogsTemp($logs)
    {
        try {
            $stmt = $this->connection->prepare("SELECT * FROM $this->temp WHERE logs = ?");
            $stmt->execute([$logs]);
            return json_encode([
                'data' => $stmt->fetchAll(PDO::FETCH_ASSOC)
            ]);
        } catch (\Exception $e) {
            return $e;
        }
    }

    public function updateById($params)
    {
        try {
            $args = [];
            foreach ($params as $key => $value) {
                if ($key !== 'id') {
                    $args[] = "$key = :$key";
                }
            }

            $sql = "UPDATE $this->table SET " . implode(',', $args) . " WHERE id = :id";
            $stmt = $this->connection->prepare($sql);
            $values = $params;

            return $stmt->execute($values);
        } catch (\Exception $e) {
            return $e->getMessage();
        }
    }

    public function deleteById($id)
    {
        try {
            $stmt = $this->connection->prepare("DELETE FROM $this->table WHERE pid = ?");
            return $stmt->execute([$id]);
        } catch (\Exception $e) {
            return $e;
        }
    }

    public function removeTempFile($logs)
    {
        try {
            $stmt = $this->connection->query("DELETE FROM temp_files WHERE logs = '$logs'");
            $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
            return $result;
        } catch (\Throwable $th) {
            throw $th;
        }
    }

    public function moveTempImage($logs)
    {
        try {
            $data = $this->findByLogs($logs);

            foreach ($data as $item) {
                $sourceFile = 'files_temp/' . $item['path'];
                $destinationDir = 'files/';
                $destinationFile = $destinationDir . basename($sourceFile);
                rename($sourceFile, $destinationFile);

                $this->createOne([
                    'path' => $item['path'],
                    'category' => $item['category'],
                    'logs' => $logs
                ]);
            }

            return true;
        } catch (\Throwable $th) {
            throw $th;
        }
    }
}
