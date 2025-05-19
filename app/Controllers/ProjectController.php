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

    public function display_projects_page(): void
    {
        try {
            $projectRepository = new projectRepository();
            $data = [];

            $data['projects'] = $projectRepository->get_projects();

            $this->page_to_display('projects', $data);
        } catch (\Throwable $error) {
            $data = [
                "message" => $error->getMessage(),
                "succeeded" => false,
            ];
            $this->page_to_display('error', $data);
        }
    }

    public function display_project_page($idProject): void
    {
        try {
            $projectRepository = new projectRepository();

            $data = [];

            $data['project'] = $projectRepository->get_project_by_id($idProject['id']);

            $this->page_to_display('project', $data);
        } catch (\Throwable $error) {
            $data = [
                "message" => $error->getMessage(),
                "succeeded" => false,
            ];
            $this->page_to_display('error', $data);
        }
    }

    public function display_admin_projects(): void
    {
        try {
            $projectRepository = new projectRepository();
            $data = [];
            $data['projects'] = $projectRepository->get_projects();

            $this->admin_page_to_display('admin-projects', $data);
        } catch (\Throwable $error) {
            $data = [
                "message" => $error->getMessage(),
                "succeeded" => false,
            ];
            $this->page_to_display('error', $data);
        }
    }

    public function display_admin_project($idProject): void
    {
        try {
            $projectRepository = new projectRepository();

            $data = [];

            $data['project'] = $projectRepository->get_project_by_id($idProject['id']);

            $this->admin_page_to_display('admin-project', $data);
        } catch (\Throwable $error) {
            $data = [
                "message" => $error->getMessage(),
                "succeeded" => false,
            ];
            $this->page_to_display('error', $data);
        }
    }

    public function display_admin_add_project_page(): void
    {
        try {
            $organizatiionRepository =  new OrganizationsRepository();
            $languagesHelper = new languagesHelper();

            $data = [];

            $data['languages'] = $languagesHelper->get_languages_helper();
            $data['organizations'] = $organizatiionRepository->get_organizations();

            $this->admin_page_to_display('admin-add-project', $data);
        } catch (\Throwable $error) {
            $data = [
                "message" => $error->getMessage(),
                "succeeded" => false,
            ];
            $this->page_to_display('error', $data);
        }
    }

    public function add_a_project(): void
    {
        try {

            /* Insert image : return true or an throw error */
            $imageHelper = new ImageHelper();
            // dd($_POST);
            $imageHelper->inserted_project_image($_FILES["picture"]["name"], $_FILES['picture']['tmp_name'], $_FILES['picture']['type']);
            // dump("test");

            /*  Now we create our object with datas from input
            we have our object with $projectModel = new Project;
            */
            $projectModel = new Project();
            $projectModel->set_title($_POST['title']);
            $projectModel->set_description($_POST['description']);
            $projectModel->set_url($_POST['url']);
            $projectModel->set_picture($_FILES["picture"]["name"]);
            $projectModel->set_organization_id($_POST['organizationId']);

            $projectRepository = new ProjectRepository();
            $insert = $projectRepository->add_a_project($projectModel, $_POST['languages']);
            dump($insert);
            $data = [];
            $data['succeeded'] = $insert;

            $this->admin_page_to_display('admin-add-project', $data);
        } catch (\Throwable $error) {
            $data = [
                "message" => $error->getMessage(),
                "succeeded" => false,
            ];
            $this->admin_page_to_display('admin-add-project', $data);
        }
    }

    public function display_admin_edit_project_page($idProject)
    {
        // dd($idProject);
        $languagesHelper = new LanguagesHelper();
        $organizatiionRepository = new OrganizationsRepository();
        $projectRepository = new ProjectRepository;

        $data = [];

        $data['languages'] = $languagesHelper->get_languages_helper();
        $data['organizations'] = $organizatiionRepository->get_organizations();
        $data['project'] = $projectRepository->get_project_by_id($idProject['id']);

        $this->admin_page_to_display('admin-add-project', $data);
    }

    public function update_a_project($idProject)
    {

        try {
            $imageHelper = new ImageHelper();

            $data = [];
            $isNoUpdateImage = $imageHelper->is_update_image($_FILES['picture']);

            if (!$isNoUpdateImage) {
                $imageHelper->inserted_project_image($_FILES["picture"]["name"], $_FILES['picture']['tmp_name'], $_FILES['picture']['type']);
            }

            $projectModel = new Project();
            $projectModel->set_id($idProject['id']);
            $projectModel->set_title($_POST['title']);
            $projectModel->set_description($_POST['description']);
            $projectModel->set_url($_POST['url']);
            if (!$isNoUpdateImage) {
                $projectModel->set_picture($_FILES["picture"]["name"]);
            } else {
                $projectModel->set_picture($_POST['picture']);
            }
            $projectModel->set_organization_id($_POST['organizationId']);

            $projectRepository = new ProjectRepository;
            $insert = $projectRepository->update_a_project($projectModel, $_POST['languages']);

            $data['succeeded'] = $insert;

            $this->admin_page_to_display('admin-add-project', $data);
        } catch (\Throwable $error) {
            $data = [
                "message" => $error->getMessage(),
                "succeeded" => false,
            ];
            $this->admin_page_to_display('error', $data);
        }
    }
}
