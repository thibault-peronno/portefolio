<?php
namespace App\Models;

use App\Utils\Database;

class User
{
    /* Proporties of User model */
    private $firstname;
    private $lastname;
    private $role_id;

    public function getUser():object
    {
        $pdo = Database::getPDO();

        $sql = "SELECT * FROM `users`";

        $pdoStatement = $pdo->query($sql);
        dump('pdo', $pdoStatement);

        $currentUser= $pdoStatement->fetchObject(User::class);
        dump('current user', $currentUser);

        return $currentUser;

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
        return $this->role_id;
    }
    public function setRoleId($roleId):self
    {
        $this->role_id = $roleId;
        return $this;
    }
}