<?php

namespace App\Modules\User;

use App\Modules\User\Data\UserCreateData;
use App\Services\QuerySQL;
use PDO;

class UserRepository extends QuerySQL {

    function __construct(PDO $conn) {
        parent::__construct($conn);
    }

    public function insertUser($data) {

        $result = $this->query("INSERT INTO users 
        SET name = :name,  email = :email, password = :password", 
        [ 
            ":name" => $data["name"],
            ":email" => $data["email"],
            ":password" => $data["password"],
        ]
        );

        return (int) $result;
    }

    public function getUserByEmail($email) {

        $result = $this->select("SELECT * FROM users WHERE email = :email", [
            ":email" => $email
        ]);

        return $result[0];
    }
}