<?php

namespace App\Services;

class ImageService
{
    private $IMAGE_TYPES = ['image/jpeg', 'image/png'];
    // private $IMAGE_SIGN  =['FF D8 FF E3', 'FF D8 FF E0', 'FF D8 FF E8', 'FF D8 FF E0', 'FF D8 FF E1', '89 50 4E 47 0D 0A 1A 0A'];

    private function imageProcess():bool
    {
            // vérifier si j'ai une donnée dans tpm_name et que ce n'est pas vide et vérifier l'extension  et la signature de l'image
            return !empty($_FILES['picture']['name']) || !$this->checkExtension() || !$this->checkSign();
    }

    private function  checkExtension():bool
    { 
        return !in_array($_FILES['picture']['type'], $this->IMAGE_TYPES);
    }

    private function checkSign():bool
    {
        return in_array(exif_imagetype($_FILES['picture']['tmp_name']),[IMAGETYPE_JPEG, IMAGETYPE_PNG], true);
        
        // $handle = fopen($_FILES['picture']['tpm_name'], "rb");
        // $read = fread($handle, 8);
        // dump('read', $read);
        // return !in_array($read, $this->IMAGE_SIGN);
    }

    public function languageImage()
    {
        try {
            if(!$this->imageProcess()){
                throw new \Exception("Error Processing Request", 1);
            }
            $retour = copy($_FILES['photo']['tmp_name'], "/assets/images/languages/" . $_FILES['photo']['name']);
            if($retour) {
                return true;
            }
        } catch (\Throwable $error) {
            //throw $th;
            $error->getMessage();
            return false;
        }
    }

    public function organizationImage()
    {
        try {
            if(!$this->imageProcess()){
                throw new \Exception("Error Processing Request", 1);
            }
            $retour = copy($_FILES['photo']['tmp_name'], "/assets/images/organizations/" . $_FILES['photo']['name']);
            if($retour) {
                return true;
            }
        } catch (\Throwable $error) {
            //throw $th;
            $error->getMessage();
            return false;
        }

    }

}
