<?php

namespace App\Controllers;

use App\Models\Languages;
use App\Helpers\ImageHelper;
use Error;

class LanguageController extends CoreController
{
    public function technologies(): void
    {
        $this->show('technos');
    }

    public function botechnos(): void
    {
        $this->boShow('bo-technos');
    }

    public function addTechnoPage(): void
    {
        $this->boShow('bo-add-techno');
    }

    public function addTechno(): void
    {
        try {
            $languagesModel = new Languages();

            $imageHelper = new ImageHelper();

            $insertedImage = $imageHelper->languageImage();

            // Clean data with filter sanitaze
            $label = filter_input(INPUT_POST, 'label', FILTER_SANITIZE_SPECIAL_CHARS);
            $picture = $_FILES["picture"]["name"];
            $type = filter_input(INPUT_POST, 'type', FILTER_SANITIZE_SPECIAL_CHARS);


            if (!$label || !$type) {
                // alors j'execute un code d'erreur;
                throw new Error("Les données ne sont pas correctes");
            }

            $languagesModel->setLabel($label);
            $languagesModel->setPicture($picture);
            $languagesModel->setType($type);

            $insert = $languagesModel->addLanguages();

            $data = [];
           
            if (isset($insert)) {
                $data['succeeded'] = $insert;
            }

            $this->boShow('bo-add-techno', $data);
        } catch (\Throwable $error) {
            //throw $th;
            $data = [
                "message" => $error->getMessage(),
                "succeeded" => false,
            ];
            $this->boShow('bo-add-techno', $data);
        }
    }
}