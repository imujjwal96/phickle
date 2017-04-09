<?php

namespace Phickle\Models;

use Phickle\Core\Helpers\DatabaseFactory;

class User
{
    private $database;

    public function __construct()
    {
        $this->database = DatabaseFactory::getFactory()->getConnection();
    }

    public function create($userId, $password)
    {
        $passwordHash = password_hash($password, PASSWORD_DEFAULT);

        $query = $this->database->prepare("INSERT INTO users (userid, password) VALUES (:userid, :password)");
        $query->execute([
            ':userid' => $userId,
            ':password' => $passwordHash,
        ]);

        if ($query->rowCount() == 1) {
            return true;
        }
        return false;
    }

    public function checkPassword($userId, $password)
    {
        $query = $this->database->prepare("SELECT userid, password FROM users WHERE userid = :userid ");
        $query->execute(array(
            ':userid' => $userId
        ));

        if ($query->rowCount() === 1) {
            $result = $query->fetch();

            if (password_verify($password, $result->password)) {
                return true;
            }
        }
        return false;
    }
}