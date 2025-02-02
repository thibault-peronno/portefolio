<?php

namespace App\Models;

use App\Helpers\validateSetterData;

class Project
{
    private $id;
    private $title;
    private $description;
    private $picture;
    private $url;
    private $organization_id;
    private $labels;
    private $title_organization;
    private $picture_organization;
    private $description_organization;


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
        try{
            $this->validateString($title, 100, "title");
            $this->title = $title;
            return $this;
        }catch(\Throwable $error){
            throw $error;
        }
    }

    public function getDescription(): string
    {
        return $this->description;
    }
    public function setDescription($description): self
    {
        try{
            $this->validateString($description, 255, "description");
            $this->description = $description;
            return $this;
        }catch(\Throwable $error){
            throw $error;
        }
    }

    public function getPicture(): string
    {
        return $this->picture;
    }
    public function setPicture($picture): self
    {
        try{
            $this->validateString($picture, 100, "picture");
            $this->picture = $picture;
            return $this;
        }catch(\Throwable $error){
            throw $error;
        }
    }

    public function getUrl(): string
    {
        return $this->url;
    }
    public function setUrl($url): self
    {
        try{
            $this->validateString($url, 100, "url");
            $this->url = $url;
            return $this;
        }catch(\Throwable $error){
            throw $error;
        }
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

    public function getLabels(): array
    {
        return $this->labels;
    }
    public function setLabels($labels): self
    {
        try{
            $this->validateString($labels, 100, "labels");
            $this->labels = $labels;
            return $this;
        }catch(\Throwable $error){
            throw $error;
        }
    }

    public function getTitleOrganization(): string
    {
        return $this->title_organization;
    }
    public function setTitleOrganization($titleOrganization): self
    {
        try{
            $this->validateString($titleOrganization, 100, "titleOrganization");
            $this->title_organization = $titleOrganization;
            return $this;
        }catch(\Throwable $error){
            throw $error;
        }
    }

    public function getPictureOrganization(): string
    {
        return $this->picture_organization;
    }
    public function setPictureOrganization($pictureOrganization): self
    {
        try{
            $this->validateString($pictureOrganization, 100, "pictureOrganization");
            $this->picture_organization = $pictureOrganization;
            return $this;
        }catch(\Throwable $error){
            throw $error;
        }
    }

    public function getDescriptionOrganization(): string
    {
        return $this->description_organization;
    }
    public function setDescriptionOrganization($descriptionOrganization): self
    {
        try{
            $this->validateString($descriptionOrganization, 100, "descriptionOrganization");
            $this->description_organization = $descriptionOrganization;
            return $this;
        }catch(\Throwable $error){
            throw $error;
        }
    }

    private function validateString($valeur, $length, $field)
    {
        $validateSetterData = new validateSetterData;
        return $validateSetterData->validateString($valeur, $length, $field);
    }
}
