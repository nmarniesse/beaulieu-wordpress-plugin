<?php

declare(strict_types=1);

namespace Beaulieu\Infrastructure\Controller;

use Beaulieu\Application\GetWeekPlanningQuery;
use Beaulieu\Application\GetWeekPlanningHandler;

final class GetWeekPlanningController
{
    public function __construct(private GetWeekPlanningHandler $handler)
    {
    }

    public function __invoke(\DateTimeImmutable $firstDay)
    {
        $query = new GetWeekPlanningQuery($firstDay);

        return ($this->handler)($query);
    }
}
