<?php 

namespace App\Models;

use App\Utils\Database;
use PDO;
use Error;

class Languages 
{
    private $id;
    private $label;
    private $picture;
    private $type;

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

            // dump($insertedRows, $insertedRows->rowCount()>0);
            // die;

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