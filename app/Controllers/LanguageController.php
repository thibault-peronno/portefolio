<?php

namespace App\Controllers;

use App\Models\Languages;
use App\Helpers\ImageHelper;
use App\Helpers\languagesHelper;
use App\Repositories\LanguagesRepository;
use Error;

class LanguageController extends CoreController
{
    public function display_languages_page(): void
    {
        try {
            $languagesHelper = new languagesHelper();
            $data = $languagesHelper->sort_languages();

            $this->page_to_display('technos', $data);
        } catch (\Throwable $error) {
            $data = [
                "message" => $error->getMessage(),
                "succeeded" => false,
            ];
            $this->page_to_display('error', $data);
        }
    }

    public function display_admin_languages_page(): void
    {
        try {
            $languagesHelper = new languagesHelper();
            $data = $languagesHelper->sort_languages();

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
            $imageHelper = new ImageHelper();
            $insertedImage = $imageHelper->inserted_language_image($_FILES["picture"]["name"], $_FILES['picture']['tmp_name'], $_FILES['picture']['type']);
            if (!$insertedImage) {
                throw new Error("L'ajout a échoué. Le fichier n'a pas pu être sauvegardé");
            }

            $label = filter_input(INPUT_POST, 'label', FILTER_SANITIZE_SPECIAL_CHARS);
            $picture = $_FILES["picture"]["name"];
            $type = filter_input(INPUT_POST, 'type', FILTER_SANITIZE_SPECIAL_CHARS);

            $languagesRepository = new LanguagesRepository();
            $data = $languagesRepository->add_an_language($label, $picture, $type);

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
            $data['language'] = $languagesRepository->get_language_by_id($idLanguage['id']);

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
            $imageHelper = new ImageHelper();
            $isNoUpdateImage = $imageHelper->is_update_image($_FILES['picture']);

            if (!$isNoUpdateImage) {
                $imageHelper->inserted_language_image($_FILES["picture"]["name"], $_FILES['picture']['tmp_name'], $_FILES['picture']['type']);
            }
            $picture = "";
            if (!$isNoUpdateImage) {
                $picture = $_FILES["picture"]["name"];
            } else {
                $picture = htmlspecialchars($_POST['picture']);
            }

            $label = htmlspecialchars($_POST['label']);
            $type = htmlspecialchars($_POST['type']);

            $languagesRepository = new LanguagesRepository();
            $data = $languagesRepository->update_language_repository($idLanguage["id"], $label, $picture, $type);

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
