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
        $template = $this->twig->load('planning.html');

		return $template->render([
            'last_week' => '2023-03-29',
            'next_week' => '2023-04-12',
            'planning' => $this->planning($getWeekPlanning->firstDay()),
        ]);
    }

    private function planning(\DateTimeImmutable $firstDay): string
	{
        // @TODO: use repository
//        $movies = $this->movieRepository->getMoviesForWeek($firstDay);

        $movie = pods('film');
		$where = [];
		$date = $firstDay;
		for ($i = 0; $i < 7; $i++) {
			$where[] = 'projections_vf.meta_value LIKE "' . $date->format('Y-m-d') . '%"';
			$where[] = 'projections_vost.meta_value LIKE "' . $date->format('Y-m-d') . '%"';
			$where[] = 'projections_vf_stsme.meta_value LIKE "' . $date->format('Y-m-d') . '%"';
			$date = $date->modify('+1 day');
		}
		$movie->find(['page' => 1, 'limit' => 20, 'where' => \implode(' OR ', $where)]);

		$content = '';
		while ($movie->fetch()) {
			// From the documentation, this line is needed when we display template for multiple items
			// See https://docs.pods.io/code/pods/template/
			$movie->id = $movie->id();

			// @TODO: keep only projections that belong to the week
			$planningVF = \array_map(
				fn (string $date): array => ['date' => $date, 'type' => 'VF'],
				\explode(',', $movie->display('projections_vf'))
			);
			$planningVO = \array_map(
				fn (string $date): array => ['date' => $date, 'type' => 'VOST'],
				\explode(',', $movie->display('projections_vost'))
			);
			$planningVFSTSME = \array_map(
				fn (string $date): array => ['date' => $date, 'type' => 'VF ST-SME'],
				\explode(',', $movie->display('projections_vf_stsme'))
			);
			$allPlanning = \array_merge($planningVF, $planningVO, $planningVFSTSME);
			$allPlanning = \array_filter($allPlanning, fn (array $planning): bool => !empty($planning['date']));

			\usort($allPlanning, fn ($p1, $p2): int => \strcmp($p1['date'], $p2['date']));

			$htmlPlanning = '';
			foreach ($allPlanning as $planning) {
				$htmlPlanning .= \strtr(
					<<<HTML
					<p style="margin-bottom: 8px;" class="seance">
						<span class="showtimeDate">{date}</span>
						<span class="showtime">{type}</span>
					</p>
HTML,
					[
						'{date}' => $planning['date'],
						'{type}' => $planning['type'],
					]
				);
			}


			$content .= str_replace('<!--planning-->', $htmlPlanning, $movie->template('Listing Films'));
		}

		return $content;
	}
}
