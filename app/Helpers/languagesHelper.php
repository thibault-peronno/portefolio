<?php

namespace App\Helpers;

use App\Repositories\LanguagesRepository;

class LanguagesHelper
{
    public function get_languages_helper(): array
    {
        try {
            $languagesRepository = new LanguagesRepository();

            return $languagesRepository->get_languages();
        } catch (\Throwable $error) {
            throw $error;
        }
    }

    public function sort_langages_by_type($languages)
    {
        $data = [];
        foreach ($languages as $language) {
            if ($language->get_type() === 'Front-end') {
                $data[] = $language;
            }
        };
        return $data;
    }
    public function sortLangageByBackType($languages)
    {
        $data = [];
        foreach ($languages as $language) {
            if ($language->get_type() === 'Back-end') {
                $data[] = $language;
            }
        };
        return $data;
    }
    public function sortLangageByDevopsType($languages)
    {
        $data = [];
        foreach ($languages as $language) {
            if ($language->get_type() === 'DevOps') {
                $data[] = $language;
            }
        };
        return $data;
    }
}
