<?php

namespace LaravelBundle\Auth\Shared\Domain\ValueObject;

use Illuminate\Contracts\Support\Arrayable;
use Illuminate\Support\Str;

/**
 * Class ValueObject
 *
 * @package LaravelBundle\Auth\Shared\Domain\ValueObject
 */
abstract class ValueObject implements Arrayable
{
    /**
     * Checks if objects are the same.
     *
     * @param ValueObject $other
     * @return bool
     */
    public function equals(ValueObject $other): bool
    {
        $reflectionObject = new ReflectionValueObject($this);

        return $reflectionObject->hasSameValues($other);
    }

    /**
     * Convert to array.
     *
     * @return array
     */
    public function toArray(): array
    {
        $converted = [];

        $reflectionObject = new ReflectionValueObject($this);

        $map = $reflectionObject->map();

        foreach (array_keys($map) as $key) {
            $converted[Str::snake($key)] = $map[$key];
        }

        return $converted;
    }
}
