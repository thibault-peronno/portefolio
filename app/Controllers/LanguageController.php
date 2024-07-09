<?php

namespace App\Controllers;

use App\Models\Languages;
use App\Helpers\ImageHelper;
use App\Utils\Database;
use Error;

class LanguageController extends CoreController
{
    public function technologies(): void
    {
        $this->show('technos');
    }

    public function boTechnos(): void
    {
        $languagesModel = new Languages();
        $data = [];

        $getLanguages = $languagesModel->getLanguages();
        foreach ($getLanguages as $getLanguage) {
            if (in_array("Front-end", (array) $getLanguage)) {
                $data['languages']['frontend'][] = $getLanguage;
                continue;
            }
            if (in_array("Back-end", (array) $getLanguage)) {
                $data['languages']['backend'][] = $getLanguage;
                continue;
            }
            if (in_array("DevOps", (array) $getLanguage)) {
                $data['languages']['devOps'][] = $getLanguage;
                continue;
            }
        }
        $this->boShow('bo-technos', $data);
    }

    public function addTechnoPage(): void
    {
        $this->boShow('bo-add-techno');
    }

    public function addTechno(): void
    {
        $languagesModel = new Languages();
        $imageHelper = new ImageHelper();
        $data = [];
        try {

            $imageHelper->isInsertedLanguageImage();

            // if(!$insertedImage){
            //     throw new Error("Ajout échouée. Le fichier n'a pas pu être sauvegardé");
            // }

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

            if (isset($insert)) {
                $data['succeeded'] = $insert;
            }

            $this->boShow('bo-add-techno', $data);
        } catch (\Throwable $error) {
            $data = [
                "message" => $error->getMessage(),
                "succeeded" => false,
            ];
            $this->boShow('bo-add-techno', $data);
        }
    }

    public function editTechno($idLanguage)
    {
        $languagesModel = new Languages();
        $data = [];

        $languagesModel->setId($idLanguage['id']);
        $data['language'] = $languagesModel->getLanguageById();

        $this->boShow('bo-add-techno', $data);
    }

    public function updateTechno($idLanguage)
    {
        $languagesModel = new Languages();
        $imageHelper = new ImageHelper();

        try {
            $isNoUpdateImage = $imageHelper->isNoUpdateImage();

            if (!$isNoUpdateImage) {
                $imageHelper->isInsertedLanguageImage();
            }

            if (!$isNoUpdateImage) {
                $picture = $_FILES["picture"]["name"];
            } else {
                $picture = htmlspecialchars($_POST['picture']);
            }

            $languagesModel->setId(intval($idLanguage['id']));
            $languagesModel->setLabel(htmlspecialchars($_POST['label']));
            $languagesModel->setPicture($picture);
            $languagesModel->setType(htmlspecialchars($_POST['type']));

            $insert = $languagesModel->updateLanguage();

            if ($insert || !$insert) {
                $data['succeeded'] = $insert;
            }

            $this->boShow('bo-add-techno', $data);
        } catch (\Throwable $th) {
            //throw $th;
        }
    }

    public function boDeleteTechnos($labelId)
    {
        $languagesModel = new Languages();
        $languagesModel->deleteLanguage((int)$labelId['id']);
    }
}
