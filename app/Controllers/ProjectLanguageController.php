<?php

namespace App\Controllers;
use App\Models\ProjectLanguage;

class ProjectLanguageController extends CoreController
{
    public function addProjectLanguage($projectId)
    {
        $projectLanguageModel = new ProjectLanguage;

        foreach ($_POST['languages'] as $key => $value) {
            $intValue = intval($value);
            dump($intValue);
            $_POST['languages'][$key] = $intValue;
        }
        dump($_POST);

        foreach ($_POST['languages'] as $key => $value) {

            $projectLanguageModel->setProjectId($projectId);
            $projectLanguageModel->setLanguageId($value);

            // call the method to exect the sql request
            $result = $projectLanguageModel->addLanguagesProjects();
        }
        dump($_POST);
        return $result;

        
    }
}