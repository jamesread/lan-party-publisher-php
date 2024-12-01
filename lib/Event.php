<?php

namespace LanPartyPublisherPhp;

class Event extends ModelBase
{
    public $start;
    public $finish;
    public $seatsTotal;
    public $seatsAvailable;
    public $ticketsOnSale;
    public $ticketCurrencyIso4217;
    public $ticketPriceInAdvance;
    public $ticketPriceOnDoor;
    public $isTicketsOnSale = false;
    public $hasShowers;
    public $sleeping = 0; // NOT_ARRANGED. NOT_OVERNIGHT. PRIVATE_ROOMS. SHARED_ROOM. SHARED_ROOM_AND_CAMPING.
    public $isAlcoholAllowed = 0;
    public $hasSmokingArea = 0;
    public $networkConnectionMbps;
    public $internetConnectionMbps;
    public $description;

    public $attendees;

    public function setStart(\DateTime $start)
    {
        $this->start = $start;
    }

    public function setFinish(\DateTime $finish)
    {
        $this->finish = $finish;
    }

    public function addAttendee(Attendee $attendee)
    {
        $this->attendees[] = $attendee;
    }
}
