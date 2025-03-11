<?php

namespace App\Helpers;

use Stichoza\GoogleTranslate\GoogleTranslate;

class TranslationHelper
{
    public static function translateText($text, $lang)
    {
        if (empty($text)) {
            return ''; // Menghindari error jika teks kosong
        }

        return (new GoogleTranslate())->setSource('en')->setTarget($lang)->translate($text);
    }
}