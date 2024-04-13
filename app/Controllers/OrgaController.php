<?php
namespace App\Controllers;

class OrgaController extends CoreController
{
    public function organization():void
    {
        $this->boShow('bo-orga');
    }
}