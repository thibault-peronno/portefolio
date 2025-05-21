<?php
namespace App\Controllers;

use App\Repositories\UserRepository;

class UserController extends CoreController {

    public function user()
    {
        try {
            $userRepository = new UserRepository();

            $data["user"] = $userRepository->getUsers();

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