<?php

namespace App\Repository;

use App\Models\User;
use Kernel\Components\DBConnection;
use PDO;

class UserRepository
{
    private PDO $dbConnection;

    public function __construct()
    {
        $this->dbConnection = DBConnection::getInstance();
    }

    public function store(array $data): bool
    {
        $sql = <<<SQL
            INSERT INTO users (name, email, phone, password, created_at) 
            VALUES (:name, :email, :phone, :password, :created_at)
        SQL;

        return $this->dbConnection->prepare($sql)->execute([
            'name' => $data['name'],
            'email' => $data['email'],
            'phone' => $data['phone'],
            'password' => password_hash($data['password'], PASSWORD_DEFAULT),
            'created_at' => date('Y-m-d H:i:s'),
        ]);
    }

    public function getByEmail(string $email): ?User
    {
        $sql = <<<SQL
            SELECT *
            FROM users
            WHERE email = :email
        SQL;

        $preparedRequest = $this->dbConnection->prepare($sql);

        $preparedRequest->execute([
            'email' => $email
        ]);

        $data = $preparedRequest->fetch();

        return $data
            ? (new User())->initializeModel($data)
            : null;
    }

    public function login(array $data): ?User
    {
        $sql = <<<SQL
            SELECT *
            FROM users
            WHERE email = :email or phone = :phone
        SQL;

        $preparedRequest = $this->dbConnection->prepare($sql);


        $preparedRequest->execute([
            'email' => $data['login_field'],
            'phone' => $data['login_field'],
        ]);

        $user = $preparedRequest->fetch();

        return $user && password_verify($data['password'], $user['password'])
            ? (new User())->initializeModel($user)
            : null;
    }

    public function updateWithoutPassword(array $data, string $id): bool
    {
        $sql = <<<SQL
            UPDATE users 
            SET name = :name, email = :email, phone = :phone
            WHERE id = :id
        SQL;

        return $this->dbConnection->prepare($sql)->execute([
            'name' => $data['name'],
            'email' => $data['email'],
            'phone' => $data['phone'],
            'id' => $id,
        ]);
    }

    public function getById(string $id): ?User
    {
        $sql = <<<SQL
            SELECT *
            FROM users
            WHERE id = :id
        SQL;

        $preparedRequest = $this->dbConnection->prepare($sql);


        $preparedRequest->execute([
            'id' => $id
        ]);

        $user = $preparedRequest->fetch();

        return $user
            ? (new User())->initializeModel($user)
            : null;
    }

    public function updatePassword(array $data, string $id): bool
    {
        $sql = <<<SQL
            UPDATE users 
            SET password = :password
            WHERE id = :id
        SQL;

        return $this->dbConnection->prepare($sql)->execute([
            'password' => password_hash($data['new_password'], PASSWORD_DEFAULT),
            'id' => $id
        ]);
    }
}