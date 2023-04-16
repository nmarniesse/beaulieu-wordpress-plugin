<?php

declare(strict_types=1);

namespace Beaulieu\Domain;

interface MovieRepositoryInterface
{
    /**
     * @return Beaulieu\Domain\Movie[]
     */
    public function getMoviesForWeek(\DateTimeImmutable $firstDay): array;
}
