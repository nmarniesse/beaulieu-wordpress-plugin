<?php

declare(strict_types=1);

namespace Beaulieu\Application;

final class GetWeekPlanningQuery
{
    public function __construct(private \DateTimeImmutable $firstDay)
    {
    }

    public function firstDay(): \DateTimeImmutable
    {
        return $this->firstDay;
    }
}
