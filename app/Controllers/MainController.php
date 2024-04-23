<?php

namespace App\Controllers;
use App\Models\User;

class MainController extends CoreController {

    public function home(): void
    {
        // echo 'methode home dans MainController';
        $this->show('home');
    }

    public function cv(): void
    {
        $this->show('cv');
    }

    public function boHome(): void
    {
        $user = new User;
        // dump('get user', $user->getUser());
        // die;
        $this->boShow('bo-home');
    }
};