<?php

declare(strict_types=1);

namespace Beaulieu\Infrastructure;

use Beaulieu\Domain\Movie;
use Beaulieu\Domain\MovieRepositoryInterface;
use Beaulieu\Domain\MovieTitle;

final class PodMovieRepository implements MovieRepositoryInterface
{
    public function getMoviesForWeek(\DateTimeImmutable $firstDay): array
    {
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

		$movies = [];
		while ($movie->fetch()) {
            $movie->id = $movie->id();

            $movies[] = new Movie(
                new MovieTitle($movie->display('post_title')),
                $movie->display('description_courte'),
                null,
                $movie->display('acteurs_actrices'),
                $movie->display('synopsis'),
                $movie->display('affiche._src'),
                'trailer_link_todo',
            );

        }

        return $movies;
    }
}
