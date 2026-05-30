<?php

namespace LanPartyPublisherPhp;

use Composer\InstalledVersions;
use Exception;

class Publisher
{
    public const SCHEMA_URL = 'https://raw.githubusercontent.com/jamesread/lan-party-publishing-standard/main/lan-party-publishing-standard-v2.schema';

    private ?Organisation $organizer = null;

    public static function make(): self
    {
        return new self();
    }

    public function createOrganisation(string $name, array $opts = []): self
    {
        $this->organizer = new Organisation($name);

        if (count($opts) > 0) {
            ModelBase::applyOptions($this->organizer, $opts);
        }

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
            '$schema' => self::SCHEMA_URL,
            'generator' => $generator,
            'organisation' => $this->organizer,
        ];
    }

    public function toJson(): string
    {
        $data = json_decode(json_encode($this->toArray()), true);

        return json_encode(self::omitNulls($data), JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES);
    }

    public static function omitNulls(array $data): array
    {
        $result = [];

        foreach ($data as $key => $value) {
            if ($value === null) {
                continue;
            }

            if (is_array($value)) {
                $result[$key] = self::omitNulls($value);
            } else {
                $result[$key] = $value;
            }
        }

        return $result;
    }
}
