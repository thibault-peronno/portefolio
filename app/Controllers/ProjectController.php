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
        try {
            $projectRepository = new projectRepository();
            $data = [];
            $allProjects = $projectRepository->getProjects();

            $data['projects']  = array_map(function ($getProject) {
                $projectModel = new Project();

                $projectModel->setId($getProject['id']);
                $projectModel->setTitle($getProject['title']);
                $projectModel->setDescription($getProject['description']);
                $projectModel->setUrl($getProject['url']);
                $projectModel->setPicture($getProject['picture']);
                $projectModel->setOrganizationId($getProject['organization_id']);
                $projectModel->setLabels(json_decode('[' . $getProject['labels'] . ']', true));

                return $projectModel;
            }, $allProjects);
            $this->show('projects', $data);
        } catch (\Throwable $error) {
            $data = [
                "message" => $error->getMessage(),
                "succeeded" => false,
            ];
            $this->show('error', $data);
        }
    }

    public function getProject($idProject): void
    {
        try {
            $projectRepository = new projectRepository();

            $data = [];

            $project = $projectRepository->getProjectById($idProject['id']);

            $projectModel = new Project();

            $projectModel->setId($project['id']);
            $projectModel->setTitle($project['title']);
            $projectModel->setDescription($project['description']);
            $projectModel->setUrl($project['url']);
            $projectModel->setPicture($project['picture']);
            $projectModel->setOrganizationId($project['organization_id']);
            $projectModel->setTitleOrganization($project['title_organization']);
            $projectModel->setPictureOrganization($project['picture_organization']);
            $projectModel->setDescriptionOrganization($project['description_organization']);
            $projectModel->setLabels(json_decode('[' . $project['labels'] . ']', true));

            $data['project'] = $projectModel;

            $this->show('project', $data);
        } catch (\Throwable $error) {
            $data = [
                "message" => $error->getMessage(),
                "succeeded" => false,
            ];
            $this->show('error', $data);
        }
    }

    public function adminGetProjects(): void
    {
        try {
            $projectRepository = new projectRepository();
            $data = [];
            $allProjects = $projectRepository->getProjects();


            $data["projects"] = array_map(function ($getProject) {

                $projectModel = new Project();

                $projectModel->setId($getProject['id']);
                $projectModel->setTitle($getProject['title']);
                $projectModel->setDescription($getProject['description']);
                $projectModel->setUrl($getProject['url']);
                $projectModel->setPicture($getProject['picture']);
                $projectModel->setOrganizationId($getProject['organization_id']);
                $projectModel->setLabels(json_decode('[' . $getProject['labels'] . ']', true));

                return $projectModel;
            }, $allProjects);


            $this->boShow('admin-projects', $data);
        } catch (\Throwable $error) {
            $data = [
                "message" => $error->getMessage(),
                "succeeded" => false,
            ];
            $this->show('error', $data);
        }
    }

    public function adminGetProject($idProject): void
    {
        try {
            $projectRepository = new projectRepository();

            $data = [];

            $project = $projectRepository->getProjectById($idProject['id']);

            $projectModel = new Project();

            $projectModel->setId($project['id']);
            $projectModel->setTitle($project['title']);
            $projectModel->setDescription($project['description']);
            $projectModel->setUrl($project['url']);
            $projectModel->setPicture($project['picture']);
            $projectModel->setOrganizationId($project['organization_id']);
            $projectModel->setTitleOrganization($project['title_organization']);
            $projectModel->setPictureOrganization($project['picture_organization']);
            $projectModel->setDescriptionOrganization($project['description_organization']);
            $projectModel->setLabels(json_decode('[' . $project['labels'] . ']', true));

            $data['project'] = $projectModel;

            $this->boShow('admin-project', $data);
        } catch (\Throwable $error) {
            $data = [
                "message" => $error->getMessage(),
                "succeeded" => false,
            ];
            $this->show('error', $data);
        }
    }

    public function addProjectPage(): void
    {
        try {
            $languagesHelper = new GetLangagesHelper();
            $organizationModel = new Organization();

            $data = [];

            $data['languages'] = $languagesHelper->getLanguages();
            $data['organizations'] = $organizationModel->getOrganizations();

            $this->boShow('admin-add-project', $data);
        } catch (\Throwable $error) {
            $data = [
                "message" => $error->getMessage(),
                "succeeded" => false,
            ];
            $this->show('error', $data);
        }
    }

    public function addProject(): void
    {
        try {
            $projectModel = new Project();
            $projectRepository = new ProjectRepository();
            $imageHelper = new ImageHelper();

            $data = [];
            /* Inserte image : return true or an throw error */
            $imageHelper->insertedProjectImage();

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

            $data['succeeded'] = $insert;

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
        try {
            $languagesHelper = new GetLangagesHelper();
            $organizationModel = new Organization();
            $projectRepository = new ProjectRepository();

            $data = [];

            $data['languages'] = $languagesHelper->getLanguages();
            $data['organizations'] = $organizationModel->getOrganizations();
            $project = $projectRepository->getProjectById($idProject['id']);

            $projectModel = new Project();

            $projectModel->setId($project['id']);
            $projectModel->setTitle($project['title']);
            $projectModel->setDescription($project['description']);
            $projectModel->setUrl($project['url']);
            $projectModel->setPicture($project['picture']);
            $projectModel->setOrganizationId($project['organization_id']);
            $projectModel->setTitleOrganization($project['title_organization']);
            $projectModel->setPictureOrganization($project['picture_organization']);
            $projectModel->setDescriptionOrganization($project['description_organization']);
            $projectModel->setLabels(json_decode('[' . $project['labels'] . ']', true));

            $data['project'] = $projectModel;

            $this->boShow('admin-add-project', $data);
        } catch (\Throwable $error) {
            $data = [
                "message" => $error->getMessage(),
                "succeeded" => false,
            ];
            $this->boShow('admin-add-project', $data);
        }
    }

    public function updateProject($idProject)
    {

        try {
            $projectModel = new Project();
            $projectRepository = new ProjectRepository;
            $imageHelper = new ImageHelper();

            $data = [];
            $isNoUpdateImage = $imageHelper->isNoUpdateImage();

            if (!$isNoUpdateImage) {
                $imageHelper->insertedProjectImage();
            }
            $id = intval($idProject['id']);
            $title = htmlspecialchars($_POST['title']);
            $description = htmlspecialchars($_POST['description']);
            $url = htmlspecialchars($_POST['url']);
            if (!$isNoUpdateImage) {
                $picture = $_FILES["picture"]["name"];
            } else {
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

            $data['succeeded'] = $insert;

            $this->boShow('admin-add-project', $data);
        } catch (\Throwable $error) {
            $data = [
                "message" => $error->getMessage(),
                "succeeded" => false,
            ];
            $this->boShow('admin-add-project', $data);
        }
    }
}
