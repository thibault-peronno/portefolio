<?php

namespace App\Helpers;

use App\Repositories\LanguagesRepository;
use App\Repositories\ProjectLanguageRepository;

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
    public function sort_languages(): array
    {
        try {
            $data = [];
            $languagesRepository = new LanguagesRepository();
            $languages = $languagesRepository->get_languages();

            $data['languages']['Front-end'] = self::sort_langages_by_front_type($languages);
            $data['languages']['Back-end'] = self::sort_langages_by_back_type($languages);
            $data['languages']['DevOps'] = self::sort_langages_by_devOps_type($languages);
            $data['arrayNumberOfProjectDevBylanguage'] = self::count_number_of_project_dev_by_language($languages);

            return $data;
        } catch (\Throwable $error) {
            throw $error;
        }
    }

    private static function sort_langages_by_front_type(array $languages): array
    {
        try {
            $data = [];
            foreach ($languages as $language) {
                if ($language->get_type() === 'Front-end') {
                    $data[] = $language;
                }
            };
            return $data;
        } catch (\Throwable $error) {
            throw $error;
        }
    }

    private static function sort_langages_by_back_type(array $languages): array
    {
        try {
            $data = [];
            foreach ($languages as $language) {
                if ($language->get_type() === 'Back-end') {
                    $data[] = $language;
                }
            };
            return $data;
        } catch (\Throwable $error) {
            throw $error;
        }
    }

    private static function sort_langages_by_devOps_type(array $languages): array
    {
        try {
            $data = [];
            foreach ($languages as $language) {
                if ($language->get_type() === 'DevOps') {
                    $data[] = $language;
                }
            };
            return $data;
        } catch (\Throwable $error) {
            throw $error;
        }
    }

    private static function count_number_of_project_dev_by_language($languages): array
    {

        try {
            $data = [];
            $projectLanguageRepository = new ProjectLanguageRepository();
            $arrayAllLanguagesId = $projectLanguageRepository->get_label_language_from_project_languages_id();
            foreach ($languages as $language) {

                foreach ($arrayAllLanguagesId as $arrayAllLanguages) {

                    if ($language->get_label() === $arrayAllLanguages['label']) {
                        $data[$language->get_label()][0] = $data[$language->get_label()][0] + 1;
                    }
                }
            }

            return $data;
        } catch (\Throwable $error) {
            throw $error;
        }
    }
}
