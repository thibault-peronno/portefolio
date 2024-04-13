<?php

namespace App\Controllers;

class TechnoController extends CoreController
{
    public function technologies():void
    {
        $this->show('technos');
    }

    public function botechnos():void
    {
        $this->boShow('bo-technos');
    }

    public function addTechnoPage():void
    {
        $this->boShow('bo-add-techno');
    }
}
