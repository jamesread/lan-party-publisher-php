<?php

namespace LanPartyPublisherPhp;

class Organisation extends ModelBase {
    public ?string $websiteUrl = null;

    public ?string $steamGroupUrl = null;

    public ?string $bannerImagePngUrl = null;

    public ?string $description = null;

    /** @var array<int, Venue> $venues */
    public array $venues = [];

    public function createVenue($name): Venue {
        $venue = new Venue($name);

        $this->addVenue($venue);

        return $venue;
    }

    public function addVenue(Venue $venue): void {
        $this->venues[] = $venue;
    }
}

