<?php

namespace LanPartyPublisherPhp;

use DateTime;
use LanPartyPublisherPhp\Enums\SleepingEnum;

class Event extends ModelBase
{
    public DateTime|null $start = null;

    public DateTime|null $finish = null;

    public int|null $seatsTotal = null;

    public int|null $seatsAvailable = null;

    public string $ticketsOnSale; // Deprecated in favour of isTicketsOnSale

    public string $ticketCurrencyIso4217;

    public float|int|null $ticketPriceInAdvance = null;

    public float|int|null $ticketPriceOnDoor = null;

    public bool $isTicketsOnSale = false;

    public int $sleeping = SleepingEnum::NOT_ARRANGED->value;

    public bool $hasShowers = false;

    public bool $isAlcoholAllowed = false;

    public bool $hasSmokingArea = false;

    public int $networkConnectionMbps;

    public int $internetConnectionMbps;

    public string $description;

    /** @var array<int, Attendee> */
    public array $attendees = [];

    public function setStart(DateTime $start): void
    {
        $this->start = $start;
    }

    public function setFinish(DateTime $finish): void
    {
        $this->finish = $finish;
    }

    public function addAttendee(Attendee $attendee): void
    {
        $this->attendees[] = $attendee;
    }
}
