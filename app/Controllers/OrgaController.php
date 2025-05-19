<?php

namespace App\Controllers;

use App\Helpers\ImageHelper;
use App\Models\Organization;
use App\Repositories\OrganizationsRepository;

class OrgaController extends CoreController
{
    public function display_organizations_page(): void
    {

        try {
            $organizationsRepository = new OrganizationsRepository();
            $data = [];

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

    public function display_organization_page($idOrganization): void
    {
        try {
            $organizationsRepository = new OrganizationsRepository();
            $data = [];

            $data['organization'] = $organizationsRepository->get_organization_by_id($idOrganization);

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

            $data = [];

            /* Inserte image : return true or an trow error */
            $imageHelper = new ImageHelper();
            $imageHelper->inserted_organization_image($_FILES["picture"]["name"], $_FILES['picture']['tmp_name'], $_FILES['picture']['type']);

            // assigner les valeurs à l'objet, pour les récuperer dans notre model.
            $organizationModel = new Organization();
            $organizationModel->set_title($_POST['title']);
            $organizationModel->set_description($_POST['description']);
            $organizationModel->set_picture($_FILES["picture"]["name"]);

            // aller faire la requête dans notre repository
            $organizationsRepository = new OrganizationsRepository();
            $insert = $organizationsRepository->add_an_organization($organizationModel);
            if ($insert || !$insert) {
                $data['succeeded'] = $insert;
            }

            $this->admin_page_to_display('admin-add-orga', $data);
        } catch (\Throwable $error) {
            $data = [
                "message" => $error->getMessage(),
                "succeeded" => false,
            ];
            $this->admin_page_to_display('error', $data);
        }
    }

    public function display_edit_an_organization_page($idOrga): void
    {
        try {
            $organizationsRepository = new OrganizationsRepository();
            $data = [];
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

    public function update_an_organization():void
    {

        try {
            $imageHelper = new ImageHelper();
            $isNoUpdateImage = $imageHelper->is_update_image($_FILES['picture']);
            
            if (!$isNoUpdateImage) {
                $imageHelper->inserted_organization_image($_FILES["picture"]["name"], $_FILES['picture']['tmp_name'], $_FILES['picture']['type']);
            }
            
            $organizationModel = new Organization();
            $organizationModel->set_id($_POST['id']);
            $organizationModel->set_title($$_POST['title']);
            $organizationModel->set_description($_POST['description']);
            if (!$isNoUpdateImage) {
            $organizationModel->set_picture($$_FILES["picture"]["name"]);
            } else {
                $organizationModel->set_picture($_POST['picture']);
            }
            
            $organizationsRepository = new OrganizationsRepository();
            $insert = $organizationsRepository->update_an_organization($organizationModel);

            $data['succeeded'] = $insert;

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
