<?php

namespace App\Controllers;

use App\Models\Languages;
use App\Models\Organization;
use App\Models\Project;
use App\Models\User;
use App\Repositories\ProjectRepository;

class MainController extends CoreController {

    public function home(): void
    {
        try {
            $projectRepository = new ProjectRepository();
            $languageModel = new Languages();
            
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
            $data['languages'] = $languageModel->getLanguages();
        } catch (\Throwable $th) {
            //throw $th;
        }
        // echo 'methode home dans MainController';
        $this->show('home', $data);
    }

    public function cv(): void
    {
        $this->show('cv');
    }

    public function boHome(): void
    {
        $user = new User;
        $projectModel = new Project();
        $projectRepository = new ProjectRepository();
        $languageModel = new Languages();
        $organizationModel = new Organization();

        $data=[];
        try {
            $data['projects'] = $projectRepository->getProjects();
            $data['languages'] = $languageModel->getLanguages();
            $data['organizations'] = $organizationModel->getOrganizations();
            
            $this->boShow('admin-home', $data);
        } catch (\Throwable $error) {
            dump('admin-home', $error);
        }
    }
};

?>