<?php

namespace App\Repositories;

use App\Controllers\AuthController;
use App\Models\User;
use App\Utils\Database;
use PDO;

class UserRepository {
    public function getUsers(): object
    {
        $pdo = Database::getPDO();

        $sql = "SELECT * FROM `users`";

        $pdoStatement = $pdo->query($sql);

        $currentUser = $pdoStatement->fetch(PDO::FETCH_ASSOC);

        return $currentUser;
    }

    public function addUser(): bool
    {

        try {
            $userModel = new User;
            $pdo = Database::getPDO();
            $sql = "INSERT INTO `users` (`firstname`, `lastname`, `role_id`) VALUE(:firstname, :lastname, :roleId)";
            
            $pdoStatement = $pdo->prepare($sql);

            $pdoStatement->bindValue(':firstname', $userModel->get_firstname());
            $pdoStatement->bindValue(':lastname', $userModel->get_lastname());
            $pdoStatement->bindValue(':roleId', $userModel->get_role_id());

            $insertedRows = $pdoStatement->execute();

            if ($insertedRows > 0) {
                // We retrieve the last id.
                $connectCtrl = new AuthController();
                $usertId = $pdo->lastInsertId();
                $insertRegister = $connectCtrl->is_register_added($usertId);

                if ($insertRegister) {
                    // We return true, because the sql insert has worked.
                    return true;
                }
            }
            return false;
        } catch (\Throwable $error) {
            throw $error;
        }
    }
}