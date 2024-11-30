<?php

namespace LanPartyPublisherPhp;

class Publisher
{
    private ?Organisation $organizer;

    public function outputJson(?Organisation $organisation = null)
    {
        if ($organisation == null) {
            $organisation = $this->organizer;
        }

        $generator = 'lan-party-publisher-php ' . \Composer\InstalledVersions::getVersion('jamesread/lan-party-publisher-php');

        $root = array();
        $root['$schema'] = 'https://raw.githubusercontent.com/jamesread/lan-party-publishing-api/master/schema.json';
        $root['generator'] = $generator;
        $root['organisation'] = $organisation;

        header("Content-Type: application/json");
        echo json_encode($root, JSON_PRETTY_PRINT);
        exit;
    }

    public function createOrganisation($name)
    {
        $this->organizer = new Organisation($name);

        return $this->organizer;
    }
}
