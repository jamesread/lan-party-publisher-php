<?php

namespace LanPartyPublisherPhp;

use DateTime;
use Exception;

class Venue extends ModelBase
{
    public float|null $gpsLatitude = null;

    public float|null $gpsLongditude = null;

    /** @var array<int, Event> */
    public array $events = [];

    public static function make(?string $name, array $opts = []): Venue
    {
        $venue = new Venue($name);

        if (count($opts) > 0) {
            foreach ($opts as $key => $value) {
                if (property_exists($venue, $key)) {
                    $venue->{$key} = $value;
                }
            }
        }

        return $venue;
    }

    public function createEvent(string $name, array $opts = []): Event
    {
        $event = new Event($name);

        if (count($opts) > 0) {
            foreach ($opts as $key => $value) {
                if (property_exists($event, $key)) {

                    if ($key === 'start' || $key === 'finish') {
                        if (! $value instanceof DateTime) {
                            throw new Exception('`start` and `finish` must be an instance of DateTime');
                        }

                        $event->{$key} = $value->format('Y-m-d H:i:s');
                    } else {
                        $event->{$key} = $value;
                    }
                }
            }
        }

        $this->addEvent($event);

        return $event;
    }

    public function addEvent(Event $event)
    {
        $this->events[] = $event;
    }
}
