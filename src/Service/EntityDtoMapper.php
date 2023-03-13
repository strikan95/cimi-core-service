<?php

namespace App\Service;

use App\Annotation\DataMapper;
use App\Attribute\AttributeMap;
use Doctrine\Common\Annotations\AnnotationReader;
use ReflectionClass;
use ReflectionException;
use ReflectionProperty;
use Symfony\Component\PropertyAccess\PropertyAccessor;

class EntityDtoMapper
{

    /**
     * @throws ReflectionException
     */
    public static function map_test(object $source, string $targetClass)
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
            /*            $propValue = $propertyAccessor->getValue(
                            $source,
                            $propertyAnnotation->entity_field
                        );

                        $propertyAccessor->setValue(
                            $target,
                            $property->getName(),
                            $propValue
                        );*/
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
            $propertyAttributes = $property->getAttributes(AttributeMap::class);

            // Only one attribute should be but take last one
            $attributeArguments = end($propertyAttributes)
                ->getArguments();

            // Only one argument, take first
            $attributes[$property->getName()] = reset($attributeArguments);
        }

        return $attributes;
    }

    public static function map(object $source, string $targetClass)
    {
        $target = new $targetClass();
        $reader = new AnnotationReader();
        $propertyAccessor = new PropertyAccessor();

        $properties = self::getProperties($target);

        foreach ($properties as $key => $property)
        {
            $propertyAnnotation = $reader->getPropertyAnnotation(
                $property,
                DataMapper::class
            );

            $propValue = $propertyAccessor->getValue(
                $source,
                $propertyAnnotation->entity_field
            );

            $propertyAccessor->setValue(
                $target,
                $property->getName(),
                $propValue
            );
        }

        return $target;
    }

    private static function getProperties(object $object): array
    {
        $reflect = new ReflectionClass($object);
        return $reflect->getProperties(
            ReflectionProperty::IS_PUBLIC |
            ReflectionProperty::IS_PROTECTED |
            ReflectionProperty::IS_PRIVATE
        );
    }
}