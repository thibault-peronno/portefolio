<?php

namespace App\Controllers;

class ConnectController extends CoreController
{
    public function page():void
    {
        $this->show('connect');
    }

    public function loginPage():void
    {
        $this->show('log-in');
    }

    public function signin()
    {
        dd($_POST);
    }
}
