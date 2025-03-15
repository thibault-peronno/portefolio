<?php

namespace App\Controllers;

use App\Helpers\ImageHelper;
use App\Models\Organization;
use App\Repositories\OrganizationsRepository;

class OrgaController extends CoreController
{
    public function organizations(): void
    {

        try {
            $organizationsRepository = new OrganizationsRepository();
            $data = [];

            $data['organizations'] = $organizationsRepository->getOrganizations();

            $this->boShow('admin-orgas', $data);
        } catch (\Throwable $error) {
            $data = [
                "message" => $error->getMessage(),
                "succeeded" => false,
            ];
            $this->boShow('error', $data);
        }
    }

    public function organization($idOrganization): void
    {
        try {
            $organizationsRepository = new OrganizationsRepository();
            $data = [];

            $data['organization'] = $organizationsRepository->getOrgaById($idOrganization);

            $this->boShow('admin-orga', $data);
        } catch (\Throwable $error) {
            $data = [
                "message" => $error->getMessage(),
                "succeeded" => false,
            ];
            $this->boShow('error', $data);
        }
    }


    public function addOrgaPage(): void
    {
        $this->boShow('admin-add-orga');
    }

    public function addOrga(): void
    {
        try {

            $data = [];

            /* Inserte image : return true or an trow error */
            $imageHelper = new ImageHelper();
            $imageHelper->insertedOrganizationImage($_FILES["picture"]["name"], $_FILES['picture']['tmp_name'], $_FILES['picture']['type']);

            // assigner les valeurs à l'objet, pour les récuperer dans notre model.
            $organizationModel = new Organization();
            $organizationModel->setTitle($_POST['title']);
            $organizationModel->setDescription($_POST['description']);
            $organizationModel->setPicture($$_FILES["picture"]["name"]);

            // aller faire la requête dans notre repository
            $organizationsRepository = new OrganizationsRepository();
            $insert = $organizationsRepository->addOrganization();
            if ($insert || !$insert) {
                $data['succeeded'] = $insert;
            }

            $this->boShow('admin-add-orga', $data);
        } catch (\Throwable $error) {
            $data = [
                "message" => $error->getMessage(),
                "succeeded" => false,
            ];
            $this->boShow('error', $data);
        }
    }

    public function updateOrganization()
    {

        try {
            $imageHelper = new ImageHelper();
            $isNoUpdateImage = $imageHelper->isNoUpdateImage($_FILES['picture']);
            
            if (!$isNoUpdateImage) {
                $imageHelper->insertedOrganizationImage($_FILES["picture"]["name"], $_FILES['picture']['tmp_name'], $_FILES['picture']['type']);
            }
            
            $organizationModel = new Organization();
            $organizationModel->setId($_POST['id']);
            $organizationModel->setTitle($$_POST['title']);
            $organizationModel->setDescription($_POST['description']);
            if (!$isNoUpdateImage) {
            $organizationModel->setPicture($$_FILES["picture"]["name"]);
            } else {
                $organizationModel->setPicture($_POST['picture']);
            }
            
            $organizationsRepository = new OrganizationsRepository();
            $insert = $organizationsRepository->updateOrganization($organizationModel);

            $data['succeeded'] = $insert;

            $this->boShow('admin-add-orga', $data);
        } catch (\Throwable $error) {
            $data = [
                "message" => $error->getMessage(),
                "succeeded" => false,
            ];
            $this->boShow('error', $data);
        }
    }
}
