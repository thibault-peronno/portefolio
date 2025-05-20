<?php

namespace App\Controllers;

class CoreController
{

    protected $router;

    public function __construct($router = [])
    {
        $this->router = $router;
    }

    private function get_needed_datas(): array
    {
        return [
            // 'baseURL' => $_SERVER['BASE_URI'],
            'router' => $this->router,
        ];
    }

    /**
     * Function to display pages asked
     * 
     * @param string $pageName Name of the template
     * @param array $data array with needed datas
     * @return void
     */
    public function page_to_display(string $pageName, array $data = []): void
    {
        $getNeededData = $this->get_needed_datas();


        // include : ask to include, but does not allow a fatal error
        // require : the content is required, and if does not exist, there is a fatal error.
        /**
         * We added try catch to manage the fatal error
         */
        extract($data);
        extract($getNeededData);
        try {
            require_once __DIR__ . '/../views/inc/header.tpl.php';
            require_once __DIR__ . '/../views/' . $pageName . '.tpl.php';
            require_once __DIR__ . '/../views/inc/footer.tpl.php';
        } catch (\Throwable $th) {
            // we should to create a special page html
            header('location: /html/error.htm');
            die;
        }
    }

    public function admin_page_to_display(string $pageName, array $data = []): void
    {
        $getNeededData = $this->get_needed_datas();
        extract($data);
        extract($getNeededData);
        try {
            require_once __DIR__ . '/../views/inc/admin-header.tpl.php';
            require_once __DIR__ . '/../views/' . $pageName . '.tpl.php';
            require_once __DIR__ . '/../views/inc/admin-footer.tpl.php';
        } catch (\Throwable $th) {
            header('location: /html/error.htm');
            die;
        }
    }
}
