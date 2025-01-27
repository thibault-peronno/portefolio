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
            if ($language->getType() === 'Front-end') {
                $data[] = $language;
            } 
        };
        return $data;
    }
    public function sortLangageByBackType($languages)
    {
        $data = [];
        foreach ($languages as $language) {
            if ($language->getType() === 'Back-end') {
                $data[] = $language;
            }
        };
        return $data;
    }
    public function sortLangageByDevopsType($languages)
    {
        $data = [];
        foreach ($languages as $language) {
            if ($language->getType() === 'DevOps') {
                $data[] = $language;
            }
        };
        return $data;
    }
}
