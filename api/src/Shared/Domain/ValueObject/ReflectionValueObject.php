<?php

namespace LaravelBundle\Auth\Shared\Domain\ValueObject;

use ReflectionObject;

/**
 * Class ReflectionValueObject
 *
 * @package LaravelBundle\Auth\Shared\Domain\ValueObject
 */
class ReflectionValueObject
{
    /**
     * @var ValueObject
     */
    private ValueObject $valueObject;

    /**
     * ReflectionValueObject constructor.
     *
     * @param ValueObject $valueObject
     */
    public function __construct(ValueObject $valueObject)
    {
        $this->valueObject = $valueObject;
    }

    /**
     * Get instance value object.
     *
     * @return ValueObject
     */
    public function valueObject(): ValueObject
    {
        return $this->valueObject;
    }

    /**
     * Checks whether objects have the same values.
     *
     * @param ValueObject $other
     * @return bool
     */
    public function hasSameValues(ValueObject $other): bool
    {
        $reflectionObject = new ReflectionObject($other);

        $properties = $reflectionObject->getProperties();

        $properties = $this->makeAccessible($properties);

        foreach ($properties as $property) {
            if (! array_key_exists($property->getName(), $this->map())) {
                return false;
            }

            $objectMapped = $this->map()[$property->getName()];

            if ($property->getValue($other) !== $objectMapped) {
                return false;
            }
        }

        return true;
    }

    /**
     * Make private properties accessible.
     *
     * @param $properties
     * @return array
     */
    private function makeAccessible($properties): array
    {
        foreach ($properties as $property) {
            $property->setAccessible(true);
        }

        return $properties;
    }

    /**
     * Maps child value object properties
     *
     * @return array
     */
    public function map(): array
    {
        $map = [];

        $reflectionObject = new ReflectionObject($this->valueObject());

        $properties = $this->makeAccessible($reflectionObject->getProperties());

        foreach ($properties as $property) {
            $map[$property->getName()] = $property->getValue($this->valueObject());
        }

        return $map;
    }
}
