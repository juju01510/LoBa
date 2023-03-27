<?php

namespace App\Service;

use App\Repository\TranslationRepository;

class TranslationService
{
    public function getTranslation($locale, $request, string $entity, TranslationRepository $translationRepository, array $keys)
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
}
