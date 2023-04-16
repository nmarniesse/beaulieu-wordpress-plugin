<?php

declare(strict_types=1);

namespace Beaulieu\Application;

use Beaulieu\Domain\MovieRepositoryInterface;
use Twig\Environment;

final class GetWeekPlanningHandler
{
	public function __construct(private MovieRepositoryInterface $movieRepository, private Environment $twig)
	{
	}

    public function __invoke(GetWeekPlanningQuery $getWeekPlanning): string
    {
        $movies = $this->movieRepository->getMoviesForWeek($getWeekPlanning->firstDay());

        $template = $this->twig->load('planning.html.twig');

		return $template->render([
            'last_week' => '2023-03-29',
            'next_week' => '2023-04-12',
            'movies' => $movies,
        ]);
    }
}
