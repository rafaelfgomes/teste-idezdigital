<?php

namespace App\Helpers;

class AccountHelper
{
    public static function accountExists(array $account, array $data): bool
    {
        if (
            $account['agency'] === $data['agency'] &&
            $account['number'] === $data['number'] &&
            $account['digit'] === $data['digit']
        ) {
            return true;
        }

        return false;
    }

    public static function typeExists(array $account, array $data): bool
    {
        if ($account['account_type_id'] === intval($data['type'])) {
            return true;
        }

        return false;
    }
}