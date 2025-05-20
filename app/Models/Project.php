<?php

namespace App\Models;

use App\Helpers\ValidateSetterData;
use Error;

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


    public function get_id(): string
    {
        return $this->id;
    }
    public function set_id(int $id): self
    {
        if (!is_numeric($id)) {
            throw new Error("id must be a number");
        }

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

    public function get_url(): string
    {
        return $this->url;
    }
    public function set_url($url): self
    {
        try {
            $this->validate_string($url, 100, "url");
            $this->url = $url;
            return $this;
        } catch (\Throwable $error) {
            throw $error;
        }
    }

    public function get_organization_id(): string
    {
        return $this->organization_id;
    }
    public function set_organization_id(int $organizationId): self
    {
        if (!is_numeric($organizationId)) {
            throw new Error("organizationId must be a number");
        }
        $this->organization_id = $organizationId;
        return $this;
    }

    public function get_labels(): array
    {
        return $this->labels;
    }
    public function set_labels($labels): self
    {
        try {
            $this->labels = $labels;
            return $this;
        } catch (\Throwable $error) {
            throw $error;
        }
    }

    public function get_title_organization(): string
    {
        return $this->title_organization;
    }
    public function set_title_organization($titleOrganization): self
    {
        try {
            $this->validate_string($titleOrganization, 100, "titleOrganization");
            $this->title_organization = $titleOrganization;
            return $this;
        } catch (\Throwable $error) {
            throw $error;
        }
    }

    public function get_picture_organization(): string
    {
        return $this->picture_organization;
    }
    public function set_picture_organization($pictureOrganization): self
    {
        try {
            $this->validate_string($pictureOrganization, 100, "pictureOrganization");
            $this->picture_organization = $pictureOrganization;
            return $this;
        } catch (\Throwable $error) {
            throw $error;
        }
    }

    public function get_description_organization(): string
    {
        return $this->description_organization;
    }
    public function set_description_organization($descriptionOrganization): self
    {
        try {
            $this->validate_string($descriptionOrganization, 255, "descriptionOrganization");
            $this->description_organization = $descriptionOrganization;
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
