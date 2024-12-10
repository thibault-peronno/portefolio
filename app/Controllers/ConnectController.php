<?php
/* partager entre user, register et auth */

namespace App\Controllers;

use App\Models\User;
use App\Models\Register;
use App\Repositories\RegisterRepository;
use App\Repositories\UserRepository;

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
        try {
            $registerModel = new Register();
            $registerRepository = new RegisterRepository();
            dump($_POST['mail']);
            $registerModel->setMail($_POST['mail']);
    
            // récupérer l'utilisateur qui se connecte à un compte enregistré
            $getUser = $registerRepository->getUser();
            if ($getUser['user']) {
                // comparer le mot de passe de $_POST avec le password stocké en base de données
                $isPasswordEqual = $this->isPasswordEqual($registerModel);
    
                if ($isPasswordEqual) {
                    session_start();
    
                    $_SESSION['user_id'] = $getUser['user_id'];
                    $_SESSION['firstname'] = $getUser['firstname'];
                    $_SESSION['lastname'] = $getUser['lastname'];
                    header("Location: /admin-accueil");
                    exit();
                }
    
                // si pas identique, envoyer un message et rester sur la page
                $this->page();
            }
    
            $this->page();
        } catch (\Throwable $error) {
            throw $error;
        }
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
            throw $error;
        }
    }

    /* Travailler un message de confirmation de création de compte */
    public function signIn()
    {
        try {
            $userModel = new User();
            $userRepository = new UserRepository();
            
            $userModel->setFirstname(htmlspecialchars($_POST['firstname']));
            $userModel->setLastname(htmlspecialchars($_POST['lastname']));
            $userModel->setRoleId(2);

            $addUser = $userRepository->addUser();

            $this->page();
        } catch (\Throwable $error) {
            throw $error;
        }
    }
    /* Attention, le password ne peut pas être null sur la méthode hash, il faut travailler ça */
    public function isAddRegister($userId): bool
    {
        try {
            $registerModel = new Register();
            $registerRepository = new RegisterRepository();

            $registerModel->setMail(htmlspecialchars($_POST['mail']));
            $registerModel->setPassword(htmlspecialchars($_POST['password']));
            $registerModel->setUserId($userId);

            $registerRepository->isAddRegister();

            return true;
        } catch (\Throwable $error) {
            throw $error;
        }
    }
}
