<?php

declare(strict_types=1);

namespace Conjure\Strings;

use Exception;
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
     * @throws Exception
     */
    public function __construct(
        private string $string
    )
    {
        $stripInvalidUtfCharactersFromString = @iconv(
            from_encoding: 'UTF-8',
            to_encoding: 'UTF-8//IGNORE',
            string: $string
        );

        if (!$stripInvalidUtfCharactersFromString) {
            throw new Exception();
        }

        $html = htmlspecialchars(
            string: $stripInvalidUtfCharactersFromString,
            flags: ENT_QUOTES
        );

        $sanitize = filter_var(value: $html, filter: FILTER_SANITIZE_STRING);

        if (!$sanitize) {
            throw new Exception();
        }

        $this->string = $sanitize;
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
    public function contains(bool|int|float|string $value): bool
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
     * @return int
     */
    public function length(): int
    {
        return mb_strlen(string: $this->string);
    }

    /**
     * @return bool
     */
    public function isEmpty(): bool
    {
        return $this->string === '';
    }


    /**
     * @param string $delimiter
     * @return array<string>
     */
    public function split(string $delimiter): array
    {
        if ($delimiter === '') {
            return [];
        }

        return explode(separator: $delimiter, string: $this->string);
    }

    /**
     * @return string
     */
    public function __toString(): string
    {
        return $this->string;
    }

}