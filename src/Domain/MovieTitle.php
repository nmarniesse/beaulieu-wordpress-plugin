<?php

declare(strict_types=1);

namespace Beaulieu\Domain;

use Webmozart\Assert\Assert;

final class MovieTitle
{
    private array $shows = [];

    public function __construct(private string $title)
    {
        Assert::stringNotEmpty($title);
    }

    public function asString(): string
    {
        return $this->title;
    }
}
