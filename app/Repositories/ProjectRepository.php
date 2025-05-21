<?php

namespace App\Repositories;

use App\Models\ProjectLanguage;
use App\Repositories\ProjectLanguageRepository;
use App\Models\Project;
use App\Utils\Database;
use Error;
use PDO;

class ProjectRepository
{
    public function get_projects(): array
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

                $projectModel->set_id($getProject['id']);
                $projectModel->set_title($getProject['title']);
                $projectModel->set_description($getProject['description']);
                $projectModel->set_url($getProject['url']);
                $projectModel->set_picture($getProject['picture']);
                $projectModel->set_organization_id($getProject['organization_id']);
                $projectModel->set_labels(json_decode('[' . $getProject['labels'] . ']', true));

                return $projectModel;
            }, $allProjects);

            return $getProjects;
        } catch (\Throwable $error) {
            throw $error;
        }
    }

    public function get_project_by_id(string $idProject): Project
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

            $projectModel->set_id($getProject['id']);
            $projectModel->set_title($getProject['title']);
            $projectModel->set_description($getProject['description']);
            $projectModel->set_url($getProject['url']);
            $projectModel->set_picture($getProject['picture']);
            $projectModel->set_organization_id($getProject['organization_id']);
            $projectModel->set_title_organization($getProject['title_organization']);
            $projectModel->set_picture_organization($getProject['picture_organization']);
            $projectModel->set_description_organization($getProject['description_organization']);
            $projectModel->set_labels(json_decode('[' . $getProject['labels'] . ']', true));

            // $getProject['labels'] = json_decode('[' . $getProject['labels'] . ']', true);

            return $projectModel;
        } catch (\Throwable $error) {
            throw $error;
        }
    }

    public function add_a_project(string $title, string $description, string $url, string $picture, string $organization_id, $languages): array
    {
        $pdo = Database::getPDO();
        $sql = "INSERT INTO `projects` (`title`, `description`, `url`, `picture`, `organization_id`) VALUES (:title, :description, :url, :picture, :organizationId)";

        try {
            /*  La méthode prepare() de PDO est utilisée pour préparer une requête SQL pour son exécution, en créant un objet PDOStatement qui permet de lier des valeurs aux placeholders de la requête et d'exécuter la requête de manière sécurisée, évitant ainsi les injections SQL
             */
            $pdoStatement = $pdo->prepare($sql);

            /*  La méthode bindValue() de l'objet PDOStatement est utilisée pour lier une valeur à un paramètre nommé dans une requête SQL préparée. Elle prend trois arguments : le nom du paramètre (avec un préfixe :), la valeur à lier, et optionnellement le type de données de la valeur. Cette méthode permet de sécuriser les requêtes en évitant les injections SQL, car elle assure que les valeurs sont correctement échappées et traitées par le système de gestion de base de données. De plus, en spécifiant le type de données attendu, elle peut améliorer les performances de la requête et éviter des erreurs de type de données
             */
            $pdoStatement->bindValue(':title', $title, PDO::PARAM_STR);
            $pdoStatement->bindValue(':description', $description, PDO::PARAM_STR);
            $pdoStatement->bindValue(':url', $url, PDO::PARAM_STR);
            $pdoStatement->bindValue(':picture', $picture, PDO::PARAM_STR);
            $pdoStatement->bindValue(':organizationId', $organization_id, PDO::PARAM_INT);

            $insertedRows = $pdoStatement->execute();

            // le seul élément qui doit initier un controlleur est la route
            if ($insertedRows) {
                // We retrieve the last id.
                $projectId = $pdo->lastInsertId();

                // dd("insertedRows");
                foreach ($languages as $key => $value) {
                    $projectLanguageModel = new ProjectLanguage();
                    $projectLanguageModel->set_project_id($projectId);
                    $projectLanguageModel->set_language_id($value);

                    // call the method to exect the sql request
                    $projectLanguageRepository = new ProjectLanguageRepository();
                    $projectLanguageRepository->add_languages_by_projects($projectLanguageModel);
                }
                return [
                    "message" => "L'ajout a réussi.",
                    "succeeded" => true,
                ];
            }
            return [
                "message" => "L'ajout a échoué.",
                "succeeded" => false,
            ];
        } catch (\Throwable $error) {
            throw new Error("L'ajout de l'organisation a échouée");
        }
    }

    public function update_a_project(string $id, string $title, string $description, string $url, string $picture, string $organization_id, array $languages): array | Error
    {

        $pdo = Database::getPDO();
        $sql = "UPDATE `projects` SET `title` = :title, `description` = :description, `url` = :url, `picture` = :picture, `organization_id` = :organizationId WHERE id = :projectId ";
        try {
            $pdoStatement = $pdo->prepare($sql);
            // dd($this->title,$this->description, $this->url, $this->picture, $this->organization_id, $this->id);
            $pdoStatement->bindParam(':title', $title, PDO::PARAM_STR);
            $pdoStatement->bindParam(':description', $description, PDO::PARAM_STR);
            $pdoStatement->bindParam(':url', $url, PDO::PARAM_STR);
            $pdoStatement->bindParam(':picture', $picture, PDO::PARAM_STR);
            $pdoStatement->bindParam(':organizationId', $organization_id, PDO::PARAM_INT);
            $pdoStatement->bindParam(':projectId', $id, PDO::PARAM_INT);

            $insertedRows = $pdoStatement->execute();

            if ($insertedRows) {
                $projectLanguageRepository = new ProjectLanguageRepository();
                $deleteLanguages = $projectLanguageRepository->delete_languages_by_projects($id);
                
                $insertLanguages = false;
                if ($deleteLanguages) {
                    foreach ($languages as $key => $value) {
                        $projectLanguageModel = new ProjectLanguage();
                        $projectLanguageModel->set_project_id($id());
                        $projectLanguageModel->set_language_id($value);

                        // call the method to exect the sql request
                        $projectLanguageRepository = new ProjectLanguageRepository();
                        $insertLanguages = $projectLanguageRepository->add_languages_by_projects($projectLanguageModel);
                    }
                }
                if($insertLanguages) {
                    return [
                        "message" => "La mise à jour a réussie.",
                        "succeeded" => true,
                    ];
                }
            }
            // si $insertedRows est vrai ici, c'est qu'on a inséré un projet, mais on a pas mis les langages, donc penser à supprimer 
            // le projet
            return [
                "message" => "La mise à jour a échouée.",
                "succeeded" => false,
            ];
        } catch (\Throwable $th) {
            throw new Error("La mise à jour de l'organisation a échouée");
        }
    }
}
