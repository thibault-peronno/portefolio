<?php
namespace App\Controllers;

class OrgaController extends CoreController
{
    public function organization():void
    {
        $this->boShow('bo-orga');
    }

    public function addOrgaPage():void
    {
        $this->boShow('bo-add-orga');
    }
}