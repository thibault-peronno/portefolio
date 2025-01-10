<?php

namespace App\Controllers;

use App\Models\Languages;
use App\Helpers\ImageHelper;
use App\Helpers\languagesHelper;
use App\Repositories\LanguagesRepository;
use Error;

class LanguageController extends CoreController
{
    public function languages(): void
    {
        try {
            $languagesRepository = new LanguagesRepository();
            $languagesHelper = new languagesHelper();
            $data = [];

            $languages = $languagesRepository->getLanguages();

            $data['languages']['Front-end'] = $languagesHelper->sortLangageByFrontType($languages);
            $data['languages']['Back-end'] = $languagesHelper->sortLangageByBackType($languages);
            $data['languages']['DevOps'] = $languagesHelper->sortLangageByDevopsType($languages);
            // foreach ($languages as $language) {
            //     if ($language->type === 'Front-end') {
            //         $data['languages']['Front-end'][] = $language;
            //     } elseif ($language->type === 'Back-end') {
            //         $data['languages']['Back-end'][] = $language;
            //     } elseif ($language->type === 'DevOps') {
            //         $data['languages']['DevOps'][] = $language;
            //     }
            // };
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
                    
                    if ($language->label === $arrayAllLanguages['label']) {
                        $data[$language->label][0] = $data[$language->label][0] +1;
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
            $languagesHelper = new languagesHelper();
            $data = [];

            $languages = $languagesRepository->getLanguages();

            $data['languages']['Front-end'] = $languagesHelper->sortLangageByFrontType($languages);
            $data['languages']['Back-end'] = $languagesHelper->sortLangageByBackType($languages);
            $data['languages']['DevOps'] = $languagesHelper->sortLangageByDevopsType($languages);
            // foreach ($languages as $language) {
            //     if ($language->type === 'Front-end') {
            //         $data['languages']['Front-end'][] = $language;
            //     } elseif ($language->type === 'Back-end') {
            //         $data['languages']['Back-end'][] = $language;
            //     } elseif ($language->type === 'DevOps') {
            //         $data['languages']['DevOps'][] = $language;
            //     }
            // };

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

    public function editTechno($idLanguage): void
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

    public function updateTechno($idLanguage): void
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

            $languagesModel->setLabel(htmlspecialchars($_POST['label']));
            $languagesModel->setPicture($picture);
            $languagesModel->setType(htmlspecialchars($_POST['type']));

            $insert = $languagesRepository->updateLanguage($idLanguage);

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

    public function boDeleteTechnos($labelId): void
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
