<?php

namespace App\Controllers;

use App\Models\Languages;
use App\Models\Organization;
use App\Models\Project;
use App\Models\User;
use App\Repositories\LanguagesRepository;
use App\Repositories\OrganizationsRepository;
use App\Repositories\ProjectRepository;

class MainController extends CoreController
{

    public function home(): void
    {
        try {
            $projectRepository = new ProjectRepository();
            $LanguageRepository = new LanguagesRepository();

            $data = [];
            $data['projects'] = $projectRepository->getProjects();
            $data['languages'] = $LanguageRepository->getLanguages();

            $this->show('home', $data);
        } catch (\Throwable $error) {
            $data = [
                "message" => $error->getMessage(),
                "succeeded" => false,
            ];
            $this->show('error', $data);
        }
        // echo 'methode home dans MainController';
    }

    public function cv(): void
    {
        $this->show('cv');
    }

    public function boHome(): void
    {
        try {
            $user = new User;
            $projectRepository = new ProjectRepository();
            $LanguageRepository = new LanguagesRepository();
            $organizationRepository = new OrganizationsRepository();
    
            $data = [];
            $data['projects'] = $projectRepository->getProjects();
            $data['languages'] = $LanguageRepository->getLanguages();
            $data['organizations'] = $organizationRepository->getOrganizations();

            // $allOrganizations = $organizationRepository->getOrganizations();
            // $data['organizations'] = array_map(function ($getOrganization) {
            //     $organizationModel = new Organization();

            //     $organizationModel->setId($getOrganization['id']);
            //     $organizationModel->setTitle($getOrganization['title']);
            //     $organizationModel->setDescription($getOrganization['description']);
            //     $organizationModel->setPicture($getOrganization['picture']);

            //     return $organizationModel;
            // }, $allOrganizations);

            $this->boShow('admin-home', $data);
        } catch (\Throwable $error) {
            $data = [
                "message" => $error->getMessage(),
                "succeeded" => false,
            ];
            $this->show('error', $data);
        }
    }
};
