<?php

namespace App\Service;

use App\Attribute\EntityPropertyMap;
use ReflectionClass;
use ReflectionException;
use Symfony\Component\PropertyAccess\PropertyAccessor;

class EntityDtoMapper
{
    /**
     * @throws ReflectionException
     */
    public static function map(object $source, string $targetClass)
    {
        $target = new $targetClass();
        $attributes = self::getAttributes($targetClass);
        $propertyAccessor = new PropertyAccessor();

        foreach ($attributes as $key => $attribute)
        {
            $sourcePropValue = $propertyAccessor->getValue(
                $source,
                $attribute
            );

            $propertyAccessor->setValue(
                $target,
                $attribute,
                $sourcePropValue
            );
        }

        return $target;
    }

    /**
     * @throws ReflectionException
     */
    private static function getAttributes(string $targetClass) : array
    {
        $reflection = new ReflectionClass($targetClass);
        $properties = $reflection->getProperties();
        $attributes = [];

        foreach ($properties as $property)
        {
            $propertyAttributes = $property->getAttributes(EntityPropertyMap::class);

            // Only one attribute should be but take last one
            $attributeArguments = end($propertyAttributes)
                ->getArguments();

            // Only one argument, take first
            $attributes[$property->getName()] = reset($attributeArguments);
        }

        return $attributes;
    }
}