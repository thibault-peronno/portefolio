<?php

namespace App\Models;

use App\Utils\Database;
use PDO;
use Error;

class Organization
{
    public $id;
    public $title;
    public $description;
    public $picture;


    public function getOrganizations(): array
    {
        $pdo = Database::getPDO();
        $sql = "SELECT * FROM `organizations`";

        try {
            $pdoStatement = $pdo->query($sql);
            return $pdoStatement->fetchAll(PDO::FETCH_CLASS, Organization::class);
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
            throw new Error("La récupération de l'organisation a échoué");
        }
    }

    public function addOrganization(): bool
    {
        $pdo = Database::getPDO();
        $sql = "INSERT INTO `organizations` (`title`, `description`, `picture`) VALUES (:title, :description, :picture)";

        try {
            $pdoStatement = $pdo->prepare($sql);

            $pdoStatement->bindValue(':title',  $this->title, PDO::PARAM_STR);
            $pdoStatement->bindValue(':description',  $this->description, PDO::PARAM_STR);
            $pdoStatement->bindValue(':picture',  $this->picture, PDO::PARAM_STR);

            $insertedRows = $pdoStatement->execute();

            if ($insertedRows > 0) {
                return true;
            }
            return false;
        } catch (\Throwable $error) {
            $pdo->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);
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

    public function getId(): int
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
}
