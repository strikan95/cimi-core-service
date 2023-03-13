<?php

namespace App\Service;

use Symfony\Component\Serializer\NameConverter\CamelCaseToSnakeCaseNameConverter;
use Symfony\Component\Serializer\Encoder\JsonEncoder;
use Symfony\Component\Serializer\Normalizer\DateTimeNormalizer;
use Symfony\Component\Serializer\Normalizer\ObjectNormalizer;
use Symfony\Component\Serializer\Normalizer\UidNormalizer;
use Symfony\Component\Serializer\Serializer;
use Symfony\Component\Serializer\SerializerInterface;

class DTOSerializer implements SerializerInterface
{
    private const DATETIME_FORMAT = 'Y-m-d';

    private SerializerInterface $serializer;

    public function __construct()
    {
        $normalizers = [
            new DateTimeNormalizer(defaultContext: [DateTimeNormalizer::FORMAT_KEY => self::DATETIME_FORMAT]),
            new UidNormalizer(),
            new ObjectNormalizer(nameConverter: new CamelCaseToSnakeCaseNameConverter())
        ];

        $encoders = [new JsonEncoder()];

        $this->serializer = new Serializer($normalizers, $encoders);
    }

    public static function getDateTimeFormat(): string
    {
        return self::DATETIME_FORMAT;
    }

    public function serialize(mixed $data, string $format, array $context = []): string
    {
        return $this->serializer->serialize(
            $data,
            $format,
            $context
        );
    }

    public function deserialize(mixed $data, string $type, string $format, array $context = []): mixed
    {
        $dto = $this->serializer->deserialize(
            $data,
            $type,
            $format,
            $context
        );

        return $dto;
    }
}