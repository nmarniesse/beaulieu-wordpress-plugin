<?php

declare(strict_types=1);

namespace Beaulieu\Domain;

final class Movie
{
    private array $shows = [];

    public function __construct(
        private MovieTitle $title,
        private string $shortDescription,
        private ?int $durationInMinutes = null,
        private string $castingDescription,
        private string $synopsis,
        private ?string $posterLink = null,
        private ?string $trailerLink = null
    ) {
    }

    public function addShow(Show $show): void
    {
        $this->shows[] = $show;
    }

    public function title(): string
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
