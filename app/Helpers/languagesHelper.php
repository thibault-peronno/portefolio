<?php

namespace App\Helpers;

use App\Repositories\LanguagesRepository;

class languagesHelper
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

    public function sortLangageByFrontType($languages)
    {
        $data = [];
        foreach ($languages as $language) {
            if ($language->type === 'Front-end') {
                $data[] = $language;
            } 
        };
        return $data;
    }
    public function sortLangageByBackType($languages)
    {
        $data = [];
        foreach ($languages as $language) {
            if ($language->type === 'Back-end') {
                $data[] = $language;
            }
        };
        return $data;
    }
    public function sortLangageByDevopsType($languages)
    {
        $data = [];
        foreach ($languages as $language) {
            if ($language->type === 'DevOps') {
                $data[] = $language;
            }
        };
        return $data;
    }
}
