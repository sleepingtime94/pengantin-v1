<?php

namespace App\Models;

use PDO;
use App\Databases\Mysql;

class ProductModel
{
    private $mysql;
    private $connection;
    private $table = "products";

    public function __construct()
    {
        $this->mysql = new Mysql();
        $this->connection = $this->mysql->connect();
    }

    public function findAll(int $page, int $limit, int $level,  ?int $user = null, ?int $status = null)
    {
        try {
            $offset = ($page - 1) * $limit;
            $queryConditions = [];
            $params = [];

            switch ($level) {
                case 1:
                    if ($user !== null) {
                        $queryConditions[] = 'id_user = :user';
                        $params[':user'] = $user;
                    }
                    if ($status !== null) {
                        $queryConditions[] = 'id_status = :status';
                        $params[':status'] = $status;
                    }
                    break;

                case 2:
                    $queryConditions[] = 'id_user = :user';
                    $params[':user'] = $user;
                    if ($status !== null) {
                        $queryConditions[] = 'id_status = :status';
                        $params[':status'] = $status;
                    }
                    break;

                default:
                    break;
            }

            $whereClause = !empty($queryConditions) ? 'WHERE ' . implode(' AND ', $queryConditions) : '';
            $countQuery = "SELECT COUNT(*) FROM $this->table $whereClause";
            $dataQuery = "SELECT * FROM $this->table $whereClause ORDER BY id DESC LIMIT :offset, :limit";

            $stmtCount = $this->connection->prepare($countQuery);
            $stmtData = $this->connection->prepare($dataQuery);

            // Bind parameters for count and data queries
            foreach ($params as $key => $value) {
                $stmtCount->bindValue($key, $value);
                $stmtData->bindValue($key, $value);
            }
            $stmtData->bindValue(':offset', $offset, PDO::PARAM_INT);
            $stmtData->bindValue(':limit', $limit, PDO::PARAM_INT);

            // Execute the queries
            $stmtCount->execute();
            $stmtData->execute();

            $count = $stmtCount->fetchColumn();

            return json_encode([
                'totalItem' => $count,
                'currentPage' => $page,
                'totalPage' => ceil($count / $limit),
                'data' => $stmtData->fetchAll(PDO::FETCH_ASSOC) ?: null
            ]);
        } catch (\Exception $e) {
            return $e->getMessage();
        }
    }


    public function findByKeyword(string $keyword, int $level, int $user)
    {
        try {
            // Menyusun kondisi WHERE berdasarkan level dan keyword
            $whereConditions = [];
            $whereConditions[] = "(lk_name LIKE :keyword OR lk_nik LIKE :keyword OR pr_name LIKE :keyword OR pr_nik LIKE :keyword)";

            // Menambahkan kondisi berdasarkan level dan user (untuk level 2)
            if ($level == 2 && $user !== null) {
                $whereConditions[] = "id_user = :user";
            }

            // Menyusun query WHERE
            $whereSql = "WHERE " . implode(" AND ", $whereConditions);

            // Query untuk menghitung jumlah data
            $countQuery = "SELECT COUNT(*) FROM $this->table $whereSql";
            $countStmt = $this->connection->prepare($countQuery);
            $countStmt->bindValue(':keyword', "%$keyword%", PDO::PARAM_STR);
            if ($level == 2 && $user !== null) {
                $countStmt->bindParam(':user', $user, PDO::PARAM_INT);
            }

            // Eksekusi statement untuk mendapatkan count
            $countStmt->execute();
            $count = $countStmt->fetchColumn();

            // Query untuk mengambil data
            $resultQuery = "SELECT * FROM $this->table $whereSql";
            $resultStmt = $this->connection->prepare($resultQuery);
            $resultStmt->bindValue(':keyword', "%$keyword%", PDO::PARAM_STR);
            if ($level == 2 && $user !== null) {
                $resultStmt->bindParam(':user', $user, PDO::PARAM_INT);
            }
            $resultStmt->execute();

            return json_encode([
                'totalItem' => $count,
                'data' => $resultStmt->fetchAll(PDO::FETCH_ASSOC)
            ]);
        } catch (\Exception $e) {
            return $e;
        }
    }

    public function findById(int $id)
    {
        try {
            $result = $this->connection->prepare("SELECT * FROM $this->table WHERE id = :id");
            $result->bindParam(':id', $id, PDO::PARAM_INT);
            $result->execute();
            return  $result->fetchAll(PDO::FETCH_ASSOC);
        } catch (\Exception $e) {
            return $e;
        }
    }

    public function updateById(array $params)
    {
        try {
            if (!isset($params['id'])) {
                throw new \Exception("ID is required for update.");
            }

            $args = [];
            foreach ($params as $key => $value) {
                if ($key !== 'id') {
                    $args[] = "$key = :$key";
                }
            }

            $sql = "UPDATE $this->table SET " . implode(',', $args) . " WHERE id = :id";
            $result = $this->connection->prepare($sql);

            // Execute dengan array $params secara langsung
            return $result->execute($params);
        } catch (\Exception $e) {
            return $e->getMessage();
        }
    }

    public function deleteById(int $id)
    {
        try {
            $result = $this->connection->prepare("DELETE FROM $this->table WHERE id = :id");
            $result->bindParam(':id', $id, PDO::PARAM_INT);
            return $result->execute();
        } catch (\Exception $e) {
            return $e;
        }
    }

    public function createOne(array $params)
    {
        try {
            if (empty($params)) {
                throw new \Exception("Parameters are required for insert.");
            }

            $placeholders = array_fill(0, count($params), "?");
            $sql = 'INSERT INTO `' . $this->table . '` (`' . implode('`, `', array_keys($params)) . '`) VALUES (' . implode(', ', $placeholders) . ')';

            $result = $this->connection->prepare($sql);
            return $result->execute(array_values($params));
        } catch (\Exception $e) {
            return $e->getMessage();
        }
    }

    public function countTotal(int $id_status = null)
    {
        try {
            if ($id_status !== null) {
                $result = $this->connection->prepare("SELECT COUNT(*) FROM $this->table WHERE id_status = :id_status");
                $result->bindParam(':id_status', $id_status, PDO::PARAM_INT);
                $result->execute();
                return $result->fetchColumn();
            } else {
                return $this->connection->query("SELECT COUNT(*) FROM $this->table")->fetchColumn();
            }
        } catch (\Exception $e) {
            return $e->getMessage();
        }
    }


    public function countTotalByUser(int $id_user)
    {
        try {
            $result = $this->connection->prepare("SELECT COUNT(*) FROM $this->table WHERE id_user = :id_user");
            $result->bindParam(':id_user', $id_user, PDO::PARAM_INT);
            $result->execute();
            return $result->fetchColumn();
        } catch (\Exception $e) {
            return $e;
        }
    }

    public function countTotalByUserStatus(int $id_user, int $id_status)
    {
        try {
            $result = $this->connection->prepare("SELECT COUNT(*) FROM $this->table WHERE id_user = :id_user AND id_status = :id_status");
            $result->bindParam(':id_user', $id_user, PDO::PARAM_INT);
            $result->bindParam(':id_status', $id_status, PDO::PARAM_INT);
            $result->execute();
            return $result->fetchColumn();
        } catch (\Exception $e) {
            return $e;
        }
    }

    public function lastProductID()
    {
        try {
            $result = $this->connection->prepare("SELECT MAX(id) AS last_id FROM $this->table");
            $result->execute();
            $result = $result->fetch(PDO::FETCH_OBJ);
            return $result->last_id;
        } catch (\Exception $e) {
            return $e;
        }
    }
}
