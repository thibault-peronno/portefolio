<?php

namespace App\Repositories;

use App\Models\User;
use App\Utils\Database;
use PDO;

class UserRepository
{
    public function getUsers(): User
    {
        $pdo = Database::getPDO();

        $sql = "SELECT * FROM `users`";

        $pdoStatement = $pdo->query($sql);

        $currentUser = $pdoStatement->fetch(PDO::FETCH_ASSOC);
        $userModel = new User();

        $userModel->set_id($currentUser["id"]);
        $userModel->set_firstname($currentUser["firstname"]);
        $userModel->set_lastname($currentUser["lastname"]);
        $userModel->set_role_id($currentUser["roleId"]);

        return $userModel;
    }

    public function delete_user(User $userModel): bool
    {

        try {
            $userModel = new User;
            $pdo = Database::getPDO();
            $sql = "DELETE `users` WHERE 'id = :userId'";

            $pdoStatement = $pdo->prepare($sql);

            $pdoStatement->bindValue(':userId', $userModel->get_id());

            return $pdoStatement->execute(); // Renvoie directement true/false
        } catch (\Throwable $error) {
            throw $error;
        }
    }
}
