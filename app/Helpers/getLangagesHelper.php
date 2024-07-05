<?php 

namespace App\Helpers;
use App\Models\Languages;

class GetLangagesHelper
{
    public function getLanguages(): array
    {
        try {
            $languagesModel = new Languages();

            return $languagesModel->getLanguages();
        } catch (\Throwable $error) {
            dump($error);
        }
    }
}