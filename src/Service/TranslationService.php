<?php

namespace App\Service;

use App\Repository\TranslationRepository;

class TranslationService
{
    public function getTranslation($repository, array $keys)
    {
        foreach ($keys as $key) {
            $translations = $repository->findByKey($key);
        }

        return $translations;
    }

    public function getAvailableTranslation($repository, array $keys)
    {
        foreach ($keys as $key) {
            $translations = $repository->findAvailableByKey($key);
        }

        return $translations;
    }
}
