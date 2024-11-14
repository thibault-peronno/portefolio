<?php

namespace App\Models;


use App\Controllers\ProjectLanguageController;
use App\Utils\Database;
use PDO;

class Project
{
    public $id;
    public $title;
    public $description;
    public $picture;
    public $url;
    public $organization_id;
    public $labels;
    public $title_organization;
    public $picture_organization;
    public $description_organization;


    public function getId(): string
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
        $this->title = $title;
        return $this;
    }

    public function getDescription(): string
    {
        return $this->description;
    }
    public function setDescription($description): self
    {
        $this->description = $description;
        return $this;
    }

    public function getPicture(): string
    {
        return $this->picture;
    }
    public function setPicture($picture): self
    {
        $this->picture = $picture;
        return $this;
    }

    public function getUrl(): string
    {
        return $this->url;
    }
    public function setUrl($url): self
    {
        $this->url = $url;
        return $this;
    }

    public function getOrganizationId(): string
    {
        return $this->organization_id;
    }
    public function setOrganizationId($organizationId): self
    {
        $this->organization_id = $organizationId;
        return $this;
    }

    public function getLables(): string
    {
        return $this->labels;
    }
    public function setLabels($labels): self
    {
        $this->labels = $labels;
        return $this;
    }

    public function getTitleOrganization(): string
    {
        return $this->title_organization;
    }
    public function setTitleOrganization($titleOrganization): self
    {
        $this->title_organization = $titleOrganization;
        return $this;
    }

    public function getPictureOrganization(): string
    {
        return $this->picture_organization;
    }
    public function setPictureOrganization($pictureOrganization): self
    {
        $this->picture_organization = $pictureOrganization;
        return $this;
    }

    public function getDescriptionOrganization(): string
    {
        return $this->description_organization;
    }
    public function setDescriptionOrganization($descriptionOrganization): self
    {
        $this->description_organization = $descriptionOrganization;
        return $this;
    }
}
