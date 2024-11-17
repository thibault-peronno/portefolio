<?php

namespace App\Helpers;

use Exception;

class ImageHelper
{
    private $IMAGE_TYPES = ['image/jpeg', 'image/png'];

    public function insertedLanguageImage():bool | Exception
    {
        try {
            if (!$this->imageProcess()) {
                throw new Exception("L'image n'est pas valide");
            }
            // Check if image with same name exist
            if (file_exists(__DIR__ . "/../../public/assets/images/languages/" . $_FILES["picture"]["name"])) {
                throw new Exception("Le fichier existe déjà");
            };
            // copy the picture from cache to directory I want
            return copy($_FILES['picture']['tmp_name'], "./assets/images/languages/" . $_FILES['picture']['name']);
        } catch (\Throwable $error) {
            throw $error;
        }
    }

    public function insertedOrganizationImage():bool | Exception
    {
        try {
            if (!$this->imageProcess()) {
                throw new Exception("L'image n'est pas valide");
            }
            if (file_exists(__DIR__ . "/../../public/assets/images/organizations/" . $_FILES["picture"]["name"])) {
                throw new Exception("Le fichier existe déjà");
            };
            return copy($_FILES['picture']['tmp_name'], "./assets/images/organizations/" . $_FILES['picture']['name']);
        } catch (\Throwable $error) {
            throw $error;
        }
    }

    public function insertedProjectImage():bool | Exception
    {
        try {
            if (!$this->imageProcess()) {
                throw new Exception("L'image n'est pas valide");
            }
            if (file_exists(__DIR__ . "/../../public/assets/images/projects/" . $_FILES["picture"]["name"])) {
                throw new Exception("Le fichier existe déjà");
            };
            return copy($_FILES['picture']['tmp_name'], "./assets/images/projects/" . $_FILES['picture']['name']);
        } catch (\Throwable $error) {
            throw $error;
        }
    }

    public function isNoUpdateImage(): bool | Exception
    {
        try {
            if (!isset($_FILES['picture'])) {
                return false;
            };
            return true;
        } catch (\Throwable $error) {
            throw $error;
        }
    }
    // To check if I have data in tmp_name and it is not empty. I call the method to check the extension file, and the method to check the sign of the picture.
    private function imageProcess():bool | Exception
    {
        try {
            return !empty($_FILES['picture']['name']) || $this->checkExtension() || $this->checkSign();
        } catch (\Throwable $error) {
            throw $error;
        }
    }
    // To check the extension file.
    private function  checkExtension():bool | Exception
    {
        try {
            return in_array($_FILES['picture']['type'], $this->IMAGE_TYPES);
        } catch (\Throwable $error) {
            throw $error;
        }
    }
    // To check the sign of the picture. One more security.
    private function checkSign():bool | Exception
    {
        try {
            return in_array(exif_imagetype($_FILES['picture']['tmp_name']), [IMAGETYPE_JPEG, IMAGETYPE_PNG], true);
        } catch (\Throwable $error) {
            throw $error;
        }
    }

}
