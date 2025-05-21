<?php

namespace App\Repositories;

use App\Models\ProjectLanguage;
use App\Utils\Database;
use PDO;

class ProjectLanguageRepository
{

    public function add_languages_by_projects(ProjectLanguage $projectLanguageModel): bool 
    {
        try {
            $pdo = Database::getPDO();
            // Préparation de la requête pour insérer les languages
            $sql = "INSERT INTO `projects_languages` (`project_id`, `language_id`) VALUES (:projectId, :languageId)";
            $pdoStatementLanguages = $pdo->prepare($sql);

            $pdoStatementLanguages->bindValue(':projectId', $projectLanguageModel->get_project_id(), PDO::PARAM_INT);
            $pdoStatementLanguages->bindValue(':languageId', $projectLanguageModel->get_language_id(), PDO::PARAM_INT);
            $insertedRows = $pdoStatementLanguages->execute();
            return $insertedRows;
        } catch (\Throwable $error) {
            throw $error;
        }
    }

    public function get_label_language_from_project_languages_id(): array
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

    public function delete_languages_by_projects(int $id): bool
    {
        
        try {
            // $projectLanguageModel = new ProjectLanguage();
            $pdo = Database::getPDO();
            $sql = "DELETE FROM `projects_languages` WHERE project_id = :id";
            $pdoStatement = $pdo->prepare($sql);
            
            $pdoStatement->bindParam(':id', $id, PDO::PARAM_STR);
            
            $resultDeleteProjectLanguages =  $pdoStatement->execute();
            
            return $resultDeleteProjectLanguages;
        } catch (\Throwable $error) {
            throw $error;
        }
    }
}
