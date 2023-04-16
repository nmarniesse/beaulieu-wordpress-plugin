<?php

declare(strict_types=1);

namespace Beaulieu\Domain;

final class Version
{
    private function __construct(private string $version)
    {
    }

    public static function createVF(): Version
    {
        return new self('VF');
    }

    public static function createVOSTF(): Version
    {
        return new self('VOSTF');
    }

    public static function createVFSTSME(): Version
    {
        return new self('VF ST-SME');
    }
}
