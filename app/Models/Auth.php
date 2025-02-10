<?php

namespace App\Models;

use App\Helpers\validateSetterData;

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
        $this->validateString($mail, 100, "e-mail");

        $this->mail = $mail;
        return $this;
    }

    public function getPassword(): string | null
    {
        return $this->password;
    }
    public function setPassword($password): self
    {
        $this->validateString($password, 100, "mot de passe");

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

    private function validateString($valeur, $length, $field)
    {
        $validateSetterData = new validateSetterData;
        return $validateSetterData->validateString($valeur, $length, $field);
    }
}
