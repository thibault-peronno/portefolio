<?php

namespace App\Repositories;

use App\Models\Register;
use App\Utils\Database;
use PDO;

class RegisterRepository {

    /* 
    Verifier la longueur du mot de passe
    Verifier que l'utilisateur n'est pas déja en base de donnée via son e-mail
    */
    public function isAddRegister(): bool
    {
        
        try {
            $registerModel = new Register();
            $pdo = Database::getPDO();
            $sql = "INSERT INTO `registers` (`mail`, `password`, `user_id`) VALUE(:mail, :password, :userId)";
            $pdoStatement = $pdo->prepare($sql);

            $pdoStatement->bindValue(':mail', $registerModel->getMail());
            $pdoStatement->bindValue(':password', hash("sha256", $registerModel->getPassword()));
            $pdoStatement->bindValue(':userId', $registerModel->getUserId());

            $insertedRows = $pdoStatement->execute();

            if ($insertedRows > 0) {
                return true;
            }
            return false;
        } catch (\Throwable $error) {
            throw $error;
        }
    }

    public function getUser(): array | bool
    {
        try {
            $registerModel = new Register();
            // La méthodologie pour get un user devra etre mis autre part !!! 
            $pdo = Database::getPDO();
            /* ici avec 'mail', cela ne fonctionnait pas  */
            $sql = "SELECT * FROM `registers` INNER JOIN `users` ON registers.user_id = users.id WHERE mail = :mail";
            $pdoStatement = $pdo->prepare($sql);
            $pdoStatement->bindParam(':mail', $registerModel->getMail());
            $pdoStatement->execute();

            $getUser = $pdoStatement->fetch(PDO::FETCH_ASSOC);

            $registerModel->setPassword($getUser['password']);

            if ($getUser) {
                return [
                    'user' => true,
                    'user_id' => $getUser['user_id'],
                    'firstname' => $getUser['firstname'],
                    'lastname' => $getUser['lastname'],
                ];
            }
            return false;
        } catch (\Throwable $error) {
            throw $error;
        }
    }

    
}