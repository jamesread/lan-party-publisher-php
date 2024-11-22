<?php

namespace LanPartyPublisherPhp;

use Composer\InstalledVersions;

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

    public function getOrganisation(): Organisation
    {
        return $this->organizer;
    }

    public function toJson(): string
    {
        $generator = 'lan-party-publisher-php ' . InstalledVersions::getVersion('jamesread/lan-party-publisher-php');

        $data = [
            '$schema' => 'https://raw.githubusercontent.com/jamesread/lan-party-publishing-api/master/schema.json',
            'generator' => $generator,
            'organisation' => $this->organizer,
        ];

        return json_encode($data, JSON_PRETTY_PRINT);
    }
}
