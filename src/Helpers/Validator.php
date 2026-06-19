<?php

namespace Helpers;

class Validator
{
    public static function required(?string $value): bool
    {
        return trim((string)$value) !== '';
    }

    public static function email(string $email): bool
    {
        return filter_var($email, FILTER_VALIDATE_EMAIL) !== false;
    }

    public static function min(string $value, int $length): bool
    {
        return mb_strlen($value) >= $length;
    }

    public static function max(string $value, int $length): bool
    {
        return mb_strlen($value) <= $length;
    }

    public static function same(string $a, string $b): bool
    {
        return $a === $b;
    }
}