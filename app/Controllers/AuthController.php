<?php
/* partager entre user, register et auth */

namespace App\Controllers;

use App\Models\User;
use App\Models\Auth;
use App\Repositories\AuthRepository;
use App\Repositories\UserRepository;

class AuthController extends MainController
{

    public function connect_page($data = []): void
    {
        $this->page_to_display('connect', $data);
    }

    public function display_login_page(): void
    {
        $this->page_to_display('log-in');
    }

    public function sign_in_back_office(): void
    {
        try {
            $authModel = new Auth();
            $userModel = new User();
            $AuthRepository = new AuthRepository();

            // récupérer l'utilisateur qui se connecte à un compte enregistré
            $getUser = $AuthRepository->get_register($_POST['mail'], $authModel, $userModel);
            
            if (!$getUser) {
                $this->wrong_identifiants();
                exit();
            }
            // comparer le mot de passe de $_POST avec le password stocké en base de données
            $isPasswordEqual = $this->is_password_equal($authModel->get_password());
        
            if ($isPasswordEqual) {
                session_start();
                $_SESSION['user_id'] = $userModel->get_id();
                $_SESSION['firstname'] = $userModel->get_firstname();
                $_SESSION['lastname'] = $userModel->get_lastname();

                $this->display_admin_home_page();
                exit();
            }

            if(!$isPasswordEqual) {
                $this->wrong_identifiants();
            }
        } catch (\Throwable $error) {
            $data = [
                "message" => $error->getMessage(),
                "succeeded" => false
            ];
            $this->page_to_display('error', $data);
        }
    }

    public function wrong_identifiants() : void
    {
        $data = [
            "message" => "Vos identifiants ne sont pas valides",
            "succeeded" => false
        ];
        $this->connect_page($data);
    }


    public function is_password_equal($password): bool
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
    public function create_new_account(): void
    {
        try {
            $userModel = new User();
            
            $userModel->set_firstname(htmlspecialchars($_POST['firstname']));
            $userModel->set_lastname(htmlspecialchars($_POST['lastname']));
            $userModel->set_role_id(2);
            
            $userRepository = new UserRepository();
            $userRepository->addUser();

            $this->connect_page();
        } catch (\Throwable $error) {
            throw $error;
        }
    }
    /* Attention, le password ne peut pas être null sur la méthode hash, il faut travailler ça */
    public function is_register_added($userId): bool
    {
        try {
            $authModel = new Auth();
            
            $authModel->set_mail(htmlspecialchars($_POST['mail']));
            $authModel->set_password(htmlspecialchars($_POST['password']));
            $authModel->set_user_id($userId);
            
            $AuthRepository = new AuthRepository();
            $AuthRepository->is_register_added();

            return true;
        } catch (\Throwable $error) {
            throw $error;
        }
    }
}
