<?php
/* partager entre user, register et auth */

namespace App\Controllers;

use App\Models\User;
use App\Models\Auth;
use App\Repositories\AuthRepository;
use App\Repositories\UserRepository;

class AuthController extends MainController
{

    public function page($data = []): void
    {
        $this->show('connect', $data);
    }

    public function loginPage(): void
    {
        $this->show('log-in');
    }

    public function logToBackOffice(): void
    {
        try {
            $authModel = new Auth();
            $userModel = new User();
            $AuthRepository = new AuthRepository();

            // récupérer l'utilisateur qui se connecte à un compte enregistré
            $getUser = $AuthRepository->getUser($_POST['mail'], $authModel, $userModel);
            if ($getUser["succeeded"] === false) {
                // si pas identique, envoyer un message et rester sur la page
                $this->page($getUser);
                exit();
            }
            // comparer le mot de passe de $_POST avec le password stocké en base de données
            $isPasswordEqual = $this->isPasswordEqual($authModel->getPassword());
            if ($isPasswordEqual) {
                session_start();
                $_SESSION['user_id'] = $userModel->getId();
                $_SESSION['firstname'] = $userModel->getFirstname();
                $_SESSION['lastname'] = $userModel->getLastname();


                $this->boHome();
                exit();
            }

            $this->page();
        } catch (\Throwable $error) {
            throw $error;
        }
    }


    public function isPasswordEqual($password): bool
    {
        try {
            if ($password) {
                $isHashEqual =  hash_equals(hash('sha256', $_POST['password']), $password);
            }

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
            $authModel = new Auth();
            $AuthRepository = new AuthRepository();

            $authModel->setMail(htmlspecialchars($_POST['mail']));
            $authModel->setPassword(htmlspecialchars($_POST['password']));
            $authModel->setUserId($userId);

            $AuthRepository->isAddRegister();

            return true;
        } catch (\Throwable $error) {
            throw $error;
        }
    }
}
