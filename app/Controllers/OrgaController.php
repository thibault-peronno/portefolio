<?php
namespace App\Controllers;

use App\Models\Organization;

class OrgaController extends CoreController
{
    public function organization():void
    {
        $this->boShow('bo-orga');
    }

    public function addOrgaPage():void
    {
        $this->boShow('bo-add-orga');
    }

    public function addOrga():void
    {
        dump($_POST);
        // instancier notre model "organization" pour créer un nouvel objet
        $organizationModel = new Organization;
        
        // échapper nos données pour éviter les failles XSS
        $title = htmlspecialchars($_POST['title'], ENT_QUOTES);
        $description = htmlspecialchars($_POST['description'], ENT_QUOTES);
        $picture = htmlspecialchars($_POST['picture'], ENT_QUOTES);

        // assigner les valeurs à l'objet, pour les récuperer dans notre model.
        $organizationModel->setTitle($title);
        $organizationModel->setDescription($description);
        $organizationModel->setPicture($picture);

        $insert = $organizationModel->addOrganization();


        // aller faire la requête dans notre model
        $this->boShow('bo-add-orga');
    }
}