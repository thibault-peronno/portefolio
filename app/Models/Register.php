<?php

namespace App\Models;

use App\Utils\Database;
use PDO;
// Dans Register.php
require __DIR__ . '/../../bootstrap.php';

class Register
{
    public $mail;
    public $password;
    public $userId;

    /* 
    Verifier la longueur du mot de passe
    Verifier que l'utilisateur n'est pas déja en base de donnée via son e-mail
    */
    public function isAddRegister(): bool
    {
        $pdo = Database::getPDO();
        $sql = "INSERT INTO `registers` (`mail`, `password`, `user_id`) VALUE(:mail, :password, :userId)";

        try {
            $pdoStatement = $pdo->prepare($sql);

            $pdoStatement->bindValue(':mail', $this->mail, PDO::PARAM_STR);
            $pdoStatement->bindValue(':password', hash("sha256", $this->password), PDO::PARAM_STR);
            $pdoStatement->bindValue(':userId', $this->userId, PDO::PARAM_INT);

            $insertedRows = $pdoStatement->execute();

            if ($insertedRows > 0) {
                return true;
            }
            return false;
        } catch (\Throwable $th) {
            dump($th);
            $pdo->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);
        }
    }

    public function isGetRegister(): bool
    {
        // La méthodologie pour get un user devra etre mis autre part !!! 
        $pdo = Database::getPDO();
        /* ici avec 'mail', cela ne fonctionnait pas  */
        // $sql = "SELECT * FROM `registers` WHERE mail = :mail INNER JOIN `users` ON `registers.user_id` = `users.id`";
        $sql = "SELECT * FROM `registers` INNER JOIN `users` ON registers.user_id = users.id WHERE mail = :mail";



        try {
            $pdoStatement = $pdo->prepare($sql);
            $pdoStatement->bindParam(':mail', $this->mail, PDO::PARAM_STR);
            $pdoStatement->execute();

            $getUser = $pdoStatement->fetch(PDO::FETCH_ASSOC);
            // dump($getUser);
            // idem mettre ça dans un service
            // ini_set('session.save_path', __DIR__ . '/../temp');
            // ini_set('session.gc_maxlifetime', 3600); // Durée de vie maximale de la session en secondes
            // session_set_cookie_params(3600);
            // session_start();
            $_SESSION['user_id'] = $getUser['user_id'];
            $_SESSION['firstname'] = $getUser['firstname'];
            $_SESSION['lastname'] = $getUser['lastname'];
            $_SESSION['token'] = session_id();
            dump(isset($_SESSION['token']));

            $this->setPassword($getUser['password']);

            if ($getUser) {
                return true;
            }
            return false;
        } catch (\Throwable $error) {
            dump($error);
            $pdo->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);
        }
    }

    public function getMail(): string
    {
        return $this->mail;
    }
    public function setMail($mail): self
    {
        $this->mail = $mail;
        return $this;
    }

    public function getPassword(): string
    {
        return $this->password;
    }
    public function setPassword($password): self
    {
        $this->password = $password;
        return $this;
    }

    public function getUserId(): int
    {
        return $this->userId;
    }
    public function setUserId($userId)
    {
        $this->userId = intval($userId);
        return $this->userId;
    }
}
