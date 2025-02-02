<?php

namespace App\Repositories;

use App\Models\Auth;
use App\Utils\Database;
use Exception;
use PDO;

class AuthRepository
{

    /* 
    Verifier la longueur du mot de passe
    Verifier que l'utilisateur n'est pas déja en base de donnée via son e-mail
    */
    public function isAddRegister(): bool
    {

        try {
            $authModel = new Auth();
            $pdo = Database::getPDO();
            $sql = "INSERT INTO `registers` (`mail`, `password`, `user_id`) VALUE(:mail, :password, :userId)";
            $pdoStatement = $pdo->prepare($sql);

            $pdoStatement->bindValue(':mail', $authModel->getMail());
            $pdoStatement->bindValue(':password', hash("sha256", $authModel->getPassword()));
            $pdoStatement->bindValue(':userId', $authModel->getUserId());

            $insertedRows = $pdoStatement->execute();

            if ($insertedRows > 0) {
                return true;
            }
            return false;
        } catch (\Throwable $error) {
            throw $error;
        }
    }

    public function getUser($mail, $authModel, $userModel): array | bool
    {
        try {
            // La méthodologie pour get un user devra etre mis autre part !!! 
            $pdo = Database::getPDO();
            /* ici avec 'mail', cela ne fonctionnait pas  */
            $sql = "SELECT * FROM `registers` INNER JOIN `users` ON registers.user_id = users.id WHERE mail = :mail";
            $pdoStatement = $pdo->prepare($sql);
            $pdoStatement->bindParam(':mail', $mail);
            $pdoStatement->execute();

            $getUser = $pdoStatement->fetch(PDO::FETCH_ASSOC);
            if (!$getUser) {
                return [
                    "message" => "Votre e-mail ou mot de passe n'est pas valide",
                    "succeeded" => false,
                ];
            }
            $authModel->setPassword($getUser['password']);

            if ($getUser) {
                $userModel->setId(intval($getUser['user_id']));
                $userModel->setFirstname($getUser['firstname']);
                $userModel->setLastname($getUser['lastname']);
                $authModel->setmail($mail);
                return true;
            }
            return false;
        } catch (\Throwable $error) {
            throw $error;
        }
    }
}
