<?php

namespace App\Models;

use App\Helpers\ValidateSetterData;

// Dans Register.php

class Auth
{
    public $mail;
    public $password;
    public $userId;

    public function get_mail(): string
    {
        return $this->mail;
    }
    public function set_mail($mail): self
    {
        $this->validate_string($mail, 100, "e-mail");

        $this->mail = $mail;
        return $this;
    }

    public function get_password(): string | null
    {
        return $this->password;
    }
    public function set_password($password): self
    {
        $this->validate_string($password, 100, "mot de passe");

        $this->password = $password;
        return $this;
    }

    public function get_user_id(): int
    {
        return $this->userId;
    }
    public function set_user_id($userId)
    {
        $this->userId = intval($userId);
        return $this->userId;
    }

    private function validate_string(string $valeur, int $length, string $field)
    {
        $validateSetterData = new validateSetterData;
        return $validateSetterData->validate_string($valeur, $length, $field);
    }
}
