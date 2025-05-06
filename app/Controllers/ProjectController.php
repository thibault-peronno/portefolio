<?php

namespace App\Controllers;

use App\Controllers\CoreController;
use App\Models\Project;
use App\Repositories\ProjectRepository;
use App\Repositories\OrganizationsRepository;
use App\Helpers\LanguagesHelper;
use App\Helpers\ImageHelper;

class ProjectController extends CoreController
{

    public function getProjects(): void
    {
        try {
            $projectRepository = new projectRepository();
            $data = [];

            $data['projects'] = $projectRepository->getProjects();

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

            $data['project'] = $projectRepository->getProjectById($idProject['id']);

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
            $data['projects'] = $projectRepository->getProjects();

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

            $data['project'] = $projectRepository->getProjectById($idProject['id']);

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
            $organizatiionRepository =  new OrganizationsRepository();
            $languagesHelper = new languagesHelper();

            $data = [];

            $data['languages'] = $languagesHelper->getLanguages();
            $data['organizations'] = $organizatiionRepository->getOrganizations();

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

            /* Insert image : return true or an throw error */
            $imageHelper = new ImageHelper();
            // dd($_POST);
            $imageHelper->insertedProjectImage($_FILES["picture"]["name"], $_FILES['picture']['tmp_name'], $_FILES['picture']['type']);
            // dump("test");

            /*  Now we create our object with datas from input
            we have our object with $projectModel = new Project;
            */
            $projectModel = new Project();
            $projectModel->setTitle($_POST['title']);
            $projectModel->setDescription($_POST['description']);
            $projectModel->setUrl($_POST['url']);
            $projectModel->setPicture($_FILES["picture"]["name"]);
            $projectModel->setOrganizationId($_POST['organizationId']);

            $projectRepository = new ProjectRepository();
            $insert = $projectRepository->addProject($projectModel, $_POST['languages']);
            dump($insert);
            $data = [];
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
        // dd($idProject);
        $languagesHelper = new LanguagesHelper();
        $organizatiionRepository = new OrganizationsRepository();
        $projectRepository = new ProjectRepository;

        $data = [];

        $data['languages'] = $languagesHelper->getLanguages();
        $data['organizations'] = $organizatiionRepository->getOrganizations();
        $data['project'] = $projectRepository->getProjectById($idProject['id']);

        $this->boShow('admin-add-project', $data);
    }

    public function updateProject($idProject)
    {

        try {
            $imageHelper = new ImageHelper();

            $data = [];
            $isNoUpdateImage = $imageHelper->isNoUpdateImage($_FILES['picture']);

            if (!$isNoUpdateImage) {
                $imageHelper->insertedProjectImage($_FILES["picture"]["name"], $_FILES['picture']['tmp_name'], $_FILES['picture']['type']);
            }

            $projectModel = new Project();
            $projectModel->setId($idProject['id']);
            $projectModel->setTitle($_POST['title']);
            $projectModel->setDescription($_POST['description']);
            $projectModel->setUrl($_POST['url']);
            if (!$isNoUpdateImage) {
                $projectModel->setPicture($_FILES["picture"]["name"]);
            } else {
                $projectModel->setPicture($_POST['picture']);
            }
            $projectModel->setOrganizationId($_POST['organizationId']);

            $projectRepository = new ProjectRepository;
            $insert = $projectRepository->updateProject($projectModel, $_POST['languages']);

            $data['succeeded'] = $insert;

            $this->boShow('admin-add-project', $data);
        } catch (\Throwable $error) {
            $data = [
                "message" => $error->getMessage(),
                "succeeded" => false,
            ];
            $this->boShow('error', $data);
        }
    }
}
