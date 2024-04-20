<?php

namespace App\Models;


use App\Controllers\ProjectLanguageController;
use App\Utils\Database;
use PDO;

class Project
{
    private $id;
    private $title;
    private $description;
    private $picture;
    private $url;
    private $organization_id;

    public function getProject():object
    {
        $pdo = Database::getPDO();
        $sql = "SELECT * FROM `projects`";
        $pdoStatement = $pdo->query($sql);
        $currentProject= $pdoStatement->fetchObject(Project::class);
        return $currentProject;
    }

    public function addProject():bool
    {
        
        $pdo = Database::getPDO();
        $sql = "INSERT INTO `projects` (`title`, `description`, `url`, `picture`, `organization_id`) VALUES (:title, :description, :url, :url, :organizationId)";

        try {
            /*  La méthode prepare() de PDO est utilisée pour préparer une requête SQL pour son exécution, en créant un objet PDOStatement qui permet de lier des valeurs aux placeholders de la requête et d'exécuter la requête de manière sécurisée, évitant ainsi les injections SQL
             */
            $pdoStatement=$pdo->prepare($sql);

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

                if($insertLanguages){
                    // We return true, because the sql insert has worked.
                    return true;
                }
    
            }
    
            // Si on arrive ici, c'est que quelque chose n'a pas bien fonctionné => FAUX
            return false;
       
        } catch (\Throwable $error) {
            $pdo->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);
            dump($error->getMessage());
            die;
        }
        // dump($pdoStatement);
        // die;
        
    }

    public function getTitle():string
    {
        return $this->title;
    }
    public function setTitle($title):self
    {
        $this->title = $title;
        return $this;
    }

    public function getDescription():string
    {
        return $this->description;
    }
    public function setDescription($description):self
    {
        $this->description = $description;
        return $this;
    }

    public function getPicture():string
    {
        return $this->picture;
    }
    public function setPicture($picture):self
    {
        $this->picture = $picture;
        return $this;
    }

    public function getUrl():string
    {
        return $this->url;
    }
    public function setUrl($url):self
    {
        $this->url = $url;
        return $this;
    }

    public function getOrganizationId():string
    {
        return $this->organization_id;
    }
    public function setOrganizationId($organizationId):self
    {
        $this->organization_id = $organizationId;
        return $this;
    }
}