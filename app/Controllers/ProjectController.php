<?php

namespace App\Controllers;

use App\Controllers\CoreController;
use App\Models\Project;
use App\Repositories\ProjectRepository;
use App\Helpers\GetLangagesHelper;
use App\Helpers\ImageHelper;
use App\Models\Organization;

/* Le controller est le chef d'orchestre, donc je fais parler les models et les repositories depuis chaque
méthode

J'instancie le project model et je set mes valeurs
*/

class ProjectController extends CoreController
{

    public function getProjects(): void
    {
        $projectRepository = new projectRepository();
        $data = [];
        $data["projects"] = $projectRepository->getProjects();
        $this->show('projects', $data);
    }

    public function getProject($idProject): void
    {
        $projectModel = new Project();
        $projectRepository = new projectRepository();

        $projectModel->setId($idProject['id']);

        $data = [];

        $data['project'] = $projectRepository->getProjectById();

        $this->show('project', $data);
    }

    public function adminGetProjects(): void
    {
        $projectRepository = new projectRepository();
        $data = [];
        $data["projects"] = $projectRepository->getProjects();
        $this->boShow('admin-projects', $data);
    }

    public function adminGetProject($idProject): void
    {
        $projectModel = new Project();
        $projectRepository = new projectRepository();

        $projectModel->setId($idProject['id']);

        $data = [];
        $data["project"] = $projectRepository->getProjectById();
        $this->boShow('admin-project', $data);
    }

    public function addProjectPage(): void
    {
        $languagesHelper = new GetLangagesHelper();
        $organizationModel = new Organization();

        $data = [];

        $data['languages'] = $languagesHelper->getLanguages();
        $data['organizations'] = $organizationModel->getOrganizations();

        $this->boShow('admin-add-project', $data);
    }

    public function addProject(): void
    {
        $projectModel = new Project();
        $projectRepository = new ProjectRepository();
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

            $insert = $projectRepository->addProject();

            if ($insert || !$insert) {
                $data['succeeded'] = $insert;
            }

            $this->boShow('admin-add-project', $data);
        } catch (\Throwable $error) {
            $data = [
                "message" => $error->getMessage(),
                "succeeded" => false,
            ];
            $this->boShow('admin-add-project', $data);
        }
    }

    public function editProject($idProject)
    {
        $languagesHelper = new GetLangagesHelper();
        $organizationModel = new Organization();
        $projectModel = new Project();
        $projectRepository = new ProjectRepository();

        $projectModel->setId($idProject['id']);

        $data = [];

        $data['languages'] = $languagesHelper->getLanguages();
        $data['organizations'] = $organizationModel->getOrganizations();
        $data['project'] = $projectRepository->getProjectById();

        $this->boShow('admin-add-project', $data);
    }

    public function updateProject($idProject)
    {
        $projectModel = new Project();
        $projectRepository = new ProjectRepository;
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
            }else{
                $picture = htmlspecialchars($_POST['picture']);
            }
            $organization_id = filter_input(INPUT_POST, 'organizationId', FILTER_SANITIZE_NUMBER_INT);

            $projectModel->setId($id);
            $projectModel->setTitle($title);
            $projectModel->setDescription($description);
            $projectModel->setUrl($url);
            $projectModel->setPicture($picture);
            $projectModel->setOrganizationId($organization_id);

            $insert = $projectRepository->updateProject();

            if ($insert || !$insert) {
                $data['succeeded'] = $insert;
            }

            $this->boShow('admin-add-project', $data);
        } catch (\Throwable $th) {
            //throw $th;
        }
    }
}
