<?php

namespace App\Controllers;

use App\Controllers\CoreController;
use App\Models\Project;
use App\Models\ProjectLanguage;
use App\Helpers\GetLangagesHelper;
use App\Helpers\ImageHelper;
use App\Models\Organization;

class ProjectController extends CoreController
{

    public function projects(): void
    {
        $this->show('projects');
    }

    public function project(): void
    {
        $this->show('project');
    }

    public function boProjects(): void
    {
        $this->boShow('bo-projects');
    }

    public function addProjectPage(): void
    {
        // instancier le model des langues

        // instancier le model des oragnisations

        // faire un tabelau qui contien les deux données : languages et organisations

        // gestion des erreurs
        $langagesHelper = new GetLangagesHelper();
        $organizationModel = new Organization();

        $data = [];

        $data['langages'] = $langagesHelper->getLanguages();
        $data['organizations'] = $organizationModel->getOrganizations();

        $this->boShow('bo-add-project', $data);
    }

    public function addProject(): void
    {
        dump('post', $_POST);
        // die;

        $projectModel = new Project();
        $imageHelper = new ImageHelper();

        $data = [];
        try {
            /* Inserte image : return true or an trow error */
            $imageHelper->isInsertedProjectImage();

            /*  With FILTER_SANITIZE_STRING that is deprecated as of PHP 8.1.0
            $title = filter_input(INPUT_POST, 'name', FILTER_SANITIZE_STRING);
            You could use this way : $title = filter_input(INPUT_POST, 'name', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
        */
            $title = htmlspecialchars($_POST['title'], ENT_QUOTES);
            $description = htmlspecialchars($_POST['description'], ENT_QUOTES);
            $url = htmlspecialchars($_POST['url'], ENT_QUOTES);
            $picture = $_FILES["picture"]["name"];
            $organization_id = filter_input(INPUT_POST, 'organizationId', FILTER_SANITIZE_NUMBER_INT);


            /*  Now we create our object with datas from input
            we have our object with $projectModel = new Project;
        */
            dump('controller', $organization_id);
            $projectModel->setTitle($title);
            $projectModel->setDescription($description);
            $projectModel->setUrl($url);
            $projectModel->setPicture($picture);
            $projectModel->setOrganizationId($organization_id);

            $insert = $projectModel->addProject();

            dump($insert);
            if ($insert || !$insert) {
                $data['succeeded'] = $insert;
            }

            $this->boShow('bo-add-project', $data);
        } catch (\Throwable $error) {
            $data = [
                "message" => $error->getMessage(),
                "succeeded" => false,
            ];
            $this->boShow('bo-add-orga', $data);
        }
    }
}
