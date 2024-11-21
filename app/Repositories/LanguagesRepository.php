<?php

namespace App\Repositories;

use App\Utils\Database;
use PDO;
use Error;
use Exception;
use App\Models\Languages;

class LanguagesRepository {

    public function getLanguages(): array | Error
    {
        
        try {
            $pdo= Database::getPDO();
            $sql = "SELECT * FROM `languages`";
            $pdoStatement =$pdo->query($sql);
            /* cette façon va directement créer un objet depuis le model language ?
               return $pdoStatement->fetchAll(PDO::FETCH_CLASS, Languages::class);*/

            $getLanguages = $pdoStatement->fetchAll(PDO::FETCH_ASSOC);
            
            return $getLanguages;
        } catch (\Throwable $error) {
            throw new Exception("La récupération des langues de développement a échoué");
        }
    }

    public function getLanguageById($id): array | bool | Error
    {
        try {
            $pdo =Database::getPDO();
            $sql = "SELECT * FROM `languages` WHERE id = :idLanguage";

            $pdoStatement = $pdo->prepare($sql);
            $pdoStatement->bindParam(':idLanguage', $id, PDO::PARAM_STR);
            $pdoStatement->execute();
            return $pdoStatement->fetch(PDO::FETCH_ASSOC);
            
        } catch (\Throwable $error) {
            throw $error;
        }
    }

    public function addLanguages():bool | Error
    {
        
        try {
            $pdo = Database::getPDO();
    
            $sql= "INSERT INTO `languages` (`label`, `picture`, `type`) VALUES (:label, :picture, :type)";

            $pdoStatement = $pdo->prepare($sql);

            $pdoStatement->bindValue(':label',  $this->label);
            $pdoStatement->bindValue(':picture',  $this->picture);
            $pdoStatement->bindValue(':type',  $this->type);

            $insertedRows = $pdoStatement->execute();

            if(!$insertedRows) {
                throw new Error("L'ajout a échoué");
            }
            return true;
        } catch (\Throwable $error) {
            throw  $error;
        }
    }

    public function updateLanguage():bool | Error
    {
        try {
            $pdo = Database::getPDO();
            $sql = "UPDATE `languages` SET label = :label, type = :type, picture = :picture WHERE id = :idLanguage";
    
            $pdoStatement = $pdo->prepare($sql);
    
            $pdoStatement->bindParam(':label', $this->label, PDO::PARAM_STR);
            $pdoStatement->bindParam(':type', $this->type, PDO::PARAM_STR);
            $pdoStatement->bindParam(':picture', $this->picture, PDO::PARAM_STR);
            $pdoStatement->bindParam(':idLanguage', $this->id, PDO::PARAM_INT);
    
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
            // dd($pdoStatement);
            // dd($pdoStatement->delete(PDO::FETCH_CLASS, Languages::class));
            return $pdoStatement->delete(PDO::FETCH_CLASS, Languages::class);

        } catch (\Throwable $th) {
            throw new Exception("Verifiez que le langage n'est pas utilisé par un projet");
            // dd('error', $th);
        }
    }

}