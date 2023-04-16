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
        private ?Media $poster = null,
        private ?Media $trailer = null,
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

    public function poster(): ?Media
    {
        return $this->poster;
    }

    public function trailer(): ?Media
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
