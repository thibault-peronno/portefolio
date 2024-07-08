<?php

namespace App\Controllers;

use App\Models\Languages;
use App\Models\Organization;
use App\Models\Project;
use App\Models\User;

class MainController extends CoreController {

    public function home(): void
    {
        // echo 'methode home dans MainController';
        $this->show('home');
    }

    public function cv(): void
    {
        $this->show('cv');
    }

    public function boHome(): void
    {
        $user = new User;
        $projectModel = new Project();
        $languageModel = new Languages();
        $organizationModel = new Organization();

        $data=[];
        try {
            $data['projects'] = $projectModel->getProjects();
            $data['languages'] = $languageModel->getLanguages();
            $data['organizations'] = $organizationModel->getOrganizations();
            
            $this->boShow('bo-home', $data);
        } catch (\Throwable $error) {
            dump('bo-home', $error);
        }
    }
};