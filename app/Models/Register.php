<?php

namespace App\Models;

use App\Utils\Database;
use PDO;

class Register
{
    public $mail;
    public $password;
    public $userId;

    /* 
    Verifier la longueur du mot de passe
    Verifier que l'utilisateur n'est pas déja en base de donnée via son e-mail
    */
    public function isRegister(): bool
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
