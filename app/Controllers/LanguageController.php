<?php

namespace App\Controllers;

use App\Models\Languages;
use App\Helpers\ImageHelper;
use App\Repositories\LanguagesRepository;
use Error;

class LanguageController extends CoreController
{
    public function languages(): void
    {
        try {
            $languagesRepository = new LanguagesRepository();
            $data = [];

            $languages = $languagesRepository->getLanguages();
            
            foreach ($languages as $language) {
                // dump($language);
                $languagesModel = new Languages();
                if ($language['type'] === 'Front-end') {
                    $languagesModel->setId($language['id']);
                    $languagesModel->setLabel($language['label']);
                    $languagesModel->setPicture($language['picture']);
                    $languagesModel->setType($language['type']);
                    $data['languages']['front-end'][] = $languagesModel;
                } elseif ($language['type'] === 'Back-end') {
                    $languagesModel->setId($language['id']);
                    $languagesModel->setLabel($language['label']);
                    $languagesModel->setPicture($language['picture']);
                    $languagesModel->setType($language['type']);
                    $data['languages']['back-end'][] = $languagesModel;
                } elseif ($language['type'] === 'DevOps') {
                    $languagesModel->setId($language['id']);
                    $languagesModel->setLabel($language['label']);
                    $languagesModel->setPicture($language['picture']);
                    $languagesModel->setType($language['type']);
                    $data['languages']['DevOps'][] = $languagesModel;
                }
            };
            $data['arrayNumberOfProjectDevBylanguage'] = self::numberOfProjectDevBylanguage($languages);
            
            $this->show('technos', $data);
        } catch (\Throwable $error) {
            $data = [
                "message" => $error->getMessage(),
                "succeeded" => false,
            ];
            $this->show('error', $data);
        }
    }

    // possibilité de le mettre dans un service à la place.
    private static function numberOfProjectDevBylanguage($languages): array
    {
        try {
            $projectLanguageCtrl = new ProjectLanguageController();
            $data = [];
            $arrayAllLanguagesId = $projectLanguageCtrl->fetchAllLanguageId();
            foreach ($languages as $language) {

                foreach ($arrayAllLanguagesId as $arrayAllLanguages) {

                    if ($language['label'] === $arrayAllLanguages['label']) {
                        $data[$language['label']][] = +1;
                    }
                }
            }
            return $data;
        } catch (\Throwable $error) {
            throw $error;
        }
    }

    public function boTechnos(): void
    {
        try {
            $languagesRepository = new LanguagesRepository();
            $data = [];

            $getLanguages = $languagesRepository->getLanguages();

            foreach ($getLanguages as $getLanguage) {
                $languagesModel = new Languages();
                if (in_array("Front-end", (array) $getLanguage)) {
                    $languagesModel->setId($getLanguage['id']);
                    $languagesModel->setLabel($getLanguage['label']);
                    $languagesModel->setPicture($getLanguage['picture']);
                    $languagesModel->setType($getLanguage['type']);
                    $data['languages']['frontend'][] = $languagesModel;
                    continue;
                }
                if (in_array("Back-end", (array) $getLanguage)) {
                    $languagesModel->setId($getLanguage['id']);
                    $languagesModel->setLabel($getLanguage['label']);
                    $languagesModel->setPicture($getLanguage['picture']);
                    $languagesModel->setType($getLanguage['type']);
                    $data['languages']['backend'][] = $languagesModel;
                    continue;
                }
                if (in_array("DevOps", (array) $getLanguage)) {
                    $languagesModel->setId($getLanguage['id']);
                    $languagesModel->setLabel($getLanguage['label']);
                    $languagesModel->setPicture($getLanguage['picture']);
                    $languagesModel->setType($getLanguage['type']);
                    $data['languages']['devOps'][] = $languagesModel;
                    continue;
                }
            }
            
            $this->boShow('admin-technos', $data);
        } catch (\Throwable $error) {
            $data = [
                "message" => $error->getMessage(),
                "succeeded" => false,
            ];
            $this->show('error', $data);
        }
    }

    public function addTechnoPage(): void
    {
        $this->boShow('admin-add-techno');
    }

    public function addTechno(): void
    {
        try {
            $languagesRepository = new LanguagesRepository();
            $languagesModel = new Languages();
            $imageHelper = new ImageHelper();
            $data = [];

            $insertedImage = $imageHelper->insertedLanguageImage();

            if (!$insertedImage) {
                throw new Error("Ajout échouée. Le fichier n'a pas pu être sauvegardé");
            }

            // Clean data with filter sanitaze
            $label = filter_input(INPUT_POST, 'label', FILTER_SANITIZE_SPECIAL_CHARS);
            $picture = $_FILES["picture"]["name"];
            $type = filter_input(INPUT_POST, 'type', FILTER_SANITIZE_SPECIAL_CHARS);


            if (!$label || !$type) {
                throw new Error("Les données ne sont pas correctes");
            }

            $languagesModel->setLabel($label);
            $languagesModel->setPicture($picture);
            $languagesModel->setType($type);

            $insert = $languagesRepository->addLanguages();

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
        try {
            $languagesRepository = new LanguagesRepository();
            $languagesModel = new Languages();
            $data = [];

            // $languagesModel->setId($idLanguage['id']);
            $language = $languagesRepository->getLanguageById($idLanguage['id']);

            $languagesModel->setId($language['id']);
            $languagesModel->setLabel($language['label']);
            $languagesModel->setPicture($language['picture']);
            $languagesModel->setType($language['type']);

            $data['language'] = $languagesModel;

            $this->boShow('admin-add-techno', $data);
        } catch (\Throwable $error) {
            $data = [
                "message" => $error->getMessage(),
                "succeeded" => false,
            ];
            $this->boShow('admin-add-techno', $data);
        }
    }

    public function updateTechno($idLanguage)
    {

        try {
            $languagesRepository = new LanguagesRepository();
            $languagesModel = new Languages();
            $imageHelper = new ImageHelper();
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

            $insert = $languagesRepository->updateLanguage();

            if ($insert || !$insert) {
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

    public function boDeleteTechnos($labelId)
    {
        try {
            $languagesRepository = new LanguagesRepository();
            $languagesRepository->deleteLanguage((int)$labelId['id']);
        } catch (\Throwable $error) {
            $data = [
                "message" => $error->getMessage(),
                "succeeded" => false,
            ];
            $this->boShow('admin-add-techno', $data);
        }
    }
}
