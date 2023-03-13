<?php

namespace App\Attribute;

use Attribute;

#[Attribute]
class AttributeMap
{
    public $entity_attribute_name;

    public function __construct($entity_attribute_name)
    {
        $this->$entity_attribute_name = $entity_attribute_name;
    }
}