<?php

namespace App\Models;

use App\Helpers\validateSetterData;

class Organization
{
    private $id;
    private $title;
    private $description;
    private $picture;


    public function getId(): int
    {
        return $this->id;
    }
    public function setId($id): self
    {
        $this->id = $id;
        return $this;
    }

    public function getTitle(): string
    {
        return $this->title;
    }
    public function setTitle($title): self
    {
        try {
            $this->validateString($title, 100, "title");
            $this->title = $title;
            return $this;
            //code...
        } catch (\Throwable $th) {
            //throw $th;
        }
    }

    public function getDescription(): string
    {
        return $this->description;
    }
    public function setDescription($description): self
    {
        try {
            $this->validateString($description, 255, "description");
            $this->description = $description;
            return $this;
        } catch (\Throwable $error) {
            throw $error;
        }
    }

    public function getPicture(): string
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

    private function validateString($valeur, $length, $field)
    {
        $validateSetterData = new validateSetterData;
        return $validateSetterData->validateString($valeur, $length, $field);
    }
}
