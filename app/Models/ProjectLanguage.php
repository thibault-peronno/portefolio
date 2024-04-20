<?php 

namespace App\Models;

use App\Utils\Database;
use PDO;

class ProjectLanguage 
{
    private $id;
    private $projectId;
    private $languageId;

    public function addLanguagesProjects():bool
    {
        try {
            $pdo = Database::getPDO();
            // Préparation de la requête pour insérer les langages
            $sql = "INSERT INTO `projects_languages` (`project_id`, `language_id`) VALUES (:projectId, :languageId)";
            $pdoStatementLanguages = $pdo->prepare($sql);
    
           
                $pdoStatementLanguages->bindValue(':projectId', $this->projectId, PDO::PARAM_INT);
                $pdoStatementLanguages->bindValue(':languageId', $this->languageId, PDO::PARAM_INT);
                $insertedRows = $pdoStatementLanguages->execute();
    
            if ($insertedRows > 0) {
                // We return true, because the sql insert has worked.
                return true;
            }

            return false;

        } catch (\Throwable $error) {
            $pdo->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);
            dump($error->getMessage());
            die;
        }
    }

    public function getId():int
    {
        return $this->projectId;
    }
    public function setId($id):self
    {
    $this->projectId = $id;
    return $this;
    }

    public function getProjectId():int
    {
        return $this->projectId;
    }
    public function setProjectId($projectId):self
    {
    $this->projectId = $projectId;
    return $this;
    }

    public function getLanguageId():int
    {
        return $this->languageId;
    }
    public function setLanguageId($languageId):self
    {
    $this->languageId = $languageId;
    return $this;
    }
}