<?php

namespace App\Controllers;

use App\Models\Languages;

class LanguageController extends CoreController
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

    public function addTechno():void
    {
        dump($_POST);
        dump($_FILES);
        die;

        $languagesModel = new Languages;

        // Clean data with filter sanitaze
        $label = filter_input(INPUT_POST, 'label', FILTER_SANITIZE_SPECIAL_CHARS);
        $picture = filter_input(INPUT_POST, 'picture', FILTER_SANITIZE_SPECIAL_CHARS);
        $type = filter_input(INPUT_POST, 'type', FILTER_SANITIZE_SPECIAL_CHARS);

        
        if( !filter_var($label) || !filter_var($picture) || !filter_var($type)) {
            // alors j'execute un code d'erreur;
        }

        // dump($label, $picture, $type);
        // die;

        $languagesModel->setLabel($label);
        $languagesModel->setPicture($picture);
        $languagesModel->setType($type);

        $insert = $languagesModel->addLanguages();

        $data = [];
        dump($insert);
        if (isset($insert)) {
            $data['succeeded'] = $insert;
        }

        $this->boShow('bo-add-techno', $data);
    }
}
