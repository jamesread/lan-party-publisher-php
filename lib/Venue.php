<?php

namespace LanPartyPublisherPhp;

class Venue extends ModelBase
{
    public $name;
    public $gpsLatitude;
    public $gpsLongditude;

    public $events;

    public function addEvent(Event $event)
    {
        $this->events[] = $event;
    }

    public function createEvent($name)
    {
        $event = new Event($name);

        $this->addEvent($event);

        return $event;
    }
}
