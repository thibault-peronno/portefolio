<?php

namespace App\Models;

class Organization 
{
    private $id;
    private $title;
    private $description;
    private $picture; 

    public function addOrganization()
    {
        echo "Organization model";
    }

    public function getId():int
    {
        return $this->id;
    }
    public function setId($id):self
    {
        $this->id =$id;
        return $this;
    }

    public function getTitle():string
    {
        return $this->title;
    }
    public function setTitle($title):self
    {
        $this->title =$title;
        return $this;
    }

    public function getDescription():string
    {
        return $this->description;
    }
    public function setDescription($description):self
    {
        $this->description =$description;
        return $this;
    }

    public function getPicture():string
    {
        return $this->picture;
    }
    public function setPicture($picture):self
    {
        $this->picture =$picture;
        return $this;
    }
}