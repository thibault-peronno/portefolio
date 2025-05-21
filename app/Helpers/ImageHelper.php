<?php

namespace App\Helpers;

use Exception;

class ImageHelper
{
    private $IMAGE_TYPES = ['image/jpeg', 'image/png'];

    /**
     * Insère une image de langue dans le système
     *
     * @param string $fileName        Le nom du fichier image
     * @param string $fileTmpName     Le chemin temporaire du fichier
     * @param string $fileType        Le type MIME du fichier
     *
     * @return bool                  true si l'opération réussit, false sinon
     *
     * @throws Exception             Si l'image n'est pas valide ou si le fichier existe déjà
     */
    public function inserted_language_image(string $fileName , string $fileTmpName, string $fileType): bool
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

    /**
     * Insère une image de langue dans le système
     *
     * @param string $fileName        Le nom du fichier image
     * @param string $fileTmpName     Le chemin temporaire du fichier
     * @param string $fileType        Le type MIME du fichier
     *
     * @return bool                  true si l'opération réussit, false sinon
     *
     * @throws Exception             Si l'image n'est pas valide ou si le fichier existe déjà
     */
    public function inserted_organization_image(string $fileName, string $fileTmpName, string $fileType)
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
    
    /**
     * Insère une image de langue dans le système
     *
     * @param string $fileName        Le nom du fichier image
     * @param string $fileTmpName     Le chemin temporaire du fichier
     * @param string $fileType        Le type MIME du fichier
     *
     * @return bool                  true si l'opération réussit, false sinon
     *
     * @throws Exception             Si l'image n'est pas valide ou si le fichier existe déjà
     */
    public function inserted_project_image(string $fileName, string $fileTmpName, string $fileType): bool
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

    /**
     * Check if the image had to update
     *
     * @param array $filePicture     
     *
     * @return bool true si l'opération réussit, false sinon
     *
     * @throws Exception Si l'image n'est pas valide ou si le fichier existe déjà
     */
    public function is_update_image(array $filePicture): bool | Exception
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
    
    /**
     * To check if I have data in tmp_name and it is not empty. 
     * I call the method to check the extension file, and the method to check the sign of the picture.
     *
     * @param string $fileName        Le nom du fichier image
     * @param string $fileTmpName     Le chemin temporaire du fichier
     * @param string $fileType        Le type MIME du fichier
     *
     * @return bool                  true si l'opération réussit, false sinon
     *
     * @throws Exception             appelle plusieurs verifications : nom, extension, signature
     */
    private function image_process(string $fileName, string $fileTmpName, string $fileType): bool | Exception
    {
        try {
            return !empty($fileName) || $this->check_extension($fileType) || $this->check_signature($fileTmpName);
        } catch (\Throwable $error) {
            throw $error;
        }
    }
    
    /**
     * Check the extension file.
     *
     * @param string $fileType        Le type MIME du fichier
     *
     * @return bool                  true si l'opération réussit, false sinon
     *
     * @throws Exception             Si l'extension n'est pas valide
     */
    private function  check_extension(string $fileType): bool | Exception
    {
        try {
            return in_array($fileType, $this->IMAGE_TYPES);
        } catch (\Throwable $error) {
            throw $error;
        }
    }

    /**
     * Check the sign of the picture. One more security.
     *
     * @param string $fileTmpName        Le chemin temporaire du fichier
     *
     * @return bool                  true si l'opération réussit, false sinon
     *
     * @throws Exception             Si l'extension n'est pas valide
     */
    private function check_signature(string $fileTmpName): bool | Exception
    {
        try {
            return in_array(exif_imagetype($fileTmpName), [IMAGETYPE_JPEG, IMAGETYPE_PNG], true);
        } catch (\Throwable $error) {
            throw $error;
        }
    }
}
