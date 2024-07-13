<?php
namespace App\Models;

use App\Controllers\ConnectController;
use App\Utils\Database;
use PDO;

class User
{
    /* Proporties of User model */
    public $firstname;
    public $lastname;
    public $roleId;

    public function getUser():object
    {
        $pdo = Database::getPDO();

        $sql = "SELECT * FROM `users`";

        $pdoStatement = $pdo->query($sql);

        $currentUser= $pdoStatement->fetchObject(User::class);

        return $currentUser;

    }

    public function isAddUser(): bool
    {
        $pdo = Database::getPDO();
        $sql = "INSERT INTO `users` (`firstname`, `lastname`, `role_id`) VALUE(:firstname, :lastname, :roleId)";

        try {
            $pdoStatement = $pdo->prepare($sql);

            $pdoStatement->bindValue(':firstname', $this->firstname, PDO::PARAM_STR);
            $pdoStatement->bindValue(':lastname', $this->lastname, PDO::PARAM_STR);
            $pdoStatement->bindValue(':roleId', $this->roleId, PDO::PARAM_INT);

            $insertedRows = $pdoStatement->execute();

            if ($insertedRows > 0) {
                // We retrieve the last id.
                $connectCtrl = new ConnectController();
                $usertId = $pdo->lastInsertId();
                $insertRegister = $connectCtrl->IsRegister($usertId);

                if ($insertRegister) {
                    // We return true, because the sql insert has worked.
                    return true;
                }
            }
            return false;
        } catch (\Throwable $th) {
            dump($th);
            $pdo->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);
        }
    }

    public function getFirstname():string
    {
        return $this->firstname;
    }
    public function setFirstname($firstname):self
    {
        $this->firstname = $firstname;
        return $this;
    }

    public function getLastname():string
    {
        return $this->lastname;
    }
    public function setLastname($lastname):self
    {
        $this->lastname = $lastname;
        return $this;
    }

    public function getRoleId():int
    {
        return $this->roleId;
    }
    public function setRoleId($roleId):self
    {
        $this->roleId = $roleId;
        return $this;
    }
}