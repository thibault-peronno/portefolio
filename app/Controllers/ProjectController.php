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
        $projectModel = new Project();
        $data = [];
        $data["projects"] = $projectModel->getProjects();
        $this->boShow('bo-projects', $data);
    }

    public function boProject($idProject): void
    {
        $projectModel = new Project();
        $data = [];
        $data["project"] = $projectModel->getProject($idProject['id']);
        $this->boShow('bo-project', $data);
    }

    public function addProjectPage(): void
    {
        $languagesHelper = new GetLangagesHelper();
        $organizationModel = new Organization();

        $data = [];

        $data['languages'] = $languagesHelper->getLanguages();
        $data['organizations'] = $organizationModel->getOrganizations();

        $this->boShow('bo-add-project', $data);
    }

    public function addProject(): void
    {
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
            $projectModel->setTitle($title);
            $projectModel->setDescription($description);
            $projectModel->setUrl($url);
            $projectModel->setPicture($picture);
            $projectModel->setOrganizationId($organization_id);

            $insert = $projectModel->addProject();

            if ($insert || !$insert) {
                $data['succeeded'] = $insert;
            }

            $this->boShow('bo-add-project', $data);
        } catch (\Throwable $error) {
            $data = [
                "message" => $error->getMessage(),
                "succeeded" => false,
            ];
            $this->boShow('bo-add-project', $data);
        }
    }

    public function editProject($idProject)
    {
        $languagesHelper = new GetLangagesHelper();
        $organizationModel = new Organization();
        $projectModel = new Project();

        $data = [];

        $data['languages'] = $languagesHelper->getLanguages();
        $data['organizations'] = $organizationModel->getOrganizations();
        $data['project'] = $projectModel->getProject($idProject['id']);

        $this->boShow('bo-add-project', $data);
    }

    public function updateProject($idProject)
    {
        // dump('test', $_POST, $idProject);

        $projectModel = new Project();
        $imageHelper = new ImageHelper();

        $data = [];

        try {
            $isNoUpdateImage = $imageHelper->isNoUpdateImage();

            if(!$isNoUpdateImage){
                $imageHelper->isInsertedProjectImage();
            }

            $id = intval($idProject['id']);
            $title = htmlspecialchars($_POST['title']);
            $description = htmlspecialchars($_POST['description']);
            $url = htmlspecialchars($_POST['url']);
            if(!$isNoUpdateImage){
            $picture = $_FILES["picture"]["name"];
            }
            $organization_id = filter_input(INPUT_POST, 'organizationId', FILTER_SANITIZE_NUMBER_INT);
            $projectModel->setId($id);
            $projectModel->setTitle($title);
            $projectModel->setDescription($description);
            $projectModel->setUrl($url);
            if(!$isNoUpdateImage){
                $projectModel->setPicture($picture);
            }
            $projectModel->setOrganizationId($organization_id);

            $insert = $projectModel->updateProject();

            if ($insert || !$insert) {
                $data['succeeded'] = $insert;
            }

            $this->boShow('bo-add-project', $data);
        } catch (\Throwable $th) {
            //throw $th;
        }
    }
}
