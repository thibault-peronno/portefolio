<?php

namespace App\Models;


use App\Controllers\ProjectLanguageController;
use App\Utils\Database;
use PDO;

class Project
{
    public $id;
    public $title;
    public $description;
    public $picture;
    public $url;
    public $organization_id;

    public function getProjects(): array
    {
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

        $getProjects = array_map(function ($getProject) {
            return [
                'id' => $getProject['id'],
                'title' => $getProject['title'],
                'description' => $getProject['description'],
                'url' => $getProject['url'],
                'picture' => $getProject['picture'],
                'organization_id' => $getProject['organization_id'],
                'labels' => json_decode('[' . $getProject['labels'] . ']', true),
            ];
        }, $getProjects);
        return $getProjects;
    }

    public function getProject($idProject): array
    {
        $pdo = Database::getPDO();
        $sql = "SELECT p.*, o.title AS title_organization, o.picture AS picture_organization, GROUP_CONCAT(DISTINCT JSON_OBJECT('label', l.label, 'picture', l.picture)) AS labels
        FROM projects p
        LEFT JOIN projects_languages pl ON p.id = pl.project_id
        LEFT JOIN languages l ON pl.language_id = l.id
        LEFT JOIN organizations o ON p.organization_id = o.id
        WHERE p.id = $idProject
        GROUP BY p.id";

        $pdoStatement = $pdo->query($sql);
        $getProject = $pdoStatement->fetch(PDO::FETCH_ASSOC);

        $getProject['labels'] = json_decode('[' . $getProject['labels'] . ']', true);

        return $getProject;
    }

    public function addProject(): bool
    {

        $pdo = Database::getPDO();
        $sql = "INSERT INTO `projects` (`title`, `description`, `url`, `picture`, `organization_id`) VALUES (:title, :description, :url, :url, :organizationId)";

        try {
            /*  La méthode prepare() de PDO est utilisée pour préparer une requête SQL pour son exécution, en créant un objet PDOStatement qui permet de lier des valeurs aux placeholders de la requête et d'exécuter la requête de manière sécurisée, évitant ainsi les injections SQL
             */
            $pdoStatement = $pdo->prepare($sql);

            /*  La méthode bindValue() de l'objet PDOStatement est utilisée pour lier une valeur à un paramètre nommé dans une requête SQL préparée. Elle prend trois arguments : le nom du paramètre (avec un préfixe :), la valeur à lier, et optionnellement le type de données de la valeur. Cette méthode permet de sécuriser les requêtes en évitant les injections SQL, car elle assure que les valeurs sont correctement échappées et traitées par le système de gestion de base de données. De plus, en spécifiant le type de données attendu, elle peut améliorer les performances de la requête et éviter des erreurs de type de données
             */
            $pdoStatement->bindValue(':title', $this->title, PDO::PARAM_STR);
            $pdoStatement->bindValue(':description', $this->description, PDO::PARAM_STR);
            $pdoStatement->bindValue(':url', $this->url, PDO::PARAM_STR);
            $pdoStatement->bindValue(':url', $this->picture, PDO::PARAM_STR);
            $pdoStatement->bindValue(':organizationId', $this->organization_id, PDO::PARAM_INT);

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
            $pdo->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);
        }
    }

    public function updateProject(): bool
    {
        dump('updateProject');
        $pdo = Database::getPDO();
        $sql = "UPDATE `projects` SET (`title`, `description`, `url`, `picture`, `organization_id`) VALUES (:title, :description, :url, :url, :organizationId) WHERE id = $this->id ";
        try {
            $pdoStatement = $pdo->prepare($sql);
            
            dump('updateProject test', $this->id);
            $pdoStatement->bindValue(':title', $this->title, PDO::PARAM_STR);
            $pdoStatement->bindValue(':description', $this->description, PDO::PARAM_STR);
            $pdoStatement->bindValue(':url', $this->url, PDO::PARAM_STR);
            $pdoStatement->bindValue(':url', $this->picture, PDO::PARAM_STR);
            $pdoStatement->bindValue(':organizationId', $this->organization_id, PDO::PARAM_INT);

            $insertedRows = $pdoStatement->execute();
            dump('$insertedRows', $insertedRows);

            if ($insertedRows > 0) {
                // We retrieve the last id.
                $projectLanguageCtrl = new ProjectLanguageController;
                $deleteLanguages = $projectLanguageCtrl->deleteProjetctLanguage($_POST['languages'], $this->id);
                if($deleteLanguages){
                    $insertLanguages = $projectLanguageCtrl->addProjectLanguage($this->id);
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
        $this->title = $title;
        return $this;
    }

    public function getDescription(): string
    {
        return $this->description;
    }
    public function setDescription($description): self
    {
        $this->description = $description;
        return $this;
    }

    public function getPicture(): string
    {
        return $this->picture;
    }
    public function setPicture($picture): self
    {
        $this->picture = $picture;
        return $this;
    }

    public function getUrl(): string
    {
        return $this->url;
    }
    public function setUrl($url): self
    {
        $this->url = $url;
        return $this;
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
}
