<?php

namespace App\Repositories;

use App\Models\ProjectLanguage;
use App\Repositories\ProjectLanguageRepository;
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
            $allProjects = $pdoStatement->fetchAll(PDO::FETCH_ASSOC);

            /* foreach($getProjects as &$getProject){
                dump('foreach', $getProject['labels']);
                $getProject['labels'] = json_decode('[' . $getProject['labels'] . ']', true);
                dump('foreach 2', $getProject['labels']);
            }
            unset($getProject);*/

            $getProjects  = array_map(function ($getProject) {
                $projectModel = new Project();

                $projectModel->setId($getProject['id']);
                $projectModel->setTitle($getProject['title']);
                $projectModel->setDescription($getProject['description']);
                $projectModel->setUrl($getProject['url']);
                $projectModel->setPicture($getProject['picture']);
                $projectModel->setOrganizationId($getProject['organization_id']);
                $projectModel->setLabels(json_decode('[' . $getProject['labels'] . ']', true));

                return $projectModel;
            }, $allProjects);

            return $getProjects;
        } catch (\Throwable $error) {
            throw $error;
        }
    }

    public function getProjectById($idProject)
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

            $projectModel = new Project();

            $projectModel->setId($getProject['id']);
            $projectModel->setTitle($getProject['title']);
            $projectModel->setDescription($getProject['description']);
            $projectModel->setUrl($getProject['url']);
            $projectModel->setPicture($getProject['picture']);
            $projectModel->setOrganizationId($getProject['organization_id']);
            $projectModel->setTitleOrganization($getProject['title_organization']);
            $projectModel->setPictureOrganization($getProject['picture_organization']);
            $projectModel->setDescriptionOrganization($getProject['description_organization']);
            $projectModel->setLabels(json_decode('[' . $getProject['labels'] . ']', true));

            // $getProject['labels'] = json_decode('[' . $getProject['labels'] . ']', true);

            return $projectModel;
        } catch (\Throwable $error) {
            throw $error;
        }
    }

    public function addProject(Project $projectModel, $languages): bool
    {
        $pdo = Database::getPDO();
        $sql = "INSERT INTO `projects` (`title`, `description`, `url`, `picture`, `organization_id`) VALUES (:title, :description, :url, :picture, :organizationId)";

        try {
            /*  La méthode prepare() de PDO est utilisée pour préparer une requête SQL pour son exécution, en créant un objet PDOStatement qui permet de lier des valeurs aux placeholders de la requête et d'exécuter la requête de manière sécurisée, évitant ainsi les injections SQL
             */
            $pdoStatement = $pdo->prepare($sql);

            /*  La méthode bindValue() de l'objet PDOStatement est utilisée pour lier une valeur à un paramètre nommé dans une requête SQL préparée. Elle prend trois arguments : le nom du paramètre (avec un préfixe :), la valeur à lier, et optionnellement le type de données de la valeur. Cette méthode permet de sécuriser les requêtes en évitant les injections SQL, car elle assure que les valeurs sont correctement échappées et traitées par le système de gestion de base de données. De plus, en spécifiant le type de données attendu, elle peut améliorer les performances de la requête et éviter des erreurs de type de données
             */
            $pdoStatement->bindValue(':title', $projectModel->getTitle(), PDO::PARAM_STR);
            $pdoStatement->bindValue(':description', $projectModel->getDescription(), PDO::PARAM_STR);
            $pdoStatement->bindValue(':url', $projectModel->getUrl(), PDO::PARAM_STR);
            $pdoStatement->bindValue(':picture', $projectModel->getPicture(), PDO::PARAM_STR);
            $pdoStatement->bindValue(':organizationId', $projectModel->getOrganizationId(), PDO::PARAM_INT);

            $insertedRows = $pdoStatement->execute();
            
            // le seul élément qui doit initier un controlleur est la route
            if ($insertedRows) {
                // We retrieve the last id.
                $projectId = $pdo->lastInsertId();
                
                // dd("insertedRows");
                foreach ($languages as $key => $value) {
                    $projectLanguageModel = new ProjectLanguage();
                    $projectLanguageModel->setProjectId($projectId);
                    $projectLanguageModel->setLanguageId($value);
                    
                    // call the method to exect the sql request
                    $projectLanguageRepository = new ProjectLanguageRepository();
                    $projectLanguageRepository->addLanguagesProjects($projectLanguageModel);
                }
                return true;
            }

            // Si on arrive ici, c'est que quelque chose n'a pas bien fonctionné => FAUX
            return false;
        } catch (\Throwable $error) {
            throw $error;
        }
    }

    public function updateProject(Project $projectModel, $languages): bool
    {
        $pdo = Database::getPDO();
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
                $projectLanguageRepository = new ProjectLanguageRepository();
                $deleteLanguages = $projectLanguageRepository->deleteLanguagesProjects($projectModel->getId());
                if ($deleteLanguages) {
                    $insertLanguages = $projectLanguageRepository->addLanguagesProjects($languages);
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
