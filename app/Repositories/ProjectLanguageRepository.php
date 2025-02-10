<?php

namespace App\Repositories;

use App\Models\ProjectLanguage;
use App\Utils\Database;
use PDO;

class ProjectLanguageRepository
{

    public function addLanguagesProjects(): bool
    {
        try {
            $projectLanguageModel = new ProjectLanguage();
            $pdo = Database::getPDO();
            // Préparation de la requête pour insérer les languages
            $sql = "INSERT INTO `projects_languages` (`project_id`, `language_id`) VALUES (:projectId, :languageId)";
            $pdoStatementLanguages = $pdo->prepare($sql);

            $pdoStatementLanguages->bindValue(':projectId', $projectLanguageModel->getProjectId(), PDO::PARAM_INT);
            $pdoStatementLanguages->bindValue(':languageId', $projectLanguageModel->getLanguageId(), PDO::PARAM_INT);
            $insertedRows = $pdoStatementLanguages->execute();

            if ($insertedRows > 0) {
                // We return true, because the sql insert has worked.
                return true;
            }

            return false;
        } catch (\Throwable $error) {
            throw $error;
        }
    }

    public function languageIdModel(): array
    {
        try {
            $pdo = Database::getPDO();
            $sql = "SELECT pl.language_id, l.label  FROM `projects_languages` pl 
            LEFT JOIN `languages` l ON pl.language_id = l.id";

            $pdoStatement = $pdo->query($sql);
            return $pdoStatement->fetchAll(PDO::FETCH_ASSOC);
        } catch (\Throwable $error) {
            throw $error;
        }
    }

    public function deleteLanguagesProjects(): bool
    {
        try {
            $projectLanguageModel = new ProjectLanguage();
            $pdo = Database::getPDO();
            $sql = "DELETE FROM `projects_languages` WHERE project_id = ?";
            $pdoStatement = $pdo->prepare($sql);
            $resultDeleteProjectLanguages =  $pdoStatement->execute([$projectLanguageModel->getProjectId()]);
            return $resultDeleteProjectLanguages;
        } catch (\Throwable $error) {
            throw $error;
        }
    }
}
