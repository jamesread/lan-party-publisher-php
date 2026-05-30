<?php

namespace LanPartyPublisherPhp;

use DateTime;
use LanPartyPublisherPhp\Enums\SleepingEnum;

class Event extends ModelBase
{
    public ?string $url = null;

    public ?string $eventStatus = null;

    public int $eventAttendanceMode = 0;

    public ?string $startDate = null;

    public ?string $endDate = null;

    public ?string $previousStartDate = null;

    public ?int $maximumAttendeeCapacity = null;

    public ?int $remainingAttendeeCapacity = null;

    /** @var array<int, Ticket> */
    public array $tickets = [];

    public int $sleeping = 0;

    public bool $hasShowers = false;

    public int $alcoholPolicy = 0;

    public int $smokingPolicy = 0;

    public int $agePolicy = 0;

    public int $foodPolicy = 0;

    public int $networkConnectionMbps = 0;

    public int $internetConnectionMbps = 0;

    public int $wifiConnectionMbps = 0;

    public ?string $description = null;

    public function __construct(
        string|null $name = null,
        string $apiType = '?',
        int $apiVersion = 2,
        string|int $publisherUniqueId = '',
    ) {
        parent::__construct(
            $name,
            $apiType,
            $apiVersion,
            $publisherUniqueId,
        );

        $this->sleeping = SleepingEnum::NOT_ARRANGED->value;
    }

    public static function make(?string $name = null, array $opts = []): self
    {
        $event = new self($name);

        if (count($opts) > 0) {
            self::applyOptions($event, $opts);
        }

        return $event;
    }

    public function setStartDate(DateTime $startDate): void
    {
        $this->startDate = self::formatDateTime($startDate);
    }

    public function setEndDate(DateTime $endDate): void
    {
        $this->endDate = self::formatDateTime($endDate);
    }

    public function addTicket(Ticket $ticket): void
    {
        $this->tickets[] = $ticket;
    }
}
