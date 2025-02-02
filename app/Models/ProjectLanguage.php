<?php

namespace App\Models;

class ProjectLanguage
{
    private $id;
    private $projectId;
    private $languageId;


    public function getId(): int
    {
        return $this->id;
    }
    public function setId($id): self
    {
        $this->id = $id;
        return $this;
    }

    public function getProjectId(): int
    {
        return $this->projectId;
    }
    public function setProjectId($projectId): self
    {
        $this->projectId = $projectId;
        return $this;
    }

    public function getLanguageId(): int
    {
        return $this->languageId;
    }
    public function setLanguageId($languageId): self
    {
        $this->languageId = $languageId;
        return $this;
    }
}
