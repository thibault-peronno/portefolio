<?php

namespace App\Controllers;

use App\Models\Languages;
use App\Helpers\ImageHelper;
use Error;

class LanguageController extends CoreController
{
    public function technologies(): void
    {
        $languagesModel = new Languages();
        $data = [];

        $languages = $languagesModel->getLanguages();

       foreach($languages as $language) {
            if($language->type === 'Front-end'){
                $data['languages']['front-end'][] = $language;
            }elseif($language->type === 'Back-end'){
                $data['languages']['back-end'][] = $language;
            }else{
                $data['languages']['DevOps'][] = $language;
            }
        };
        $data['arrayNumberOfProjectDevBylanguage'] = self::numberOfProjectDevBylanguage($languages);

        $this->show('technos', $data);
    }

    private static function numberOfProjectDevBylanguage($languages): array
    {
        $projectLanguageCtrl = new ProjectLanguageController();
        $data = [];
        $arrayAllLanguagesId = $projectLanguageCtrl->fetchAllLanguageId();
        foreach($languages as $language){
            
            foreach($arrayAllLanguagesId as $arrayAllLanguages){
               
                if($language->label === $arrayAllLanguages['label']){
                    $data[$language->label][] = + 1;
                }
            }
        }
        return $data;
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
        $this->boShow('admin-technos', $data);
    }

    public function addTechnoPage(): void
    {
        $this->boShow('admin-add-techno');
    }

    public function addTechno(): void
    {
        $languagesModel = new Languages();
        $imageHelper = new ImageHelper();
        $data = [];
        try {

            $imageHelper->insertedLanguageImage();

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

            $this->boShow('admin-add-techno', $data);
        } catch (\Throwable $error) {
            $data = [
                "message" => $error->getMessage(),
                "succeeded" => false,
            ];
            $this->boShow('admin-add-techno', $data);
        }
    }

    public function editTechno($idLanguage)
    {
        $languagesModel = new Languages();
        $data = [];

        $languagesModel->setId($idLanguage['id']);
        $data['language'] = $languagesModel->getLanguageById();

        $this->boShow('admin-add-techno', $data);
    }

    public function updateTechno($idLanguage)
    {
        $languagesModel = new Languages();
        $imageHelper = new ImageHelper();

        try {
            $isNoUpdateImage = $imageHelper->isNoUpdateImage();

            if (!$isNoUpdateImage) {
                $imageHelper->insertedLanguageImage();
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

            $this->boShow('admin-add-techno', $data);
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
