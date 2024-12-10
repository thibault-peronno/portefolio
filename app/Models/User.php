<?php

namespace App\Models;

class User
{
    /* Proporties of User model */
    private $id;
    private $firstname;
    private $lastname;
    private $roleId;

    public function getId(): int
    {
        return $this->id;
    }
    public function setId($id): self
    {
        $this->id = $id;
        return $id;
    }

    public function getFirstname(): string
    {
        return $this->firstname;
    }
    public function setFirstname($firstname): self
    {
        $this->firstname = $firstname;
        return $this;
    }

    public function getLastname(): string
    {
        return $this->lastname;
    }
    public function setLastname($lastname): self
    {
        $this->lastname = $lastname;
        return $this;
    }

    public function getRoleId(): int
    {
        return $this->roleId;
    }
    public function setRoleId($roleId): self
    {
        $this->roleId = $roleId;
        return $this;
    }
}
