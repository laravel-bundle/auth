<?php

namespace LaravelBundle\Auth\Shared\Domain\ValueObject;

/**
 * Class StringValueObject
 *
 * @package LaravelBundle\Auth\Shared\Domain\ValueObject
 */
abstract class StringValueObject
{
    protected string $value;

    /**
     * StringValueObject constructor.
     * @param string $value
     */
    public function __construct(string $value)
    {
        $this->value = $value;
    }

    /**
     * @return string
     */
    public function value(): string
    {
        return $this->value;
    }

    /**
     * @param StringValueObject $object
     * @return bool
     */
    public function equals(StringValueObject $object): bool
    {
        return $this->value() === $object->value();
    }

    /**
     * @return string
     */
    public function __toString(): string
    {
        return $this->value();
    }
}
