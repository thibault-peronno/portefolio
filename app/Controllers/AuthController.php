<?php
/* partager entre user, register et auth */

namespace App\Controllers;

use App\Repositories\AuthRepository;

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
            $AuthRepository = new AuthRepository();

            // récupérer l'utilisateur qui se connecte à un compte enregistré
            $getUser = $AuthRepository->get_register_by_login($_POST['mail'], $_POST['password']);

            if (!$getUser) {
                $this->wrong_identifiants();
                exit();
            }

            session_start();
            $_SESSION['user_id'] = $getUser->get_id();
            $_SESSION['firstname'] = $getUser->get_firstname();
            $_SESSION['lastname'] = $getUser->get_lastname();

            $this->display_admin_home_page();
            exit();
        } catch (\Throwable $error) {
            $data = [
                "message" => $error->getMessage(),
                "succeeded" => false
            ];
            $this->page_to_display('error', $data);
        }
    }

    public function wrong_identifiants(): void
    {
        $data = [
            "message" => "Vos identifiants ne sont pas valides",
            "succeeded" => false
        ];
        $this->connect_page($data);
    }

    /* Travailler un message de confirmation de création de compte */
    public function create_new_account(): void
    {
        try {

            $authRepository = new AuthRepository();
            $authRepository->add_register(htmlspecialchars($_POST['firstname']), htmlspecialchars($_POST['lastname']), 2);
            

            $this->connect_page();
        } catch (\Throwable $error) {
            $data = [
                "message" => $error->getMessage(),
                "succeeded" => false
            ];
            $this->page_to_display('error', $data);
        }
    }
}
