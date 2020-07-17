<?php

namespace LaravelBundle\Auth\Shared\Domain\ValueObject;

/**
 * Class BoolValueObject
 *
 * @package LaravelBundle\Auth\Shared\Domain\ValueObject
 */
abstract class BoolValueObject
{
    protected bool $value;

    /**
     * BoolValueObject constructor.
     *
     * @param bool $value
     */
    public function __construct(bool $value)
    {
        $this->value = $value;
    }

    /**
     * @return bool
     */
    public function value(): bool
    {
        return $this->value;
    }
}
