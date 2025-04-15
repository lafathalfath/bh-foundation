<?php

use Stichoza\GoogleTranslate\GoogleTranslate;

if (!function_exists('translate')) {
    function translate($text, $locale = 'en')
    {
        if (!$text) return '';

        $cacheKey = md5($text . $locale);
        $cached = cache()->get($cacheKey);

        if ($cached) {
            return $cached;
        }

        try {
            $translator = new GoogleTranslate();
            $translator->setSource('auto');
            $translator->setTarget($locale);
            $translated = $translator->translate($text);

            // Cache hasilnya selama 1 minggu (dalam detik)
            cache()->put($cacheKey, $translated, 604800);

            return $translated;
        } catch (\Exception $e) {
            return $text; // fallback kalau gagal translate
        }
    }
}
