<?php

namespace App\Models;

use App\Utils\Database;

class Project
{
    private $title;
    private $description;
    private $picture;
    private $url;
    private $organization_id;

    public function getProject():object
    {
        $pdo = Database::getPDO();
        $sql = "SELECT * FROM `projects`";
        $pdoStatement = $pdo->query($sql);
        $currentProject= $pdoStatement->fetchObject(Project::class);
        return $currentProject;
    }

    public function addProject()
    {
        
    }

    public function getTitle():string
    {
        return $this->title;
    }
    public function setTitle($title):self
    {
        $this->title = $title;
        return $this;
    }

    public function getDescription():string
    {
        return $this->description;
    }
    public function setDescription($description):self
    {
        $this->description = $description;
        return $this;
    }

    public function getPicture():string
    {
        return $this->picture;
    }
    public function setPicture($picture):self
    {
        $this->picture = $picture;
        return $this;
    }

    public function getUrl():string
    {
        return $this->url;
    }
    public function setUrl($url):self
    {
        $this->url = $url;
        return $this;
    }

    public function getOrganizationId():string
    {
        return $this->organization_id;
    }
    public function setOrganizationId($organizationId):self
    {
        $this->organization_id = $organizationId;
        return $this;
    }
}