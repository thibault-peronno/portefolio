<?php

namespace App\Controllers;

class TechnoController extends CoreController
{
    public function technologies():void
    {
        $this->show('technos');
    }
}
