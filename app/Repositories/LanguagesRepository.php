<?php

namespace App\Repositories;

use App\Utils\Database;
use App\Models\Languages;
use PDO;
use Error;
use Exception;

class LanguagesRepository
{

    public function getLanguages(): array | Error
    {

        try {
            $pdo = Database::getPDO();
            $sql = "SELECT * FROM `languages`";
            $pdoStatement = $pdo->query($sql);
            /* cette façon va directement créer un objet depuis le model language ?
               return $pdoStatement->fetchAll(PDO::FETCH_CLASS, Languages::class);*/

            $allLanguages = $pdoStatement->fetchAll(PDO::FETCH_ASSOC);

            $getLanguages = array_map(function ($getLanguage) {
                $languageModel = new Languages();

                $languageModel->setId($getLanguage['id']);
                $languageModel->setLabel($getLanguage['label']);
                $languageModel->setPicture($getLanguage['picture']);
                $languageModel->setType($getLanguage['type']);

                return $languageModel;
            }, $allLanguages);

            return $getLanguages;
        } catch (\Throwable $error) {
            throw new Exception("La récupération des langues de développement a échoué");
        }
    }

    public function getLanguageById($id): array | bool | Error
    {
        try {
            $pdo = Database::getPDO();
            $sql = "SELECT * FROM `languages` WHERE id = :idLanguage";

            $pdoStatement = $pdo->prepare($sql);
            $pdoStatement->bindParam(':idLanguage', $id, PDO::PARAM_STR);
            $pdoStatement->execute();
            return $pdoStatement->fetch(PDO::FETCH_ASSOC);
        } catch (\Throwable $error) {
            throw $error;
        }
    }

    public function addLanguages(): bool | Error
    {

        try {
            $languageModel = new Languages();
            $pdo = Database::getPDO();

            $sql = "INSERT INTO `languages` (`label`, `picture`, `type`) VALUES (:label, :picture, :type)";

            $pdoStatement = $pdo->prepare($sql);

            $pdoStatement->bindValue(':label',  $languageModel->getLabel());
            $pdoStatement->bindValue(':picture',  $languageModel->getPicture());
            $pdoStatement->bindValue(':type',  $languageModel->getType());

            $insertedRows = $pdoStatement->execute();

            if (!$insertedRows) {
                throw new Error("L'ajout a échoué");
            }
            return true;
        } catch (\Throwable $error) {
            throw  $error;
        }
    }

    public function updateLanguage(int $id)
    {
        try {
            $languageModel = new Languages();
            $pdo = Database::getPDO();
            $sql = "UPDATE `languages` SET label = :label, type = :type, picture = :picture WHERE id = :idLanguage";

            $pdoStatement = $pdo->prepare($sql);

            $pdoStatement->bindParam(':label', $languageModel->getLabel(), PDO::PARAM_STR);
            $pdoStatement->bindParam(':type', $languageModel->getType(), PDO::PARAM_STR);
            $pdoStatement->bindParam(':picture', $languageModel->getPicture(), PDO::PARAM_STR);
            $pdoStatement->bindParam(':idLanguage', $id, PDO::PARAM_INT);

            $insertedRows = $pdoStatement->execute();

            if ($insertedRows > 0) {
                // We retrieve the last id.
                return true;
            }
        } catch (\Throwable $error) {
            throw $error;
        }
    }

    public function deleteLanguage($id)
    {
        try {
            $pdo = Database::getPDO();
            $sql = "DELETE FROM `languages` WHERE `id` = $id";
            $pdoStatement = $pdo->query($sql);
            return $pdoStatement->delete(PDO::FETCH_CLASS, Languages::class);
        } catch (\Throwable $th) {
            throw new Exception("Verifiez que le langage n'est pas utilisé par un projet");
        }
    }
}
