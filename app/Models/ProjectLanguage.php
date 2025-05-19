<?php

namespace App\Models;

use Error;

class ProjectLanguage
{
    private $id;
    private $projectId;
    private $languageId;


    public function get_id(): int
    {
        return $this->id;
    }
    public function set_id($id): self
    {
        $this->id = $id;
        return $this;
    }

    public function get_project_id(): int
    {
        return $this->projectId;
    }
    public function set_project_id(int $projectId): self
    {
        $this->projectId = $projectId;
        return $this;
    }

    public function get_language_id(): int
    {
        return $this->languageId;
    }
    public function set_language_id(int $languageId): self
    {
        if (!is_numeric($languageId)) {
            throw new Error("languageId must be numeric");
        }

        $this->languageId = $languageId;
        return $this;
    }
}
