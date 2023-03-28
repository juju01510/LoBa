<?php

namespace App\Service;

use App\Repository\TranslationRepository;

class TranslationService
{
    public function getTranslation(string $entity, TranslationRepository $translationRepository, array $keys)
    {
        $translations = [];
        $i = 0;

        foreach ($keys as $key) {
            $allTranslations = $translationRepository->findByKeyword($key);

            foreach ($allTranslations as $i => $translation) {
                $i++;
                $translations[$entity][$i][$key] = $translation->getValue();
            }
        }

        return $translations;
    }

    public function getAvailableTranslation(string $entities, string $entity, TranslationRepository $translationRepository, array $keys)
    {
        $translations = [];
        $i = 0;

        foreach ($keys as $key) {
            $allTranslations = $translationRepository->findAvailableByKeyword($key, $entity);

            foreach ($allTranslations as $i => $translation) {
                $i++;
                $translations[$entities][$i][$key] = $translation->getValue();
            }
        }

        return $translations;
    }
}
