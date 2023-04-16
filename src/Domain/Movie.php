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
        private ?string $posterLink = null,
        private ?string $trailerLink = null,
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

    public function posterLink(): ?string
    {
        return $this->posterLink;
    }

    public function trailerLink(): ?string
    {
        return $this->trailerLink;
    }

    /**
     * @return Show[]
     */
    public function shows(): array
    {
        return $this->shows;
    }
}
