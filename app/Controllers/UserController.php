<?php
namespace App\Controllers;

use App\Models\User;
use App\Repositories\UserRepository;

class UserController extends CoreController {

    public function user()
    {
        try {
            $userRepository = new UserRepository();

            $user = $userRepository->getUsers();
            $data = [];

            $userModel = new User();

            $userModel->set_id($user["id"]);
            $userModel->set_firstname($user["firstname"]);
            $userModel->set_lastname($user["lastname"]);
            $userModel->set_role_id($user["roleId"]);

            $data["user"] = $userModel;

            return $data;

        } catch (\Throwable $error) {
            $data = [
                "message" => $error->getMessage(),
                "succeeded" => false,
            ];
            $this->page_to_display('error', $data);
        }


    }
}