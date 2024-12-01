<?php

namespace LanPartyPublisherPhp;

class Organisation extends ModelBase
{
    public ?string $websiteUrl = null;

    public ?string $steamGroupUrl = null;

    public ?string $bannerImagePngUrl = null;

    public ?string $description = null;

    /** @var array<int, Venue> */
    public array $venues = [];

    public function createVenue($name, array $opts = []): Venue
    {
        $venue = new Venue($name);

        if (count($opts) > 0) {
            foreach ($opts as $key => $value) {
                if (property_exists($venue, $key)) {
                    $venue->{$key} = $value;
                }
            }
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

        $keyName = array_search($venue, array_column($this->venues, 'name'));

        if (array_key_exists($keyName, $this->venues)) {
            return $this->venues[$keyName];
        }

        return null;
    }
}
