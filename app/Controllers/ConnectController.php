<?php
/* partager entre user, register et auth */

namespace App\Controllers;

use App\Models\User;
use App\Models\Register;

class ConnectController extends CoreController
{
    public function page(): void
    {
        $this->show('connect');
    }

    public function loginPage(): void
    {
        $this->show('log-in');
    }

    public function logToBackOffice(): void
    {

        $registerModel = new Register();
        $registerModel->setMail($_POST['mail']);

        // récupérer l'utilisateur qui se connecte à un compte enregistré
        $getUser = $registerModel->getUser();
        if ($getUser['user']) {
            // comparer le mot de passe de $_POST avec le password stocké en base de données
            $isPasswordEqual = $this->isPasswordEqual($registerModel);

            if ($isPasswordEqual) {
                session_start();

                $_SESSION['user_id'] = $getUser['user_id'];
                $_SESSION['firstname'] = $getUser['firstname'];
                $_SESSION['lastname'] = $getUser['lastname'];
                header("Location: /bo-accueil");
                exit();
            }

            // si pas identique, envoyer un message et rester sur la page
            $this->page();
        }

        $this->page();
    }


    public function isPasswordEqual(Register $registerModel): bool
    {
        try {
            $isHashEqual =  hash_equals(hash('sha256', $_POST['password']), $registerModel->password);

            if ($isHashEqual) {
                return true;
            }
            return false;
        } catch (\Throwable $error) {
            dump($error);
        }
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
        } catch (\Throwable $error) {
            dump($error);
        }
    }
    /* Attention, le password ne peut pas être null sur la méthode hash, il faut travailler ça */
    public function isAddRegister($userId): bool
    {
        $registerModel = new Register();
        try {
            $registerModel->setMail(htmlspecialchars($_POST['mail']));
            $registerModel->setPassword(htmlspecialchars($_POST['password']));
            $registerModel->setUserId($userId);

            $registerModel->isAddRegister();

            return true;
        } catch (\Throwable $error) {
            dump($error);
        }
    }
}
