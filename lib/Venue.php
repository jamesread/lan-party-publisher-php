<?php

declare(strict_types=1);

namespace LanPartyPublisherPhp;

class Venue extends ModelBase
{
    public float|null $gpsLatitude = null;

    public float|null $gpsLongitude = null;

    public ?string $countryCode = null;

    /** @var array<int, Event> */
    public array $events = [];

    /**
     * @param array<string, mixed> $opts
     */
    public static function make(?string $name, array $opts = []): Venue
    {
        $venue = new Venue($name);

        if ($opts !== []) {
            self::applyOptions($venue, $opts);
        }

        return $venue;
    }

    /**
     * @param array<string, mixed> $opts
     */
    public function createEvent(string $name, array $opts = []): Event
    {
        $event = new Event($name);

        if ($opts !== []) {
            self::applyOptions($event, $opts);
        }

        $this->addEvent($event);

        return $event;
    }

    public function addEvent(Event $event): void
    {
        $this->events[] = $event;
    }
}
