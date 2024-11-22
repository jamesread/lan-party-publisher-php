<?php

namespace LanPartyPublisherPhp;

class Venue extends ModelBase
{
    public $gpsLatitude;

    public $gpsLongditude;

    /** @var array<int, Event> */
    public array $events;

    public function createEvent(string $name): Event
    {
        $event = new Event($name);

        $this->addEvent($event);

        return $event;
    }

    public function addEvent(Event $event)
    {
        $this->events[] = $event;
    }
}
