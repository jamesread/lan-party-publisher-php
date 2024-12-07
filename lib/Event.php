<?php

namespace LanPartyPublisherPhp;

use DateTime;
use Exception;
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

    public function __construct(
        string|null $name = null,
        string $apiType = '?',
        int $apiVersion = 1,
        string|int|null $siteUniqueId = null,
    ) {
        parent::__construct(
            $name,
            $apiType,
            $apiVersion,
            $siteUniqueId,
        );

        $this->sleeping = SleepingEnum::NOT_ARRANGED->value;
    }

    public static function make(?string $name = null, array $opts = []): self
    {
        $event = new self($name);

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

        return $event;
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
