<?php

namespace LaravelBundle\Auth\Shared\Domain\ValueObject;

/**
 * Class IntValueObject
 *
 * @package LaravelBundle\Auth\Shared\Domain\ValueObject
 */
abstract class IntValueObject
{
    protected int $value;

    /**
     * IntValueObject constructor.
     *
     * @param int $value
     */
    public function __construct(int $value)
    {
        $this->value = $value;
    }

    /**
     * @return int
     */
    public function value(): int
    {
        return $this->value;
    }

    /**
     * @param IntValueObject $object
     * @return bool
     */
    public function toEquals(IntValueObject $object): bool
    {
        return $this->value() === $object->value();
    }

    /**
     * @return string
     */
    public function __toString(): string
    {
        return (string) $this->value();
    }
}
