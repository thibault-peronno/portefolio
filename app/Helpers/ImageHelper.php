<?php

namespace App\Helpers;

use Exception;

class ImageHelper
{
    private $IMAGE_TYPES = ['image/jpeg', 'image/png'];

    public function inserted_language_image($fileName , $fileTmpName, $fileType)
    {
        try {
            if (!$this->image_process($fileName, $fileTmpName, $fileType)) {
                throw new Exception("L'image n'est pas valide");
            }
            // Check if image with same name exist
            if (file_exists(__DIR__ . "/../../public/assets/images/languages/" . $fileName)) {
                throw new Exception("Le fichier existe déjà");
            };
            // copy the picture from cache to directory I want
            return copy($fileTmpName, "./assets/images/languages/" . $fileName);
        } catch (\Throwable $error) {
            throw $error;
        }
    }

    public function inserted_organization_image($fileName, $fileTmpName, $fileType)
    {
        try {
            if (!$this->image_process($fileName, $fileTmpName, $fileType)) {
                throw new Exception("L'image n'est pas valide");
            }
            if (file_exists(__DIR__ . "/../../public/assets/images/organizations/" . $fileName)) {
                throw new Exception("Le fichier existe déjà");
            };
            return copy($fileTmpName, "./assets/images/organizations/" . $fileName);
        } catch (\Throwable $error) {
            throw $error;
        }
    }
    
    public function inserted_project_image($fileName, $fileTmpName, $fileType)
    {
        try {
            if (!$this->image_process($fileName, $fileTmpName, $fileType)) {
                throw new Exception("L'image n'est pas valide");
            }
            if (file_exists(__DIR__ . "/../../public/assets/images/projects/" . $fileName)) {
                throw new Exception("Le fichier existe déjà");
            };
            return copy($fileTmpName, "./assets/images/projects/" . $fileName);
        } catch (\Throwable $error) {
            throw $error;
        }
    }

    public function is_update_image($filePicture): bool | Exception
    {
        try {
            if (!isset($filePicture)) {
                return false;
            };
            return true;
        } catch (\Throwable $error) {
            throw $error;
        }
    }
    // To check if I have data in tmp_name and it is not empty. I call the method to check the extension file, and the method to check the sign of the picture.
    private function image_process($fileName, $fileTmpName, $fileType): bool | Exception
    {
        try {
            return !empty($fileName) || $this->check_extension($fileType) || $this->check_signature($fileTmpName);
        } catch (\Throwable $error) {
            throw $error;
        }
    }
    // To check the extension file.
    private function  check_extension($fileType): bool | Exception
    {
        try {
            return in_array($fileType, $this->IMAGE_TYPES);
        } catch (\Throwable $error) {
            throw $error;
        }
    }
    // To check the sign of the picture. One more security.
    private function check_signature($fileTmpName): bool | Exception
    {
        try {
            return in_array(exif_imagetype($fileTmpName), [IMAGETYPE_JPEG, IMAGETYPE_PNG], true);
        } catch (\Throwable $error) {
            throw $error;
        }
    }
}
