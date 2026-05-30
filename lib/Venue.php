<?php

namespace LanPartyPublisherPhp;

class Venue extends ModelBase
{
    public float|null $gpsLatitude = null;

    public float|null $gpsLongitude = null;

    public ?string $countryCode = null;

    /** @var array<int, Event> */
    public array $events = [];

    public static function make(?string $name, array $opts = []): Venue
    {
        $venue = new Venue($name);

        if (count($opts) > 0) {
            self::applyOptions($venue, $opts);
        }

        return $venue;
    }

    public function createEvent(string $name, array $opts = []): Event
    {
        $event = new Event($name);

        if (count($opts) > 0) {
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
