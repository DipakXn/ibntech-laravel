<?php

namespace App\Services\Analytics;

final class IpNetwork
{
    public static function normalize(string $value): ?string
    {
        $value = trim($value);

        if ($value === '' || preg_match('/\s/', $value) === 1 || str_contains($value, '%')) {
            return null;
        }

        if (str_starts_with($value, '[') && str_ends_with($value, ']')) {
            $value = substr($value, 1, -1);
        }

        if (! str_contains($value, '/')) {
            return self::canonicalAddress($value);
        }

        $parts = explode('/', $value, 2);

        if (count($parts) !== 2 || $parts[0] === '' || preg_match('/^(0|[1-9][0-9]*)$/', $parts[1]) !== 1) {
            return null;
        }

        $address = self::binaryAddress($parts[0]);

        if ($address === null) {
            return null;
        }

        $bits = (int) $parts[1];
        $maxBits = strlen($address) * 8;

        if ($bits > $maxBits) {
            return null;
        }

        if ($bits === $maxBits) {
            $single = inet_ntop($address);

            return is_string($single) ? $single : null;
        }

        $network = inet_ntop(self::mask($address, $bits));

        return is_string($network) ? $network.'/'.$bits : null;
    }

    public static function contains(string $rule, string $ip): bool
    {
        $rule = self::normalize($rule);
        $address = self::binaryAddress($ip);

        if ($rule === null || $address === null) {
            return false;
        }

        if (! str_contains($rule, '/')) {
            $ruleAddress = self::binaryAddress($rule);

            return $ruleAddress !== null && $ruleAddress === $address;
        }

        [$network, $bits] = explode('/', $rule, 2);
        $networkAddress = self::binaryAddress($network);

        if ($networkAddress === null || strlen($networkAddress) !== strlen($address)) {
            return false;
        }

        $prefix = (int) $bits;
        $bytes = intdiv($prefix, 8);
        $remainder = $prefix % 8;

        if ($bytes > 0 && substr($address, 0, $bytes) !== substr($networkAddress, 0, $bytes)) {
            return false;
        }

        if ($remainder === 0) {
            return true;
        }

        $mask = (0xFF << (8 - $remainder)) & 0xFF;

        return (ord($address[$bytes]) & $mask) === (ord($networkAddress[$bytes]) & $mask);
    }

    public static function canonicalAddress(string $ip): ?string
    {
        $address = self::binaryAddress($ip);

        if ($address === null) {
            return null;
        }

        $canonical = inet_ntop($address);

        return is_string($canonical) ? $canonical : null;
    }

    private static function binaryAddress(string $ip): ?string
    {
        $ip = trim($ip);

        if ($ip === '' || filter_var($ip, FILTER_VALIDATE_IP) === false) {
            return null;
        }

        $binary = inet_pton($ip);

        if (! is_string($binary)) {
            return null;
        }

        if (strlen($binary) === 16 && str_starts_with($binary, str_repeat("\0", 10)."\xff\xff")) {
            return substr($binary, 12);
        }

        return $binary;
    }

    private static function mask(string $address, int $bits): string
    {
        $masked = '';
        $length = strlen($address);

        for ($index = 0; $index < $length; $index++) {
            $keep = $bits - ($index * 8);

            if ($keep >= 8) {
                $masked .= $address[$index];

                continue;
            }

            if ($keep <= 0) {
                $masked .= "\0";

                continue;
            }

            $mask = (0xFF << (8 - $keep)) & 0xFF;
            $masked .= chr(ord($address[$index]) & $mask);
        }

        return $masked;
    }
}
