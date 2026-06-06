<?php

namespace LanPartyPublisherPhp;

use BackedEnum;
use DateTime;
use ReflectionClass;

class ModelBase
{
    private const DATE_TIME_PROPERTIES = [
        'startDate',
        'endDate',
        'previousStartDate',
        'validFrom',
        'validThrough',
        'availabilityStarts',
        'availabilityEnds',
    ];

    public function __construct(
        public string|null $name = null,
        public string $apiType = '?',
        public int $apiVersion = 2,
        public string|int $publisherUniqueId = '',
    ) {
        $this->apiType = (new ReflectionClass($this))->getShortName();

        if ($this->publisherUniqueId === '' && $name !== null && $name !== '') {
            $this->publisherUniqueId = self::publisherUniqueIdFromName($name);
        }
    }

    public static function publisherUniqueIdFromName(string $name): string
    {
        $slug = strtolower(trim(preg_replace('/[^a-z0-9]+/i', '-', $name) ?? '', '-'));

        return $slug !== '' ? $slug : 'unknown';
    }

    public static function formatDateTime(DateTime $dateTime): string
    {
        return $dateTime->format('Y-m-d\TH:i:s');
    }

    /**
     * @param array<string, mixed> $opts
     */
    public static function applyOptions(object $target, array $opts): void
    {
        foreach ($opts as $key => $value) {
            if (! property_exists($target, $key)) {
                continue;
            }

            if (in_array($key, self::DATE_TIME_PROPERTIES, true)) {
                if ($value instanceof DateTime) {
                    $target->{$key} = self::formatDateTime($value);
                } else {
                    $target->{$key} = $value;
                }

                continue;
            }

            if ($value instanceof BackedEnum) {
                $target->{$key} = $value->value;

                continue;
            }

            $target->{$key} = $value;
        }
    }
}
