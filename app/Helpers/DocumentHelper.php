<?php

namespace App\Helpers;

class DocumentHelper
{
    public static function sanitizeDocument(string $document): string
    {
        $documentSanitized = str_replace('-', '', $document);
        $documentSanitized = str_replace('.', '', $documentSanitized);

        if (strlen($documentSanitized) > 11) {
            $documentSanitized = str_replace('/', '', $documentSanitized);
        }

        return $documentSanitized;
    }

    public static function formatToResponse(string $document): string
    {
        $partOne = substr($document,0,3);
        $partTwo = substr($document,3,3);
        $partThree = substr($document,6,3);
        $digit = substr($document,-2);
        
        return  $partOne.".".$partTwo.".".$partThree."-".$digit;
    }
}