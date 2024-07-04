<?php

namespace LanPartyPublisherPhp;

class Organisation extends ModelBase {
    public $websiteUrl;
    public $steamGroupUrl;
    public $bannerImagePngUrl;
    public $description;

    public $venues;

    public function addVenue(Venue $venue) {
        $this->venues[] = $venue;
    }

    public function createVenue($name) {
        $venue = new Venue($name);

        $this->addVenue($venue);

        return $venue;
    }
}

