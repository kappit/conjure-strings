<?php

declare(strict_types=1);

namespace Conjure\Strings;

use JetBrains\PhpStorm\Pure;
use Stringable;

/**
 * Class StringObject
 * @package Conjure\Strings
 */
class StringObject implements Stringable
{

    /**
     * StringObject constructor.
     * @param string $string
     */
    public function __construct(
        private string $string
    )
    {
    }

    /**
     * @param string $string
     * @return bool
     */
    public function equals(string $string): bool
    {
        return $this->string === $string;
    }

    /**
     * @param bool|int|float|string $value
     * @return bool
     */
    #[Pure] public function contains(bool|int|float|string $value): bool
    {
        return str_contains(haystack: $this->string, needle: (string)$value);
    }

    /**
     * @return $this
     */
    public function reverse(): self
    {
        $this->string = strrev(string: $this->string);

        return $this;
    }

    /**
     * @param string $characters
     * @return $this
     */
    public function trim(string $characters = ' '): self
    {
        $this->string = trim(string: $this->string, characters: $characters);

        return $this;
    }

    /**
     * @return bool
     */
    public function isEmpty(): bool
    {
        return $this->string === '';
    }

    /**
     * @return string
     */
    public function __toString(): string
    {
        return $this->string;
    }

}