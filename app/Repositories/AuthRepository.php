<?php

namespace App\Repositories;

use App\Models\Auth;
use App\Utils\Database;
use PDO;

class AuthRepository
{

    /* 
    Verifier la longueur du mot de passe
    Verifier que l'utilisateur n'est pas déja en base de donnée via son e-mail
    */
    public function is_register_added(): bool
    {

        try {
            $authModel = new Auth();
            $pdo = Database::getPDO();
            $sql = "INSERT INTO `registers` (`mail`, `password`, `user_id`) VALUE(:mail, :password, :userId)";
            $pdoStatement = $pdo->prepare($sql);

            $pdoStatement->bindValue(':mail', $authModel->get_mail());
            $pdoStatement->bindValue(':password', hash("sha256", $authModel->get_password()));
            $pdoStatement->bindValue(':userId', $authModel->get_user_id());

            $insertedRows = $pdoStatement->execute();

            if ($insertedRows > 0) {
                return true;
            }
            return false;
        } catch (\Throwable $error) {
            throw $error;
        }
    }

    public function get_register($mail, $authModel, $userModel): array | bool
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
                return false;
            }
            $authModel->set_password($getUser['password']);

            if ($getUser) {
                $userModel->set_id(intval($getUser['user_id']));
                $userModel->set_firstname($getUser['firstname']);
                $userModel->set_lastname($getUser['lastname']);
                $authModel->set_mail($mail);
                return true;
            }
            return false;
        } catch (\Throwable $error) {
            throw $error;
        }
    }
}
