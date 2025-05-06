<?php

namespace App\Models;

use App\Helpers\ValidateSetterData;

class Languages
{
    private $id;
    private $label;
    private $picture;
    private $type;

    public function getId(): int
    {
        return $this->id;
    }
    public function setId($id): self
    {
        $this->id = $id;
        return $this;
    }

    public function getLabel(): String
    {
        return $this->label;
    }
    public function setLabel($label): self
    {
        try {
            $this->validateString($label, 100, "label");
            $this->label = $label;
            return $this;
        } catch (\Throwable $error) {
            throw $error;
        }
    }

    public function getPicture(): String
    {
        return $this->picture;
    }
    public function setPicture($picture): self
    {
        try {
            $this->validateString($picture, 100, "picture");
            $this->picture = $picture;
            return $this;
        } catch (\Throwable $error) {
            throw $error;
        }
    }

    public function getType(): String
    {
        return $this->type;
    }
    public function setType($type): self
    {
        try {
            $this->validateString($type, 100, "type");
            $this->type = $type;
            return $this;
        } catch (\Throwable $error) {
            throw $error;
        }
    }

    private function validateString($valeur, $length, $field)
    {
        $validateSetterData = new validateSetterData;
        return $validateSetterData->validateString($valeur, $length, $field);
    }
}
