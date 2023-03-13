<?php

namespace App\Attribute;

use Attribute;

#[Attribute]
class EntityPropertyMap
{
    public string $property_name;

    public function __construct($property_name)
    {
        $this->property_name = $property_name;
    }
}