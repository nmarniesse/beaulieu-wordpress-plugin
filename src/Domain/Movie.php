<?php

declare(strict_types=1);

namespace Beaulieu\Domain;

final class Movie
{
    /**
     * @param Show[] $shows
     */
    public function __construct(
        private MovieTitle $title,
        private string $shortDescription,
        private ?int $durationInMinutes,
        private string $castingDescription,
        private string $synopsis,
        private ?Poster $poster = null,
        private ?Poster $trailer = null,
        private array $shows = []
    ) {
    }

    public function title(): MovieTitle
    {
        return $this->title;
    }

    public function shortDescription(): string
    {
        return $this->shortDescription;
    }

    public function durationInMinutes(): ?int
    {
        return $this->durationInMinutes;
    }

    public function castingDescription(): string
    {
        return $this->castingDescription;
    }

    public function synopsis(): string
    {
        return $this->synopsis;
    }

    public function poster(): ?Poster
    {
        return $this->poster;
    }

    public function trailer(): ?Poster
    {
        return $this->trailer;
    }

    /**
     * @return Show[]
     */
    public function shows(): array
    {
        return $this->shows;
    }
}
