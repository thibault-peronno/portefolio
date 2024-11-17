<?php

namespace App\Repositories;

use App\Controllers\ProjectLanguageController;
use App\Models\Project;
use App\Utils\Database;
use PDO;

class ProjectRepository
{
    public function getProjects(): array
    {
        try {
            $pdo = Database::getPDO();
            $sql = "SELECT p.*, GROUP_CONCAT(DISTINCT JSON_OBJECT('label', l.label, 'picture', l.picture)) AS labels
            FROM projects p
            LEFT JOIN projects_languages pl ON p.id = pl.project_id
            LEFT JOIN languages l ON pl.language_id = l.id
            GROUP BY p.id";
    
    
            $pdoStatement = $pdo->query($sql);
            $getProjects = $pdoStatement->fetchAll(PDO::FETCH_ASSOC);
    
            /* foreach($getProjects as &$getProject){
                dump('foreach', $getProject['labels']);
                $getProject['labels'] = json_decode('[' . $getProject['labels'] . ']', true);
                dump('foreach 2', $getProject['labels']);
            }
            unset($getProject);*/
    
            return $getProjects;
        } catch (\Throwable $error) {
            throw $error;
        }
    }

    public function getProjectById($idProject): array
    {
        try {
            $pdo = Database::getPDO();
            $sql = "SELECT p.*, o.title AS title_organization, o.picture AS picture_organization, o.description AS description_organization, GROUP_CONCAT(DISTINCT JSON_OBJECT('label', l.label, 'picture', l.picture)) AS labels
            FROM projects p
            LEFT JOIN projects_languages pl ON p.id = pl.project_id
            LEFT JOIN languages l ON pl.language_id = l.id
            LEFT JOIN organizations o ON p.organization_id = o.id
            WHERE p.id = $idProject
            GROUP BY p.id";
    
            $pdoStatement = $pdo->query($sql);
            $getProject = $pdoStatement->fetch(PDO::FETCH_ASSOC);
    
            // $getProject['labels'] = json_decode('[' . $getProject['labels'] . ']', true);
    
            return $getProject;
        } catch (\Throwable $error) {
            throw $error;
        }
    }

    public function addProject(): bool
    {
        $projectModel = new Project();

        $pdo = Database::getPDO();
        $sql = "INSERT INTO `projects` (`title`, `description`, `url`, `picture`, `organization_id`) VALUES (:title, :description, :url, :url, :organizationId)";

        try {
            /*  La méthode prepare() de PDO est utilisée pour préparer une requête SQL pour son exécution, en créant un objet PDOStatement qui permet de lier des valeurs aux placeholders de la requête et d'exécuter la requête de manière sécurisée, évitant ainsi les injections SQL
             */
            $pdoStatement = $pdo->prepare($sql);

            /*  La méthode bindValue() de l'objet PDOStatement est utilisée pour lier une valeur à un paramètre nommé dans une requête SQL préparée. Elle prend trois arguments : le nom du paramètre (avec un préfixe :), la valeur à lier, et optionnellement le type de données de la valeur. Cette méthode permet de sécuriser les requêtes en évitant les injections SQL, car elle assure que les valeurs sont correctement échappées et traitées par le système de gestion de base de données. De plus, en spécifiant le type de données attendu, elle peut améliorer les performances de la requête et éviter des erreurs de type de données
             */
            $pdoStatement->bindValue(':title', $projectModel->getTitle(), PDO::PARAM_STR);
            $pdoStatement->bindValue(':description', $projectModel->getDescription(), PDO::PARAM_STR);
            $pdoStatement->bindValue(':url', $projectModel->getUrl(), PDO::PARAM_STR);
            $pdoStatement->bindValue(':url', $projectModel->getPicture(), PDO::PARAM_STR);
            $pdoStatement->bindValue(':organizationId', $projectModel->getOrganizationId(), PDO::PARAM_INT);

            $insertedRows = $pdoStatement->execute();

            if ($insertedRows > 0) {
                // We retrieve the last id.
                $projectLanguageCtrl = new ProjectLanguageController;
                $projectId = $pdo->lastInsertId();
                $insertLanguages = $projectLanguageCtrl->addProjectLanguage($projectId);

                if ($insertLanguages) {
                    // We return true, because the sql insert has worked.
                    return true;
                }
            }

            // Si on arrive ici, c'est que quelque chose n'a pas bien fonctionné => FAUX
            return false;
        } catch (\Throwable $error) {
            throw $error;
        }
    }

    public function updateProject(): bool
    {
        $pdo = Database::getPDO();
        $projectModel = new Project();
        $sql = "UPDATE `projects` SET `title` = :title, `description` = :description, `url` = :url, `picture` = :picture, `organization_id` = :organizationId WHERE id = :projectId ";
        try {
            $pdoStatement = $pdo->prepare($sql);
            // dd($this->title,$this->description, $this->url, $this->picture, $this->organization_id, $this->id);
            $pdoStatement->bindParam(':title', $projectModel->getTitle(), PDO::PARAM_STR);
            $pdoStatement->bindParam(':description', $projectModel->getDescription(), PDO::PARAM_STR);
            $pdoStatement->bindParam(':url', $projectModel->getUrl(), PDO::PARAM_STR);
            $pdoStatement->bindParam(':picture', $projectModel->getPicture(), PDO::PARAM_STR);
            $pdoStatement->bindParam(':organizationId', $projectModel->getOrganizationId(), PDO::PARAM_INT);
            $pdoStatement->bindParam(':projectId', $projectModel->getId(), PDO::PARAM_INT);

            $insertedRows = $pdoStatement->execute();


            if ($insertedRows > 0) {
                // We retrieve the last id.
                $projectLanguageCtrl = new ProjectLanguageController;
                $deleteLanguages = $projectLanguageCtrl->deleteProjetctLanguage($_POST['languages'], $projectModel->getId());
                if ($deleteLanguages) {
                    $insertLanguages = $projectLanguageCtrl->addProjectLanguage($projectModel->getId());
                }

                if ($insertLanguages) {
                    // We return true, because the sql insert has worked.
                    return true;
                }
            }

            // Si on arrive ici, c'est que quelque chose n'a pas bien fonctionné => FAUX
            return false;
        } catch (\Throwable $th) {
            $pdo->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);
        }
        return true;
    }
}
