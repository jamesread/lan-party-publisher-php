<?php

namespace LanPartyPublisherPhp;

use DateTime;
use LanPartyPublisherPhp\Enums\SleepingEnum;

class Event extends ModelBase
{
    public string|null $start = null;

    public string|null $finish = null;

    public int|null $seatsTotal = null;

    public int|null $seatsAvailable = null;

    public string $ticketsOnSale;

    public string $ticketCurrencyIso4217;

    public float|int|null $ticketPriceInAdvance = null;

    public float|int|null $ticketPriceOnDoor = null;

    public bool $isTicketsOnSale = false;

    public int $sleeping;

    public bool $hasShowers = false;

    public bool $isAlcoholAllowed = false;

    public bool $hasSmokingArea = false;

    public int $networkConnectionMbps;

    public int $internetConnectionMbps;

    public string $description;

    /** @var array<int, Attendee> */
    public array $attendees = [];

    public function __construct()
    {
        $this->sleeping = SleepingEnum::NOT_ARRANGED->value;
    }

    public function setStart(DateTime $start): void
    {
        $this->start = $start->format('Y-m-d H:i:s');
    }

    public function setFinish(DateTime $finish): void
    {
        $this->finish = $finish->format('Y-m-d H:i:s');
    }

    public function addAttendee(Attendee $attendee): void
    {
        $this->attendees[] = $attendee;
    }
}
