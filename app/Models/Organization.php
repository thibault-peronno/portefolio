<?php

namespace App\Models;

use App\Helpers\ValidateSetterData;

class Organization
{
    private $id;
    private $title;
    private $description;
    private $picture;


    public function get_id(): int
    {
        return $this->id;
    }
    public function set_id($id): self
    {
        $this->id = $id;
        return $this;
    }

    public function get_title(): string
    {
        return $this->title;
    }
    public function set_title($title): self
    {
        try {
            $this->validate_string($title, 100, "title");
            $this->title = $title;
            return $this;
        } catch (\Throwable $error) {
            throw $error;
        }
    }

    public function get_description(): string
    {
        return $this->description;
    }
    public function set_description($description): self
    {
        try {
            $this->validate_string($description, 255, "description");
            $this->description = $description;
            return $this;
        } catch (\Throwable $error) {
            throw $error;
        }
    }

    public function get_picture(): string
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

    private function validate_string($valeur, $length, $field)
    {
        $validateSetterData = new validateSetterData;
        return $validateSetterData->validate_string($valeur, $length, $field);
    }
}
