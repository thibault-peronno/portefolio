<?php

namespace App\Controllers;
use App\Models\ProjectLanguage;
use App\Utils\Database;

class ProjectLanguageController extends CoreController
{
    public function addProjectLanguage($projectId)
    {
        /* a optimiser */
        $projectLanguageModel = new ProjectLanguage;

        foreach ($_POST['languages'] as $key => $value) {
            $intValue = intval($value);
            $_POST['languages'][$key] = $intValue;
        }

        foreach ($_POST['languages'] as $key => $value) {

            $projectLanguageModel->setProjectId($projectId);
            $projectLanguageModel->setLanguageId($value);

            // call the method to exect the sql request
            $result = $projectLanguageModel->addLanguagesProjects();
        }
        return $result;

        
    }

    public function fetchAllLanguageId(): array
    {
        $projectLanguageModel = new ProjectLanguage();
        return $projectLanguageModel->languageIdModel();
    }

    public function deleteProjetctLanguage(Array $languages, int $projectId)
    {
        /* a optimiser */
        $projectLanguageModel = new ProjectLanguage;
        foreach($languages as $keyLanguage => $valueLanguage) {
            $projectLanguageModel->setProjectId($projectId);
            $projectLanguageModel->setLanguageId($valueLanguage);

            $result = $projectLanguageModel->deleteLanguagesProjects();

            return $result;
        }
    }
}