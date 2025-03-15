<?php

namespace App\Models;

use Error;

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
    public function setProjectId(int $projectId): self
    {
        $this->projectId = $projectId;
        return $this;
    }

    public function getLanguageId(): int
    {
        return $this->languageId;
    }
    public function setLanguageId(int $languageId): self
    {
        if (!is_numeric($languageId)) {
            throw new Error("languageId must be numeric");
        }

        $this->languageId = $languageId;
        return $this;
    }
}
