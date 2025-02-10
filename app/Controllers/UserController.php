<?php
namespace App\Controllers;

use App\Models\User;
use App\Repositories\UserRepository;

class UserController extends CoreController {

    public function user(): array 
    {
        try {
            $userRepository = new UserRepository();

            $user = $userRepository->getUsers();
            $data = [];

            $userModel = new User();

            $userModel->setId($user["id"]);
            $userModel->setFirstname($user["firstname"]);
            $userModel->setLastname($user["lastname"]);
            $userModel->setRoleId($user["roleId"]);

            $data["user"] = $userModel;

            return $data;

        } catch (\Throwable $error) {
            $data = [
                "message" => $error->getMessage(),
                "succeeded" => false,
            ];
            $this->show('error', $data);
        }


    }
}