<?php

namespace LanPartyPublisherPhp;

use Composer\InstalledVersions;
use Exception;

class Publisher
{
    private ?Organisation $organizer = null;

    public static function make(): self
    {
        return new self();
    }

    public function createOrganisation(string $name): self
    {
        $this->organizer = new Organisation($name);

        return $this;
    }

    public function createVenue(string $name, array $opts = []): self
    {
        $this->organizer->createVenue($name, $opts);

        return $this;
    }

    public function addVenues(array $venues): self
    {
        foreach ($venues as $venue) {
            $this->organizer->addVenue($venue);
        }

        return $this;
    }

    public function createEvent(int|string $venue, string $name, array $opts = []): self
    {
        $venue = $this->organizer->getVenue($venue);

        if (is_null($venue)) {
            throw new Exception('Venue not found');
        }

        $venue->createEvent($name, $opts);

        return $this;
    }

    public function addEvents(int|string $venue, array $events): self
    {
        $venue = $this->organizer->getVenue($venue);

        if (is_null($venue)) {
            throw new Exception('Venue not found');
        }

        foreach ($events as $event) {
            $venue->addEvent($event);
        }

        return $this;
    }

    public function getOrganisation(): Organisation
    {
        return $this->organizer;
    }

    public function toArray(): array
    {
        $generator = 'lan-party-publisher-php ' . InstalledVersions::getVersion('jamesread/lan-party-publisher-php');

        return [
            '$schema' => 'https://raw.githubusercontent.com/jamesread/lan-party-publishing-api/master/schema.json',
            'generator' => $generator,
            'organisation' => $this->organizer,
        ];
    }

    public function toJson(): string
    {
        return json_encode($this->toArray(), JSON_PRETTY_PRINT);
    }
}
