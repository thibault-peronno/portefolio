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

            $allLanguages = $LanguageRepository->getLanguages();

            $data['languages'] = array_map(function ($getLanguage) {
                $languageModel = new Languages();

                $languageModel->setId($getLanguage['id']);
                $languageModel->setLabel($getLanguage['label']);
                $languageModel->setPicture($getLanguage['picture']);
                $languageModel->setType($getLanguage['type']);

                return $languageModel;
            }, $allLanguages);

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
        $user = new User;
        $projectRepository = new ProjectRepository();
        $LanguageRepository = new LanguagesRepository();
        $organizationRepository = new OrganizationsRepository();

        $data = [];
        try {
            $allProject = $projectRepository->getProjects();

            $data['projects'] = array_map(function ($getProject) {
                $projectModel = new Project();

                $projectModel->setId($getProject['id']);
                $projectModel->setTitle($getProject['title']);
                $projectModel->setDescription($getProject['description']);
                $projectModel->setUrl($getProject['url']);
                $projectModel->setPicture($getProject['picture']);
                $projectModel->setOrganizationId($getProject['organization_id']);
                $projectModel->setLabels(json_decode('[' . $getProject['labels'] . ']', true));

                return $projectModel;
            }, $allProject);

            $allLanguages = $LanguageRepository->getLanguages();

            $data['languages'] = array_map(function ($getLanguage) {
                $languageModel = new Languages();

                $languageModel->setId($getLanguage['id']);
                $languageModel->setLabel($getLanguage['label']);
                $languageModel->setPicture($getLanguage['picture']);
                $languageModel->setType($getLanguage['type']);

                return $languageModel;
            }, $allLanguages);

            $allOrganizations = $organizationRepository->getOrganizations();
            dump($allOrganizations);
            $data['organizations'] = array_map(function ($getOrganization) {
                $organizationModel = new Organization();

                $organizationModel->setId($getOrganization['id']);
                $organizationModel->setTitle($getOrganization['title']);
                $organizationModel->setDescription($getOrganization['description']);
                $organizationModel->setPicture($getOrganization['picture']);

                return $organizationModel;
            }, $allOrganizations);

            dump($data);

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
