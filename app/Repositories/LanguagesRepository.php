<?php

namespace App\Repositories;

use App\Utils\Database;
use App\Models\Languages;
use PDO;
use Error;
use Exception;

class LanguagesRepository
{

    public function get_languages(): array | Error
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

                $languageModel->set_id($getLanguage['id']);
                $languageModel->set_label($getLanguage['label']);
                $languageModel->set_picture($getLanguage['picture']);
                $languageModel->set_type($getLanguage['type']);

                return $languageModel;
            }, $allLanguages);

            return $getLanguages;
        } catch (\Throwable $error) {
            throw new Exception("La récupération des langues de développement a échoué");
        }
    }

    public function get_language_by_id(string $id): Languages
    {
        try {
            $pdo = Database::getPDO();
            $sql = "SELECT * FROM `languages` WHERE id = :idLanguage";

            $pdoStatement = $pdo->prepare($sql);
            $pdoStatement->bindParam(':idLanguage', $id, PDO::PARAM_STR);
            $pdoStatement->execute();
            $language = $pdoStatement->fetch(PDO::FETCH_ASSOC);

            $languagesModel = new Languages();

            $languagesModel->set_id($language['id']);
            $languagesModel->set_label($language['label']);
            $languagesModel->set_picture($language['picture']);
            $languagesModel->set_type($language['type']);
            
            return $languagesModel;
        } catch (\Throwable $error) {
            throw $error;
        }
    }

    public function add_an_language(string $label, string $picture, string $type): array | Error
    {
        try {
            if (!$label || $picture || !$type) {
                return [
                    "message" => "L'ajout a échoué : une donnée n'est pas correcte.",
                    "succeeded" => false,
                ];
            }
            $pdo = Database::getPDO();
            $sql = "INSERT INTO `languages` (`label`, `picture`, `type`) VALUES (:label, :picture, :type)";

            $pdoStatement = $pdo->prepare($sql);

            $pdoStatement->bindValue(':label',  $label);
            $pdoStatement->bindValue(':picture',  $picture);
            $pdoStatement->bindValue(':type',  $type);

            $insertedRows = $pdoStatement->execute();

            if (!$insertedRows) {
                return [
                    "message" => "L'ajout a échoué.",
                    "succeeded" => false,
                ];
            }
            return [
                "message" => "L'ajout a réussi.",
                "succeeded" => true,
            ];
        } catch (\Throwable $error) {
            throw new Error("Une erreur est survenue");
        }
    }

    public function update_language_repository(string $id, string $label, string $picture, string $type): array
    {
        try {
            $pdo = Database::getPDO();
            $sql = "UPDATE `languages` SET label = :label, type = :type, picture = :picture WHERE id = :idLanguage";

            $pdoStatement = $pdo->prepare($sql);

            $pdoStatement->bindParam(':label', $label, PDO::PARAM_STR);
            $pdoStatement->bindParam(':type', $type, PDO::PARAM_STR);
            $pdoStatement->bindParam(':picture', $picture, PDO::PARAM_STR);
            $pdoStatement->bindParam(':idLanguage', $id, PDO::PARAM_INT);

            $insertedRows = $pdoStatement->execute();
            
            if ($insertedRows > 0) {
                return [
                    "message" => "La mise à jour a réussi.",
                    "succeeded" => true,
                ];
            }
            return [
                "message" => "La mise à jour a échoué.",
                "succeeded" => false,
            ];
        } catch (\Throwable $error) {
            throw new Error("Une erreur est survenue.");
        }
    }

    public function delete_language_repository(string $id)
    {
        try {
            $pdo = Database::getPDO();
            $sql = "DELETE FROM `languages` WHERE `id` = $id";

            $pdoStatement = $pdo->query($sql);

            return $pdoStatement->delete(PDO::FETCH_CLASS, Languages::class);
            // A travailler
            // return [
            //     "message" => "Verifiez que le langage n'est pas utilisé par un projet",
            //     "succeeded" => false,
            // ];
        } catch (\Throwable $th) {
            throw new Exception("Une erreur est survenue.");
        }
    }
}
