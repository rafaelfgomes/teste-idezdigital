<?php

namespace App\Helpers;

class DocumentHelper
{
    public static function validadeDocument(string $document): bool
    {
        return true;
    }

    public static function sanitizeDocument(string $document): string
    {
        $documentSanitized = str_replace('-', '', $document);
        $documentSanitized = str_replace('.', '', $documentSanitized);

        dd($documentSanitized);

        return $documentSanitized;
    }
}