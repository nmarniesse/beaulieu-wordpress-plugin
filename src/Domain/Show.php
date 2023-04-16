<?php

declare(strict_types=1);

namespace Beaulieu\Domain;

final class Show
{
    public function __construct(
        private \DateTimeImmutable $startAt,
        private Version $version
    ) {
    }

    public function startAt(): \DateTimeImmutable
    {
        return $this->startAt;
    }

    public function version(): Version
    {
        return $this->version;
    }
}
