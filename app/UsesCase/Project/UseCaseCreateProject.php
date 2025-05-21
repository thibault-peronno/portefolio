<?php

class UseCaseCreateProject {
    function __construct($projectModel, $langues, $images) {
       $this->insertImages($images);
       $idProject = $this->createProject() ;
       $this->createLanguages($idProject);
    }

    private function insertImages() {
        $imageHelper = new ImageHelper();
        $imageHelper->inserted_project_image();

    }

    private function createProject() {
        $projectRepository = new ProjectRepository();
        $insert = $projectRepository->add_a_project($projectModel, $_POST['languages']);
    }

    private function createLanguages() {
        foreach ($languages as $key => $value) {
            $projectLanguageModel = new ProjectLanguage();
            $projectLanguageModel->set_project_id($projectId);
            $projectLanguageModel->set_language_id($value);

            // call the method to exect the sql request
            $projectLanguageRepository = new ProjectLanguageRepository();
            $projectLanguageRepository->add_languages_by_projects($projectLanguageModel);
        }
    }
}