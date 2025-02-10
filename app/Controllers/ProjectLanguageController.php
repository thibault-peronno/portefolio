<?php

namespace App\Controllers;

use App\Models\ProjectLanguage;
use App\Repositories\ProjectLanguageRepository;

class ProjectLanguageController extends CoreController
{
    public function addProjectLanguage($projectId)
    {
        try {
            /* a optimiser */
            $projectLanguageRepository = new ProjectLanguageRepository();
            $projectLanguageModel = new ProjectLanguage();
    
            foreach ($_POST['languages'] as $key => $value) {
                $intValue = intval($value);
                $_POST['languages'][$key] = $intValue;
            }
    
            foreach ($_POST['languages'] as $key => $value) {
    
                $projectLanguageModel->setProjectId($projectId);
                $projectLanguageModel->setLanguageId($value);
    
                // call the method to exect the sql request
                $result = $projectLanguageRepository->addLanguagesProjects();
            }
            return $result;
        } catch (\Throwable $error) {
            throw $error;
        }
    }

    public function fetchAllLanguageId(): array
    {
        try {
            $projectLanguageRepository = new ProjectLanguageRepository();
            return $projectLanguageRepository->languageIdModel();
        } catch (\Throwable $error) {
            throw $error;
        }
    }

    public function deleteProjetctLanguage(array $languages, int $projectId)
    {
        try {
            /* a optimiser */
            $projectLanguageRepository = new ProjectLanguageRepository();
            $projectLanguageModel = new ProjectLanguage;
            foreach ($languages as $keyLanguage => $valueLanguage) {
                $projectLanguageModel->setProjectId($projectId);
                $projectLanguageModel->setLanguageId($valueLanguage);
    
                $result = $projectLanguageRepository->deleteLanguagesProjects();
    
                return $result;
            }
            
        } catch (\Throwable $error) {
            throw $error;
        }
    }
}
