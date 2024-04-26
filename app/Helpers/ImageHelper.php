<?php

namespace App\Helpers;

use Error;

class ImageHelper
{
    private $IMAGE_TYPES = ['image/jpeg', 'image/png'];

    // To check if I have data in tmp_name and it is not empty. I call the method to check the extension file, and the method to check the sign of the picture.
    private function imageProcess():bool
    {
        return !empty($_FILES['picture']['name']) || $this->checkExtension() || $this->checkSign();
    }
    // To check the extension file.
    private function  checkExtension():bool
    {
        return in_array($_FILES['picture']['type'], $this->IMAGE_TYPES);
    }
    // To check the sign of the picture. One more security.
    private function checkSign():bool
    {
        return in_array(exif_imagetype($_FILES['picture']['tmp_name']), [IMAGETYPE_JPEG, IMAGETYPE_PNG], true);
    }

    public function languageImage():bool | Error
    {
        try {
            if (!$this->imageProcess()) {
                throw new Error("L'image n'est pas valide");
            }
            // Check if image with same name exist
            if (file_exists(__DIR__ . "/../../public/assets/images/languages/" . $_FILES["picture"]["name"])) {
                throw new Error("Le fichier existe déjà");
            };
            // copy the picture from cache to directory I want
            return copy($_FILES['picture']['tmp_name'], "./assets/images/languages/" . $_FILES['picture']['name']);
        } catch (\Throwable $error) {
            // I return a throw error, to handle in the method where I have called it
            throw $error;
        }
    }

    public function organizationImage():bool | Error
    {
        try {
            if (!$this->imageProcess()) {
                throw new Error("L'image n'est pas valide");
            }
            if (file_exists(__DIR__ . "/../../public/assets/images/organizations/" . $_FILES["picture"]["name"])) {
                throw new Error("Le fichier existe déjà");
            };
            return copy($_FILES['picture']['tmp_name'], "./assets/images/organizations/" . $_FILES['picture']['name']);
        } catch (\Throwable $error) {
            throw $error;
        }
    }
}
