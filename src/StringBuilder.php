<?php

declare(strict_types=1);

namespace Conjure\Strings;

use JetBrains\PhpStorm\Pure;
use Stringable;

/**
 * Class StringBuilder
 * @package Conjure\Strings
 */
class StringBuilder implements Stringable
{

    /**
     * StringBuilder constructor.
     * @param string $string
     */
    public function __construct(
        private string $string = ''
    )
    {
    }

    /**
     * @param bool|int|float|string $value
     * @return $this
     */
    public function append(bool|int|float|string $value): self
    {
        $this->string .= (string)$value;

        return $this;
    }

    /**
     * @param bool|int|float|string $value
     * @return $this
     */
    public function prepend(bool|int|float|string $value): self
    {
        $this->string = (string)$value . $this->string;

        return $this;
    }

    /**
     * @return StringObject
     */
    #[Pure] public function toStringObject(): StringObject
    {
        return new StringObject(string: $this->string);
    }

    /**
     * @return string
     */
    public function __toString(): string
    {
        return $this->string;
    }

}