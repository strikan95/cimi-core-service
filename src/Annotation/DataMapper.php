<?php

namespace App\Annotation;

use Doctrine\Common\Annotations\Annotation;

/**
 * @Annotation
 * @Annotation\Target({"PROPERTY"})
 */
class DataMapper
{
    public $entity_field;
}