<?php

namespace App\Controllers;

use App\Helpers\ImageHelper;
use App\Models\Organization;

class OrgaController extends CoreController
{
    public function organization($idOrganization): void
    {
        $organizationModel = new Organization();
        $data = [];
        $organizationModel->setId($idOrganization["id"]);

        try {
            $data['organization'] = $organizationModel->getOrgaById();
            $this->boShow('bo-orga', $data);
        } catch (\Throwable $th) {
            //throw $th;
            dump($th);
        }
    }
    public function organizations(): void
    {
        $organizationModel = new Organization();
        $data = [];

        try {
            $data['organizations'] = $organizationModel->getOrganizations();
            $this->boShow('bo-orgas', $data);
        } catch (\Throwable $th) {
            //throw $th;
            dump($th);
        }
    }

    public function addOrgaPage(): void
    {
        $this->boShow('bo-add-orga');
    }

    public function addOrga(): void
    {
        $organizationModel = new Organization();
        $imageHelper = new ImageHelper();

        $data = [];
        try {

            /* Inserte image : return true or an trow error */
            $imageHelper->isInsertedOrganizationImage();

            // échapper nos données pour éviter les failles XSS
            $title = htmlspecialchars($_POST['title'], ENT_QUOTES);
            $description = htmlspecialchars($_POST['description'], ENT_QUOTES);
            $picture = $_FILES["picture"]["name"];

            // assigner les valeurs à l'objet, pour les récuperer dans notre model.
            $organizationModel->setTitle($title);
            $organizationModel->setDescription($description);
            $organizationModel->setPicture($picture);

            // aller faire la requête dans notre model
            $insert = $organizationModel->addOrganization();
            if ($insert || !$insert) {
                $data['succeeded'] = $insert;
            }

            $this->boShow('bo-add-orga', $data);
        } catch (\Throwable $error) {
            $data = [
                "message" => $error->getMessage(),
                "succeeded" => false,
            ];
            $this->boShow('bo-add-orga', $data);
        }
    }

    public function editOrga($idOrga)
    {
        $organizationModel = new Organization();

        $data = [];
        $organizationModel->setId(intval($idOrga['id']));
        $data['organization'] = $organizationModel->getOrgaById();
        $this->boShow('bo-add-orga', $data);
    }

    public function updateOrganization($idOrga)
    {
        $organizationModel = new Organization();
        $imageHelper = new ImageHelper();

        try {
            $isNoUpdateImage = $imageHelper->isNoUpdateImage();
            
            if(!$isNoUpdateImage){
                $imageHelper->isInsertedOrganizationImage();
            }
            
            $id= intval($idOrga['id']);
            $title = htmlspecialchars($_POST['title']);
            $description = htmlspecialchars($_POST['description']);
            if(!$isNoUpdateImage){
                $picture = $_FILES["picture"]["name"];
            }else{
                $picture = htmlspecialchars($_POST['picture']);
            }
            
            $organizationModel->setId($id);
            $organizationModel->setTitle($title);
            $organizationModel->setDescription($description);
            $organizationModel->setPicture($picture);

            $insert = $organizationModel->updateOrganization();

            if ($insert || !$insert) {
                $data['succeeded'] = $insert;
            }

            $this->boShow('bo-add-orga', $data);

        } catch (\Throwable $th) {
            //throw $th;
        }
    }
}
