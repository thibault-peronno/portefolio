<?php

namespace App\Controllers;

use App\Helpers\ImageHelper;
use App\Repositories\OrganizationsRepository;

class OrgaController extends CoreController
{
    public function display_organizations_page(): void
    {

        try {
            $data = [];
            $organizationsRepository = new OrganizationsRepository();
            $data['organizations'] = $organizationsRepository->get_organizations();

            $this->admin_page_to_display('admin-orgas', $data);
        } catch (\Throwable $error) {
            $data = [
                "message" => $error->getMessage(),
                "succeeded" => false,
            ];
            $this->admin_page_to_display('error', $data);
        }
    }

    public function display_organization_page(array $idOrganization): void
    {
        try {
            $data = [];
            $organizationsRepository = new OrganizationsRepository();
            $data['organization'] = $organizationsRepository->get_organization_by_id($idOrganization["id"]);

            $this->admin_page_to_display('admin-orga', $data);
        } catch (\Throwable $error) {
            $data = [
                "message" => $error->getMessage(),
                "succeeded" => false,
            ];
            $this->admin_page_to_display('error', $data);
        }
    }


    public function display_add_organization_page(): void
    {
        $this->admin_page_to_display('admin-add-orga');
    }

    public function add_an_organization(): void
    {
        try {
            /* Inserte image : return true or an trow error */
            $imageHelper = new ImageHelper();
            $imageHelper->inserted_organization_image($_FILES["picture"]["name"], $_FILES['picture']['tmp_name'], $_FILES['picture']['type']);

            // assigner les valeurs à l'objet, pour les récuperer dans notre model.
            $title = filter_input(INPUT_POST, 'title', FILTER_SANITIZE_SPECIAL_CHARS);
            $description = filter_input(INPUT_POST, 'description', FILTER_SANITIZE_SPECIAL_CHARS);
            $picture = $_FILES["picture"]["name"];

            $organizationsRepository = new OrganizationsRepository();
            $data = $organizationsRepository->add_an_organization($title, $description, $picture);

            $this->admin_page_to_display('admin-add-orga', $data);
        } catch (\Throwable $error) {
            $data = [
                "message" => $error->getMessage(),
                "succeeded" => false,
            ];
            $this->admin_page_to_display('error', $data);
        }
    }

    public function display_edit_an_organization_page(array $idOrga): void
    {
        try {
            $data = [];
            $organizationsRepository = new OrganizationsRepository();
            $data['organization'] = $organizationsRepository->get_organization_by_id($idOrga['id']);
            $this->admin_page_to_display('admin-add-orga', $data);
        } catch (\Throwable $error) {
            $data = [
                "message" => $error->getMessage(),
                "succeeded" => false,
            ];
            $this->admin_page_to_display('error', $data);
        }
    }

    public function update_an_organization(): void
    {

        try {
            $imageHelper = new ImageHelper();
            $isNoUpdateImage = $imageHelper->is_update_image($_FILES['picture']);

            if (!$isNoUpdateImage) {
                $imageHelper->inserted_organization_image($_FILES["picture"]["name"], $_FILES['picture']['tmp_name'], $_FILES['picture']['type']);
            }

            $id = filter_input(INPUT_POST, 'id', FILTER_SANITIZE_SPECIAL_CHARS);
            $title = filter_input(INPUT_POST, 'title', FILTER_SANITIZE_SPECIAL_CHARS);
            $description = filter_input(INPUT_POST, 'description', FILTER_SANITIZE_SPECIAL_CHARS);

            $picture = "";
            if (!$isNoUpdateImage) {
                $picture = $_FILES["picture"]["name"];
            } else {
                $picture = $_POST['picture'];
            }

            $organizationsRepository = new OrganizationsRepository();
            $data = $organizationsRepository->update_an_organization($title, $description, $picture, $id);

            $this->admin_page_to_display('admin-add-orga', $data);
        } catch (\Throwable $error) {
            $data = [
                "message" => $error->getMessage(),
                "succeeded" => false,
            ];
            $this->admin_page_to_display('error', $data);
        }
    }
}
