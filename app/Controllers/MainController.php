<?php

namespace App\Controllers;
use App\Models\User;

class MainController extends CoreController {

    public function home()
    {
        // echo 'methode home dans MainController';
        $this->show('home');
    }

    public function cv()
    {
        $this->show('cv');
    }

    public function boHome()
    {
        $user = new User;
        // dump('get user', $user->getUser());
        // die;
        $this->boShow('bo-home');
    }
};