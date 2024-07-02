<?php 

namespace App\Helpers;
use App\Models\Languages;

class GetLangagesHelper
{
    public function getLanguages(): array
    {
        try {
            $langagesModel = new Languages();

            return $langagesModel->getLanguages();
        } catch (\Throwable $error) {
            dump($error);
        }
    }
}