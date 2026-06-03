<?php

namespace LanPartyPublisherPhp;

use BackedEnum;
use DateTime;

class Ticket
{
    public function __construct(
        public string $name,
        public string $availability,
        public ?string $description = null,
        public ?string $priceCurrency = null,
        public float|int|null $price = null,
        public ?string $validFrom = null,
        public ?string $validThrough = null,
        public ?string $availabilityStarts = null,
        public ?string $availabilityEnds = null,
    ) {
    }

    /**
     * @param array<string, mixed> $opts
     */
    public static function make(string $name, array $opts = []): self
    {
        $availability = $opts['availability'] ?? null;

        if ($availability instanceof BackedEnum) {
            $availability = $availability->value;
        }

        if (! is_string($availability)) {
            throw new \InvalidArgumentException('Ticket availability is required');
        }

        $ticket = new self(
            name: $name,
            availability: $availability,
            description: $opts['description'] ?? null,
            priceCurrency: $opts['priceCurrency'] ?? null,
            price: $opts['price'] ?? null,
        );

        foreach (['validFrom', 'validThrough', 'availabilityStarts', 'availabilityEnds'] as $key) {
            if (! array_key_exists($key, $opts)) {
                continue;
            }

            $value = $opts[$key];

            if ($value instanceof DateTime) {
                $ticket->{$key} = ModelBase::formatDateTime($value);
            } else {
                $ticket->{$key} = $value;
            }
        }

        return $ticket;
    }
}
