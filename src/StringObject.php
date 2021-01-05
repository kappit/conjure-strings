<?php

declare(strict_types=1);

namespace Conjure\Strings;

/**
 * Class StringObject
 * @package Conjure\Strings
 */
class StringObject implements \Stringable
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
     * @return string
     */
    public function __toString() : string
    {
        return $this->string;
    }

}