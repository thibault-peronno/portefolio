<?php

namespace App\Models;

class Languages
{
    public $id;
    public $label;
    public $picture;
    public $type;

    public function getId(): int
    {
        return $this->id;
    }
    public function setId($id): self
    {
        $this->id = $id;
        return $this;
    }

    public function getLabel(): int
    {
        return $this->label;
    }
    public function setLabel($label): self
    {
        $this->label = $label;
        return $this;
    }

    public function getPicture(): int
    {
        return $this->picture;
    }
    public function setPicture($picture): self
    {
        $this->picture = $picture;
        return $this;
    }

    public function getType(): int
    {
        return $this->type;
    }
    public function setType($type): self
    {
        $this->type = $type;
        return $this;
    }
}
