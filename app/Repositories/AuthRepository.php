<?php

namespace App\Repositories;

use App\Models\Auth;
use App\Models\User;
use App\Utils\Database;
use Error;
use PDO;

class AuthRepository
{
    public function get_register_by_login(string $mail, string $password): User | bool
    {
        try {
            
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

            // comparer le mot de passe de $_POST avec le password stocké en base de données
            $authModel = new Auth();
            $isPasswordEqual = $this->is_password_equal($authModel->get_password());
            if(!$isPasswordEqual) {
                return false;
            }
            $authModel->set_password($password);

            $userModel = new User();
            if ($getUser) {
                $userModel->set_id(intval($getUser['user_id']));
                $userModel->set_firstname($getUser['firstname']);
                $userModel->set_lastname($getUser['lastname']);
                $authModel->set_mail($mail);
                return $userModel;
            }
            return false;
        } catch (\Throwable $error) {
            throw $error;
        }
    }

    public function is_password_equal($password): bool
    {
        try {
            if ($password) {
                $isHashEqual =  hash_equals(hash('sha256', $_POST['password']), $password);
            }

            if ($isHashEqual) {
                return true;
            }
            return false;
        } catch (\Throwable $error) {
            throw $error;
        }
    }

    public function add_register(string $firstname, string $lastname, int $roleId)
    {
        try {
            $pdo = Database::getPDO();
            $sql = "INSERT INTO `users` (`firstname`, `lastname`, `role_id`) VALUE(:firstname, :lastname, :roleId)";
            
            $pdoStatement = $pdo->prepare($sql);

            $pdoStatement->bindValue(':firstname', $firstname);
            $pdoStatement->bindValue(':lastname', $lastname);
            $pdoStatement->bindValue(':roleId', $roleId);

            $insertedRows = $pdoStatement->execute();

            if ($insertedRows > 0) {
                $userModel = new User;
                $userModel->set_firstname($firstname);
                $userModel->set_lastname($lastname);
                $userModel->set_id($pdo->lastInsertId());
            
                $insertRegister = $this->is_register_added($userModel);

                if ($insertRegister) {
                    // We return true, because the sql insert has worked.
                    return true;
                }
            }
            return false;
        } catch (\Throwable $error) {
            throw new Error("La création du compte a échoué");
        }
    }

    /* 
    Verifier la longueur du mot de passe
    Verifier que l'utilisateur n'est pas déja en base de donnée via son e-mail
    */
    public function is_register_added(User $userModel): bool
    {

        try {
            $authModel = new Auth();
            $pdo = Database::getPDO();
            $sql = "INSERT INTO `registers` (`mail`, `password`, `user_id`) VALUE(:mail, :password, :userId)";
            $pdoStatement = $pdo->prepare($sql);

            $pdoStatement->bindValue(':mail', $authModel->get_mail());
            $pdoStatement->bindValue(':password', hash("sha256", $authModel->get_password()));
            $pdoStatement->bindValue(':userId', $userModel->get_id());

            $insertedRows = $pdoStatement->execute();

            if ($insertedRows > 0) {
                return true;
            }
            return false;
        } catch (\Throwable $error) {
            $userRepository = new UserRepository();
            $userRepository->delete_user($userModel);
            throw new Error("La création du compte a échoué");
        }
    }
}
