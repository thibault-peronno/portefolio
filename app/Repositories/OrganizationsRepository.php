<?php

namespace App\Repositories;

use App\Models\Organization;
use App\Utils\Database;
use PDO;
use Error;

class OrganizationsRepository
{

    public function getOrganizations(): array
    {

        try {
            $pdo = Database::getPDO();
            $sql = "SELECT * FROM `organizations`";
            $pdoStatement = $pdo->query($sql);
            // return $pdoStatement->fetchAll(PDO::FETCH_CLASS, Organization::class);
            $allOrganizations = $pdoStatement->fetchAll(PDO::FETCH_ASSOC);

            $getOrganizations = array_map(function ($getOrganization) {
                $organizationModel = new Organization();

                $organizationModel->setId($getOrganization['id']);
                $organizationModel->setTitle($getOrganization['title']);
                $organizationModel->setDescription($getOrganization['description']);
                $organizationModel->setPicture($getOrganization['picture']);

                return $organizationModel;
            }, $allOrganizations);

            return $getOrganizations;
        } catch (\Throwable $error) {
            throw new Error("La récupération des langues de développemen a échoué");
        }
    }

    public function getOrgaById($id)
    {
        try {
            $organizationModel = new Organization();
            $pdo = Database::getPDO();
            
            $sql = "SELECT * FROM `organizations` WHERE id = :idOrganizations";
            $pdoStatement = $pdo->prepare($sql);
            
            $pdoStatement->bindParam(':idOrganizations', $id, PDO::PARAM_STR);
            
            $pdoStatement->execute();
            $organization = $pdoStatement->fetch(PDO::FETCH_ASSOC);
            // dd($organization);

            $organizationModel->setId($organization['id']);
            $organizationModel->setTitle($organization['title']);
            $organizationModel->setDescription($organization['description']);
            $organizationModel->setPicture($organization['picture']);

            return $organizationModel;
        } catch (\Throwable $error) {
            throw new Error("La récupération de l'organisation a échouée");
        }
    }

    public function addOrganization(Organization $organizationModel): bool
    {

        try {
            // $organizationModel = new Organization();
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

    public function updateOrganization(Organization $organizationModel)
    {

        try {
            $pdo = Database::getPDO();
            $sql = "UPDATE `organizations` SET `title` = :title, `description` = :description, `picture` = :picture WHERE id = :id";
            $pdoStatement = $pdo->prepare($sql);

            $pdoStatement->bindParam(':title', $organizationModel->getTitle(), PDO::PARAM_STR);
            $pdoStatement->bindParam(':description', $organizationModel->getDescription(), PDO::PARAM_STR);
            $pdoStatement->bindParam(':picture', $organizationModel->getPicture(), PDO::PARAM_STR);
            $pdoStatement->bindParam(':id', $organizationModel->getid(), PDO::PARAM_STR);

            $insertedRows = $pdoStatement->execute();

            if ($insertedRows > 0) {
                return true;
            }
        } catch (\Throwable $error) {
            throw new Error("La mise à jour de l'organisation a échouée");
        }
    }
}
