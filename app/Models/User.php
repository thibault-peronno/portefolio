<?php

namespace App\Models;

class User
{
    /* Proporties of User model */
    public $id;
    public $firstname;
    public $lastname;
    public $roleId;

    public function get_id(): int
    {
        return $this->id;
    }
    public function set_id($id): self
    {
        $this->id = $id;
        return $this;
    }

    public function get_firstname(): string
    {
        return $this->firstname;
    }
    public function set_firstname($firstname): self
    {
        $this->firstname = $firstname;
        return $this;
    }

    public function get_lastname(): string
    {
        return $this->lastname;
    }
    public function set_lastname($lastname): self
    {
        $this->lastname = $lastname;
        return $this;
    }

    public function get_role_id(): int
    {
        return $this->roleId;
    }
    public function set_role_id($roleId): self
    {
        $this->roleId = $roleId;
        return $this;
    }
}
