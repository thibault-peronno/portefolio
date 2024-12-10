<?php

namespace App\Repositories;

use App\Controllers\ConnectController;
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

            $pdoStatement->bindValue(':firstname', $userModel->getFirstname());
            $pdoStatement->bindValue(':lastname', $userModel->getLastname());
            $pdoStatement->bindValue(':roleId', $userModel->getRoleId());

            $insertedRows = $pdoStatement->execute();

            if ($insertedRows > 0) {
                // We retrieve the last id.
                $connectCtrl = new ConnectController();
                $usertId = $pdo->lastInsertId();
                $insertRegister = $connectCtrl->isAddRegister($usertId);

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