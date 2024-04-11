<?php

namespace App\Controllers;

class MainController extends CoreController {

    public function home()
    {
        // echo 'methode home dans MainController';
        $this->show('home');
    }
};