<?php

declare(strict_types=1);

namespace Beaulieu\Domain;

final class Poster
{
    public function __construct(
        private string $link,
        private string $altText,
    ) {
    }

    public function link(): string
    {
        return $this->link;
    }

    public function altText(): string
    {
        return $this->altText;
    }
}
