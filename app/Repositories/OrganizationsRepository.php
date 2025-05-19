<?php

namespace App\Repositories;

use App\Models\Organization;
use App\Utils\Database;
use PDO;
use Error;

class OrganizationsRepository
{

    public function get_organizations(): array
    {

        try {
            $pdo = Database::getPDO();
            $sql = "SELECT * FROM `organizations`";
            $pdoStatement = $pdo->query($sql);
            // return $pdoStatement->fetchAll(PDO::FETCH_CLASS, Organization::class);
            $allOrganizations = $pdoStatement->fetchAll(PDO::FETCH_ASSOC);

            $getOrganizations = array_map(function ($getOrganization) {
                $organizationModel = new Organization();

                $organizationModel->set_id($getOrganization['id']);
                $organizationModel->set_title($getOrganization['title']);
                $organizationModel->set_description($getOrganization['description']);
                $organizationModel->set_picture($getOrganization['picture']);

                return $organizationModel;
            }, $allOrganizations);

            return $getOrganizations;
        } catch (\Throwable $error) {
            throw new Error("La récupération des langues de développemen a échoué");
        }
    }

    public function get_organization_by_id($id)
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

            $organizationModel->set_id($organization['id']);
            $organizationModel->set_title($organization['title']);
            $organizationModel->set_description($organization['description']);
            $organizationModel->set_picture($organization['picture']);

            return $organizationModel;
        } catch (\Throwable $error) {
            throw new Error("La récupération de l'organisation a échouée");
        }
    }

    public function add_an_organization(Organization $organizationModel): bool
    {

        try {
            // $organizationModel = new Organization();
            $pdo = Database::getPDO();
            $sql = "INSERT INTO `organizations` (`title`, `description`, `picture`) VALUES (:title, :description, :picture)";
            $pdoStatement = $pdo->prepare($sql);
            $pdoStatement->bindValue(':title',  $organizationModel->get_title(), PDO::PARAM_STR);
            $pdoStatement->bindValue(':description',  $organizationModel->get_description(), PDO::PARAM_STR);
            $pdoStatement->bindValue(':picture',  $organizationModel->get_picture(), PDO::PARAM_STR);

            $insertedRows = $pdoStatement->execute();
        
            if ($insertedRows > 0) {
                return true;
            }
            return false;
        } catch (\Throwable $error) {
            throw new Error("L'ajout de l'organisation a échouée");
        }
    }

    public function update_an_organization(Organization $organizationModel)
    {

        try {
            $pdo = Database::getPDO();
            $sql = "UPDATE `organizations` SET `title` = :title, `description` = :description, `picture` = :picture WHERE id = :id";
            $pdoStatement = $pdo->prepare($sql);

            $pdoStatement->bindParam(':title', $organizationModel->get_title(), PDO::PARAM_STR);
            $pdoStatement->bindParam(':description', $organizationModel->get_description(), PDO::PARAM_STR);
            $pdoStatement->bindParam(':picture', $organizationModel->get_picture(), PDO::PARAM_STR);
            $pdoStatement->bindParam(':id', $organizationModel->get_id(), PDO::PARAM_STR);

            $insertedRows = $pdoStatement->execute();

            if ($insertedRows > 0) {
                return true;
            }
        } catch (\Throwable $error) {
            throw new Error("La mise à jour de l'organisation a échouée");
        }
    }
}
