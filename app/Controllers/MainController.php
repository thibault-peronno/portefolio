<?php

namespace App\Controllers;

use App\Models\User;
use App\Repositories\LanguagesRepository;
use App\Repositories\OrganizationsRepository;
use App\Repositories\ProjectRepository;

class MainController extends CoreController
{

    public function display_home_page(): void
    {
        try {
            $projectRepository = new ProjectRepository();
            $LanguageRepository = new LanguagesRepository();

            $data = [];
            $data['projects'] = $projectRepository->get_projects();
            $data['languages'] = $LanguageRepository->get_languages();

            $this->page_to_display('home', $data);
        } catch (\Throwable $error) {
            $data = [
                "message" => $error->getMessage(),
                "succeeded" => false,
            ];
            $this->page_to_display('error', $data);
        }
        // echo 'methode home dans MainController';
    }

    public function display_cv_page(): void
    {
        $this->page_to_display('cv');
    }

    public function display_admin_home_page(): void
    {
        try {
            $user = new User;
            $projectRepository = new ProjectRepository();
            $LanguageRepository = new LanguagesRepository();
            $organizationRepository = new OrganizationsRepository();
    
            $data = [];
            $data['projects'] = $projectRepository->get_projects();
            $data['languages'] = $LanguageRepository->get_languages();
            $data['organizations'] = $organizationRepository->get_organizations();

            // $allOrganizations = $organizationRepository->get_organizations();
            // $data['organizations'] = array_map(function ($getOrganization) {
            //     $organizationModel = new Organization();

            //     $organizationModel->set_id($getOrganization['id']);
            //     $organizationModel->set_title($getOrganization['title']);
            //     $organizationModel->set_description($getOrganization['description']);
            //     $organizationModel->set_picture($getOrganization['picture']);

            //     return $organizationModel;
            // }, $allOrganizations);

            $this->admin_page_to_display('admin-home', $data);
        } catch (\Throwable $error) {
            $data = [
                "message" => $error->getMessage(),
                "succeeded" => false,
            ];
            $this->page_to_display('error', $data);
        }
    }
};
