<?php

namespace LanPartyPublisherPhp;

class Organisation extends ModelBase
{
    public ?string $websiteUrl = null;

    public ?string $steamGroupUrl = null;

    public ?string $discordInviteUrl = null;

    public ?string $image = null;

    public ?string $description = null;

    /** @var array<int, Venue> */
    public array $venues = [];

    /**
     * @param array<string, mixed> $opts
     */
    public function createVenue(string $name, array $opts = []): Venue
    {
        $venue = new Venue($name);

        if (!empty($opts)) {
            self::applyOptions($venue, $opts);
        }

        $this->addVenue($venue);

        return $venue;
    }

    public function addVenue(Venue $venue): void
    {
        $this->venues[] = $venue;
    }

    public function getVenue(int|string $venue): ?Venue
    {
        if (is_int($venue) && array_key_exists($venue, $this->venues)) {
            return $this->venues[$venue];
        }

        $keyName = array_search($venue, array_column($this->venues, 'name'), true);

        if (array_key_exists($keyName, $this->venues)) {
            return $this->venues[$keyName];
        }

        return null;
    }
}
