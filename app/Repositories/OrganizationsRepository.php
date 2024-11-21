<?php

namespace App\Repositories;

use App\Models\Organization;
use App\Utils\Database;
use PDO;
use Error;

class OrganizationsRepository {

    public function getOrganizations(): array
    {
        
        try {
            $pdo = Database::getPDO();
            $sql = "SELECT * FROM `organizations`";
            $pdoStatement = $pdo->query($sql);
            // return $pdoStatement->fetchAll(PDO::FETCH_CLASS, Organization::class);
            return$pdoStatement->fetchAll(PDO::FETCH_ASSOC);
        } catch (\Throwable $error) {
            throw new Error("La récupération des langues de développemen a échoué");
        }
    }

    public function getOrgaById(): array | bool
    {
        try {
            $pdo = Database::getPDO();
            $sql = "SELECT * FROM `organizations` WHERE id = :idOrga";
            $pdoStatement = $pdo->prepare($sql);
            
            $pdoStatement->bindParam(':idOrga', $this->id, PDO::PARAM_INT);
            
            $pdoStatement->execute();
            $organization = $pdoStatement->fetch(PDO::FETCH_ASSOC);
            
            return $organization;
        } catch (\Throwable $erro) {
            throw new Error("La récupération de l'organisation a échouée");
        }
    }

    public function addOrganization(): bool
    {
        
        try {
            $organizationModel = new Organization();
            $pdo = Database::getPDO();
            $sql = "INSERT INTO `organizations` (`title`, `description`, `picture`) VALUES (:title, :description, :picture)";
            $pdoStatement = $pdo->prepare($sql);

            $pdoStatement->bindValue(':title',  $organizationModel->getTitle(), PDO::PARAM_STR);
            $pdoStatement->bindValue(':description',  $organizationModel->getDescription(), PDO::PARAM_STR);
            $pdoStatement->bindValue(':picture',  $organizationModel->getPicture(), PDO::PARAM_STR);

            $insertedRows = $pdoStatement->execute();

            if ($insertedRows > 0) {
                return true;
            }
            return false;
        } catch (\Throwable $error) {
            throw new Error("L'ajout de l'organisation a échouée");
        }
    }

    public function updateOrganization()
    {
        $pdo = Database::getPDO();
        $sql = "UPDATE `organizations` SET `title` = :title, `description` = :description, `picture` = :picture WHERE id = :idOrganization";

        try {
            $pdoStatement = $pdo->prepare($sql);

            $pdoStatement->bindParam(':title', $this->title, PDO::PARAM_STR);
            $pdoStatement->bindParam(':description', $this->description, PDO::PARAM_STR);
            $pdoStatement->bindParam(':picture', $this->picture, PDO::PARAM_STR);
            $pdoStatement->bindParam(':idOrganization', $this->id, PDO::PARAM_STR);

            $insertedRows = $pdoStatement->execute();

            if ($insertedRows > 0) {
                // We retrieve the last id.
                return true;
            }
        } catch (\Throwable $th) {
            //throw $th;
        }
    }
}