<?php

declare(strict_types=1);

namespace Beaulieu\Infrastructure;

use Beaulieu\Domain\Poster;
use Beaulieu\Domain\Movie;
use Beaulieu\Domain\MovieRepositoryInterface;
use Beaulieu\Domain\MovieTitle;
use Beaulieu\Domain\Show;
use Beaulieu\Domain\Version;

final class PodMovieRepository implements MovieRepositoryInterface
{
    public function getMoviesForWeek(\DateTimeImmutable $firstDay): array
    {
        $podMovie = pods('film');
		$where = [];
		$date = $firstDay;
		for ($i = 0; $i < 7; $i++) {
			$where[] = 'shows_vf.meta_value LIKE "' . $date->format('Y-m-d') . '%"';
			$where[] = 'shows_vost.meta_value LIKE "' . $date->format('Y-m-d') . '%"';
			$where[] = 'shows_vf_stsme.meta_value LIKE "' . $date->format('Y-m-d') . '%"';
			$date = $date->modify('+1 day');
		}
        $podMovie->find(['page' => 1, 'limit' => 20, 'where' => \implode(' OR ', $where)]);

		$movies = [];
		while ($podMovie->fetch()) {
            $podMovie->id = $podMovie->id();

            // @TODO: keep only projections that belong to the week
            $shows = [
                ...$this->createShowFromStorage($podMovie->display('shows_vf'), Version::createVF()),
                ...$this->createShowFromStorage($podMovie->display('shows_vost'), Version::createVOSTF()),
                ...$this->createShowFromStorage($podMovie->display('shows_vf_stsme'), Version::createVFSTSME()),
            ];
            \usort($shows, fn (Show $s1, Show $s2): int => $s1->startAt() <=> $s2->startAt());

            $movie = new Movie(
                new MovieTitle($podMovie->display('post_title')),
                $podMovie->display('short_description'),
                $podMovie->display('duration') ? (int) $podMovie->display('duration') : null,
                $podMovie->display('casting_description'),
                $podMovie->display('synopsis'),
                $podMovie->display('poster._src')
                    ? new Poster($podMovie->display('poster._src'), $podMovie->display('poster._img.alt_text'))
                    : null,
                $podMovie->display('trailer._src')
                    ? new Poster($podMovie->display('trailer._src'), $podMovie->display('trailer._img.alt_text'))
                    : null,
                $shows
            );

            $movies[] = $movie;
        }

        return $movies;
    }

    /**
     * @return Show[]
     */
    private function createShowFromStorage(string $data, Version $version): array
    {
        $shows = \array_map(
            function (string $date) use ($version): ?Show {
                $date = \DateTimeImmutable::createFromFormat('Y-m-d H:i', $date);
                return $date instanceof \DateTimeImmutable
                    ? new Show($date, $version)
                    : null;
            },
            \explode(',', $data)
        );

        return \array_filter($shows);
    }
}
