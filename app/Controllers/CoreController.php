<?php

namespace App\Controllers;

class CoreController {

    protected $router;

    public function __construct($router)
    {
        $this->router = $router;
    }

    private function getNeededDatas(): array
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
    public function show(string $pageName, array $data = []):void
    {
        $getNeededData = $this->getNeededDatas();

        // dump($getNeededData);

        require_once __DIR__ . '/../views/inc/header.tpl.php';
        require_once __DIR__ . '/../views/' . $pageName . '.tpl.php';
        require_once __DIR__ . '/../views/inc/footer.tpl.php';
    }
}