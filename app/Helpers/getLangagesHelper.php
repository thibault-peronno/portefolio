<?php

namespace App\Helpers;

use App\Models\Languages;
use App\Repositories\LanguagesRepository;

class GetLangagesHelper
{
    public function getLanguages(): array
    {
        try {
            $languagesRepository = new LanguagesRepository();

            return $languagesRepository->getLanguages();
        } catch (\Throwable $error) {
            throw $error;
        }
    }
}
