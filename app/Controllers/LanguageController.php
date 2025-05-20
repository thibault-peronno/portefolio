<?php

namespace App\Controllers;

use App\Models\Languages;
use App\Helpers\ImageHelper;
use App\Helpers\languagesHelper;
use App\Repositories\LanguagesRepository;
use App\Repositories\ProjectLanguageRepository;
use Error;

class LanguageController extends CoreController
{
    public function display_languages_page(): void
    {
        try {
            $languagesRepository = new LanguagesRepository();
            $languagesHelper = new languagesHelper();
            $data = [];

            $languages = $languagesRepository->get_languages();
            $data['languages']['Front-end'] = $languagesHelper->sort_langages_by_type($languages);
            $data['languages']['Back-end'] = $languagesHelper->sortLangageByBackType($languages);
            $data['languages']['DevOps'] = $languagesHelper->sortLangageByDevopsType($languages);

            $data['arrayNumberOfProjectDevBylanguage'] = self::count_number_of_project_dev_by_language($languages);
            
            $this->page_to_display('technos', $data);
        } catch (\Throwable $error) {
            $data = [
                "message" => $error->getMessage(),
                "succeeded" => false,
            ];
            $this->page_to_display('error', $data);
        }
    }

    // possibilité de le mettre dans un service à la place.
    private static function count_number_of_project_dev_by_language($languages): array
    {
 
        try {
            $projectLanguageRepository = new ProjectLanguageRepository();
            $data = [];
            $arrayAllLanguagesId = $projectLanguageRepository->getLabelLanguageFromProjectLanguagesId();
            foreach ($languages as $language) {
                
                foreach ($arrayAllLanguagesId as $arrayAllLanguages) {
                    
                    if ($language->get_label() === $arrayAllLanguages['label']) {
                        $data[$language->get_label()][0] = $data[$language->get_label()][0] +1;
                    }
                }
            }

            return $data;
        } catch (\Throwable $error) {
            throw $error;
        }
    }

    public function display_admin_languages_page(): void
    {
        try {
            $languagesRepository = new LanguagesRepository();
            $languagesHelper = new languagesHelper();
            $data = [];

            $languages = $languagesRepository->get_languages();

            $data['languages']['Front-end'] = $languagesHelper->sort_langages_by_type($languages);
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

            $this->admin_page_to_display('admin-technos', $data);
        } catch (\Throwable $error) {
            $data = [
                "message" => $error->getMessage(),
                "succeeded" => false,
            ];
            $this->page_to_display('error', $data);
        }
    }

    public function display_add_languages_page(): void
    {
        try {
            $this->admin_page_to_display('admin-add-techno');
            
        } catch (\Throwable $error) {
            $data = [
                "message" => $error->getMessage(),
                "succeeded" => false,
            ];
            $this->admin_page_to_display('admin-add-techno', $data);
        }
    }

    public function add_a_languages(): void
    {
        try {
            $languagesRepository = new LanguagesRepository();
            $languagesModel = new Languages();
            $imageHelper = new ImageHelper();
            $data = [];

            $insertedImage = $imageHelper->inserted_language_image($_FILES["picture"]["name"], $_FILES['picture']['tmp_name'], $_FILES['picture']['type']);

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

            $languagesModel->set_label($label);
            $languagesModel->set_picture($picture);
            $languagesModel->set_type($type);

            $insert = $languagesRepository->add_an_language();

            if (isset($insert)) {
                $data['succeeded'] = $insert;
            }

            $this->admin_page_to_display('admin-add-techno', $data);
        } catch (\Throwable $error) {
            $data = [
                "message" => $error->getMessage(),
                "succeeded" => false,
            ];
            $this->admin_page_to_display('admin-add-techno', $data);
        }
    }

    public function display_edit_languages_page(array $idLanguage): void
    {
        try {
            $languagesRepository = new LanguagesRepository();
            $languagesModel = new Languages();
            $data = [];

            // $languagesModel->set_id($idLanguage['id']);
            $language = $languagesRepository->get_language_by_id($idLanguage['id']);

            $languagesModel->set_id($language['id']);
            $languagesModel->set_label($language['label']);
            $languagesModel->set_picture($language['picture']);
            $languagesModel->set_type($language['type']);

            $data['language'] = $languagesModel;

            $this->admin_page_to_display('admin-add-techno', $data);
        } catch (\Throwable $error) {
            $data = [
                "message" => $error->getMessage(),
                "succeeded" => false,
            ];
            $this->admin_page_to_display('admin-add-techno', $data);
        }
    }

    public function update_a_language(array $idLanguage): void
    {

        try {
            $languagesRepository = new LanguagesRepository();
            $languagesModel = new Languages();
            $imageHelper = new ImageHelper();
            $isNoUpdateImage = $imageHelper->is_update_image($_FILES['picture']);

            if (!$isNoUpdateImage) {
                $imageHelper->inserted_language_image($_FILES["picture"]["name"], $_FILES['picture']['tmp_name'], $_FILES['picture']['type']);
            }

            if (!$isNoUpdateImage) {
                $picture = $_FILES["picture"]["name"];
            } else {
                $picture = htmlspecialchars($_POST['picture']);
            }

            $languagesModel->set_label(htmlspecialchars($_POST['label']));
            $languagesModel->set_picture($picture);
            $languagesModel->set_type(htmlspecialchars($_POST['type']));

            $insert = $languagesRepository->update_language_repository($idLanguage["id"]);

            if ($insert || !$insert) {
                $data['succeeded'] = $insert;
            }

            $this->admin_page_to_display('admin-add-techno', $data);
        } catch (\Throwable $error) {
            $data = [
                "message" => $error->getMessage(),
                "succeeded" => false,
            ];
            $this->admin_page_to_display('admin-add-techno', $data);
        }
    }

    public function admin_delete_languages(array $labelId): void
    {
        try {
            $languagesRepository = new LanguagesRepository();
            $languagesRepository->delete_language_repository($labelId['id']);
        } catch (\Throwable $error) {
            $data = [
                "message" => $error->getMessage(),
                "succeeded" => false,
            ];
            $this->admin_page_to_display('admin-add-techno', $data);
        }
    }
}
