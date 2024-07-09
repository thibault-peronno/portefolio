<?php 

namespace App\Models;

use App\Utils\Database;
use PDO;
use Error;
use Exception;

class Languages
{
    public $id;
    public $label;
    public $picture;
    public $type;

    public function getLanguages(): array
    {
        $pdo= Database::getPDO();
        $sql = "SELECT * FROM `languages`";

        try {
            $pdoStatement =$pdo->query($sql);
            return $pdoStatement->fetchAll(PDO::FETCH_CLASS, Languages::class);
        } catch (\Throwable $error) {
            dump('getLanguages model' , $error);
            throw new Exception("La récupération des langues de développement a échoué");
        }
    }

    public function getLanguageById(): array | bool
    {
        $pdo =Database::getPDO();
        $sql = "SELECT * FROM `languages` WHERE id = :idLanguage";
        try {
            $pdoStatement = $pdo->prepare($sql);
            $pdoStatement->bindParam(':idLanguage', $this->id, PDO::PARAM_STR);
            $pdoStatement->execute();
            return $pdoStatement->fetch(PDO::FETCH_ASSOC);
            
        } catch (\Throwable $th) {
            //throw $th;
        }
    }

    public function addLanguages():bool | Error
    {
        $pdo = Database::getPDO();

        $sql= "INSERT INTO `languages` (`label`, `picture`, `type`) VALUES (:label, :picture, :type)";

        try {
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
            // $pdo->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);
            // dump($error->getMessage());
            // die;
            return $error;
        }
    }

    public function deleteLanguage($idLabel)
    {
        // dd($idLabel);
        $pdo = Database::getPDO();
        $sql = "DELETE FROM `languages` WHERE `id` = $idLabel";
        // dd($sql);
        try {
            $pdoStatement = $pdo->query($sql);
            // dd($pdoStatement);
            // dd($pdoStatement->delete(PDO::FETCH_CLASS, Languages::class));
            return $pdoStatement->delete(PDO::FETCH_CLASS, Languages::class);

        } catch (\Throwable $th) {
            throw new Exception("Verifiez que le langage n'est pas utilisé par un projet");
            // dd('error', $th);
        }
    }


    public function getId():int
    {
        return $this->id;
    }
    public function setId($id):self
    {
        $this->id = $id;
        return $this;
    }

    public function getLabel():int
    {
        return $this->label;
    }
    public function setLabel($label):self
    {
        $this->label = $label;
        return $this;
    }

    public function getPicture():int
    {
        return $this->picture;
    }
    public function setPicture($picture):self
    {
        $this->picture = $picture;
        return $this;
    }

    public function getType():int
    {
        return $this->type;
    }
    public function setType($type):self
    {
        $this->type = $type;
        return $this;
    }
}