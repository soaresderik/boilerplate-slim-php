<?php

namespace App\Modules\User;

use App\Modules\User\Data\UserCreateData;
use PDO;

class UserRepository {

    function __construct(PDO $conn) {
        $this->conn = $conn;
    }

    public function insertUser($data) {
        $sql = "INSERT INTO users 
                    SET name = :name,
                    email = :email,
                    password = :password
        ";

        $this->conn->prepare($sql)->execute($data);

        return (int) $this->conn->lastInsertId();
    }
}