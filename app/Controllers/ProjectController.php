<?php
namespace App\Controllers;
use App\Controllers\CoreController;

class ProjectController extends CoreController {

    public function projects():void
    {
        $this->show('projects');
    }

    public function project():void
    {
        $this->show('project');
    }

    public function boProjects():void
    {
        $this->boShow('bo-projects');
    }

    public function addProjectPage():void
    {
        $this->boShow('bo-add-project');
    }
}

