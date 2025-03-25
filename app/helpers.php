<?php

use Stichoza\GoogleTranslate\GoogleTranslate;

if (!function_exists('translate')) {
    function translate($text, $targetLocale)
    {
        if (!$text) return ''; // Jika teks kosong, langsung return kosong.

        $translator = new GoogleTranslate();
        $translator->setSource('auto'); // Biarkan Google mendeteksi bahasa
        $translator->setTarget($targetLocale); // Bahasa tujuan

        return $translator->translate($text);
    }
}

?>