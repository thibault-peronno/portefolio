<?php

namespace App\Models;

// Dans Register.php

class Auth
{
    public $mail;
    public $password;
    public $userId;

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
