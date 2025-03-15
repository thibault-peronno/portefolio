<?php

class UseCaseCreateProject {
    function __construct($projectModel, $langues, $images) {
       $this->insertImages($images);
       $idProject = $this->createProject() ;
       $this->createLanguages($idProject);
    }

    private function insertImages() {
        $imageHelper = new ImageHelper();
        $imageHelper->insertedProjectImage();

    }

    private function createProject() {
        $projectRepository = new ProjectRepository();
        $insert = $projectRepository->addProject($projectModel, $_POST['languages']);
    }

    private function createLanguages() {
        foreach ($languages as $key => $value) {
            $projectLanguageModel = new ProjectLanguage();
            $projectLanguageModel->setProjectId($projectId);
            $projectLanguageModel->setLanguageId($value);

            // call the method to exect the sql request
            $projectLanguageRepository = new ProjectLanguageRepository();
            $projectLanguageRepository->addLanguagesProjects($projectLanguageModel);
        }
    }
}