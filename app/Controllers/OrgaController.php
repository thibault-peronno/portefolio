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
            $organizationsRepository = new OrganizationsRepository();
            $organizationModel = new Organization();
            $imageHelper = new ImageHelper();

            $data = [];

            /* Inserte image : return true or an trow error */
            $imageHelper->insertedOrganizationImage();

            // échapper nos données pour éviter les failles XSS
            $title = htmlspecialchars($_POST['title'], ENT_QUOTES);
            $description = htmlspecialchars($_POST['description'], ENT_QUOTES);
            $picture = $_FILES["picture"]["name"];

            // assigner les valeurs à l'objet, pour les récuperer dans notre model.
            $organizationModel->setTitle($title);
            $organizationModel->setDescription($description);
            $organizationModel->setPicture($picture);

            // aller faire la requête dans notre repository
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

    public function editOrga($idOrganization)
    {
        try {
            $organizationsRepository = new OrganizationsRepository();
            $data = [];

            $data['organization'] = $organizationsRepository->getOrgaById($idOrganization);

            $this->boShow('admin-add-orga', $data);
        } catch (\Throwable $error) {
            $data = [
                "message" => $error->getMessage(),
                "succeeded" => false,
            ];
            $this->boShow('error', $data);
        }
    }

    public function updateOrganization($idOrga)
    {

        try {
            $organizationsRepository = new OrganizationsRepository();
            $organizationModel = new Organization();
            $imageHelper = new ImageHelper();
            $isNoUpdateImage = $imageHelper->isNoUpdateImage();

            if (!$isNoUpdateImage) {
                $imageHelper->insertedOrganizationImage();
            }

            $id = intval($_POST['id']);
            $title = htmlspecialchars($_POST['title']);
            $description = htmlspecialchars($_POST['description']);
            if (!$isNoUpdateImage) {
                $picture = $_FILES["picture"]["name"];
            } else {
                $picture = htmlspecialchars($_POST['picture']);
            }

            $organizationModel->setTitle($title);
            $organizationModel->setDescription($description);
            $organizationModel->setPicture($picture);

            $insert = $organizationsRepository->updateOrganization($id);

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
