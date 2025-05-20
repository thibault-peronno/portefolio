<?php

namespace App\Models;

use App\Helpers\ValidateSetterData;

class Languages
{
    private $id;
    private $label;
    private $picture;
    private $type;

    public function get_id(): int
    {
        return $this->id;
    }
    public function set_id($id): self
    {
        $this->id = $id;
        return $this;
    }

    public function get_label(): String
    {
        return $this->label;
    }
    public function set_label($label): self
    {
        try {
            $this->validate_string($label, 100, "label");
            $this->label = $label;
            return $this;
        } catch (\Throwable $error) {
            throw $error;
        }
    }

    public function get_picture(): String
    {
        return $this->picture;
    }
    public function set_picture($picture): self
    {
        try {
            $this->validate_string($picture, 100, "picture");
            $this->picture = $picture;
            return $this;
        } catch (\Throwable $error) {
            throw $error;
        }
    }

    public function get_type(): String
    {
        return $this->type;
    }
    public function set_type($type): self
    {
        try {
            $this->validate_string($type, 100, "type");
            $this->type = $type;
            return $this;
        } catch (\Throwable $error) {
            throw $error;
        }
    }

    private function validate_string($valeur, $length, $field)
    {
        $validateSetterData = new validateSetterData;
        return $validateSetterData->validate_string($valeur, $length, $field);
    }
}
