<?php

namespace App\Controllers;

use App\Models\User;
use App\Models\Register;
use App\Utils\Database;

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

    public function logToBackOffice()
    {
        dd($_POST);
        // récupérer l'utilisateur qui se connecte par son email

        // comparer le mot de passe de $_POST  avec le password stocké en base de données.

        // si pas identique, envoyer un message et rester sur la page

        // si identique, rediriger vers le page d'acceuil du back office
    }

    /* Travailler un message de confirmation de création de compte */
    public function signIn()
    {
        $userModel = new User();
        try {
            $userModel->setFirstname(htmlspecialchars($_POST['firstname']));
            $userModel->setLastname(htmlspecialchars($_POST['lastname']));
            $userModel->setRoleId(2);
    
            $addUser = $userModel->isAddUser();

            $this->page();
           
        } catch (\Throwable $th) {
           dump($th);
        }

    }
    /* Attention, le password ne peut pas être null sur la méthode hash, il faut travailler ça */
    public function IsRegister($userId): bool
    {
        $registerModel = new Register();
        try {
            $registerModel->setMail(htmlspecialchars($_POST['mail']));
            $registerModel->setPassword(htmlspecialchars($_POST['password']));
            $registerModel->setUserId($userId);

            $registerModel->isRegister();
            
            return true;
        } catch (\Throwable $th) {
            dump($th);
        }
    }
}
