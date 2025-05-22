<?php

namespace App\Controllers;

use App\Controllers\CoreController;
use App\Repositories\ProjectRepository;
use App\Repositories\OrganizationsRepository;
use App\Helpers\LanguagesHelper;
use App\Helpers\ImageHelper;

class ProjectController extends CoreController
{

    public function display_projects_page(): void
    {
        try {
            $data = [];
            $projectRepository = new projectRepository();
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

    public function display_project_page(array $idProject): void
    {
        try {
            $data = [];
            $projectRepository = new projectRepository();
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
            $data = [];
            $projectRepository = new projectRepository();
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

    public function display_admin_project(array $idProject): void
    {
        try {
            $data = [];
            $projectRepository = new projectRepository();
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
            
            $data = [];
            $organizatiionRepository =  new OrganizationsRepository();
            $languagesHelper = new languagesHelper();
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
            $imageHelper->inserted_project_image($_FILES["picture"]["name"], $_FILES['picture']['tmp_name'], $_FILES['picture']['type']);

            $title = filter_input(INPUT_POST, 'title', FILTER_SANITIZE_SPECIAL_CHARS);
            $description = filter_input(INPUT_POST, 'description', FILTER_SANITIZE_SPECIAL_CHARS);
            $url = filter_input(INPUT_POST, 'url', FILTER_SANITIZE_SPECIAL_CHARS);
            $picture = ($_FILES["picture"]["name"]);
            $organization_id = filter_input(INPUT_POST, 'organizationId', FILTER_SANITIZE_SPECIAL_CHARS);

            $projectRepository = new ProjectRepository();
            $data = $projectRepository->add_a_project($title, $description, $url, $picture, $organization_id, $_POST['languages']);

            $this->admin_page_to_display('admin-add-project', $data);
        } catch (\Throwable $error) {
            $data = [
                "message" => $error->getMessage(),
                "succeeded" => false,
            ];
            $this->admin_page_to_display('admin-add-project', $data);
        }
    }

    public function display_admin_edit_project_page(array $idProject)
    {
        $languagesHelper = new LanguagesHelper();
        $organizatiionRepository = new OrganizationsRepository();
        $projectRepository = new ProjectRepository;

        $data = [];
        $data['languages'] = $languagesHelper->get_languages_helper();
        $data['organizations'] = $organizatiionRepository->get_organizations();
        $data['project'] = $projectRepository->get_project_by_id($idProject['id']);

        $this->admin_page_to_display('admin-add-project', $data);
    }

    public function update_a_project(array $idProject): void
    {

        try {
            $imageHelper = new ImageHelper();
            $isNoUpdateImage = $imageHelper->is_update_image($_FILES['picture']);

            if (!$isNoUpdateImage) {
                $imageHelper->inserted_project_image($_FILES["picture"]["name"], $_FILES['picture']['tmp_name'], $_FILES['picture']['type']);
            }


            $id = filter_input(INPUT_POST, $idProject['id'], FILTER_SANITIZE_SPECIAL_CHARS);
            $title = filter_input(INPUT_POST, $_POST['title'], FILTER_SANITIZE_SPECIAL_CHARS);
            $description = filter_input(INPUT_POST, $_POST['description'], FILTER_SANITIZE_SPECIAL_CHARS);
            $url = filter_input(INPUT_POST, $_POST['url'], FILTER_SANITIZE_SPECIAL_CHARS);
            $organization_id = filter_input(INPUT_POST, $_POST['organizationId'], FILTER_SANITIZE_SPECIAL_CHARS);
            if (!$isNoUpdateImage) {
                $picture = $_FILES["picture"]["name"];
            } else {
                $picture = $_POST['picture'];
            }

            $projectRepository = new ProjectRepository;
            $data = $projectRepository->update_a_project($id, $title, $description, $url, $picture, $organization_id, $_POST['languages']);

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
