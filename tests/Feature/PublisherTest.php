<?php

use LanPartyPublisherPhp\Publisher;
use LanPartyPublisherPhp\Venue;

describe('JSON Output', function () {
    it('correctly outputs the `Organisation`', function () {
        $publisher = Publisher::make()
            ->createOrganisation('Test Organisation');

        $json = $publisher->toJson();

        $expected = [
            ...createSchemaStructure(),
            'organisation' => [
                'name' => 'Test Organisation',
                'apiType' => 'Organisation',
                'apiVersion' => 1,
                'siteUniqueId' => null,
                'websiteUrl' => null,
                'steamGroupUrl' => null,
                'bannerImagePngUrl' => null,
                'description' => null,
                'venues' => [],
            ],
        ];

        expect(json_decode($json, true))->toBe($expected);
    });

    it('correctly outputs the `Organisation` and `Venue`', function () {
        $publisher = Publisher::make()
            ->createOrganisation('Test Organisation');

        $organisation = $publisher->getOrganisation();

        $venue = $organisation->createVenue('Test Venue');

        $json = $publisher->toJson();

        $expected = [
            ...createSchemaStructure(),
            'organisation' => [
                'name' => 'Test Organisation',
                'apiType' => 'Organisation',
                'apiVersion' => 1,
                'siteUniqueId' => null,
                'websiteUrl' => null,
                'steamGroupUrl' => null,
                'bannerImagePngUrl' => null,
                'description' => null,
                'venues' => [
                    (array) $venue,
                ],
            ],
        ];

        expect(json_decode($json, true))->toBe($expected);
    });

    it('correctly outputs with the `Organisation`, `Venue` and `Event`', function () {
        $publisher = Publisher::make()
            ->createOrganisation('Test Organisation');

        $organisation = $publisher->getOrganisation();

        $venue = $organisation->createVenue('Test Venue');

        $event = $venue->createEvent('Test Event');

        $json = $publisher->toJson();

        $expected = [
            ...createSchemaStructure(),
            'organisation' => [
                'name' => 'Test Organisation',
                'apiType' => 'Organisation',
                'apiVersion' => 1,
                'siteUniqueId' => null,
                'websiteUrl' => null,
                'steamGroupUrl' => null,
                'bannerImagePngUrl' => null,
                'description' => null,
                'venues' => [
                [...(array)$venue, 'events' => [(array) $event]],
                ],
            ],
        ];

        expect(json_decode($json, true))->toBe($expected);
    });

    it('correctly outputs `multiple venues`', function () {
        $publisher = Publisher::make()
            ->createOrganisation('Test Organisation');

        $organisation = $publisher->getOrganisation();

        $venues = [];

        for ($i = 0; $i < 3; $i++) {
            $venue = new Venue('Test Venue ' . $i);

            $venue->createEvent('Test Event ' . $i);

            $venues[] = $venue;

            $organisation->addVenue($venue);
        }

        $json = $publisher->toJson();

        $expected = [
            ...createSchemaStructure(),
            'organisation' => [
                'name' => 'Test Organisation',
                'apiType' => 'Organisation',
                'apiVersion' => 1,
                'siteUniqueId' => null,
                'websiteUrl' => null,
                'steamGroupUrl' => null,
                'bannerImagePngUrl' => null,
                'description' => null,
                'venues' => array_map(fn ($venue) => [...(array) $venue, 'events' => array_map(fn ($event) => (array) $event, $venue->events)], $venues),
            ],
        ];

        expect(json_decode($json, true))->toBe($expected);
    });

    it('correctly outputs `multiple events`', function () {
        $publisher = Publisher::make()
            ->createOrganisation('Test Organisation');

        $organisation = $publisher->getOrganisation();

        $venue = $organisation->createVenue('Test Venue');

        $events = [];

        for ($i = 0; $i < 3; $i++) {
            $event = $venue->createEvent('Test Event ' . $i);

            $events[] = $event;
        }

        $json = $publisher->toJson();

        $expected = [
            ...createSchemaStructure(),
            'organisation' => [
                'name' => 'Test Organisation',
                'apiType' => 'Organisation',
                'apiVersion' => 1,
                'siteUniqueId' => null,
                'websiteUrl' => null,
                'steamGroupUrl' => null,
                'bannerImagePngUrl' => null,
                'description' => null,
                'venues' => [
                    [...(array) $venue, 'events' => array_map(fn ($event) => (array) $event, $events)],
                ],
            ],
        ];

        expect(json_decode($json, true))->toBe($expected);
    });

    it('correctly outputs a `venue` with custom properties', function () {
        $publisher = Publisher::make()
            ->createOrganisation('Test Organisation');

        $organisation = $publisher->getOrganisation();

        $organisation->createVenue('Test Venue', [
            'gpsLatitude' => 51.5072,
            'gpsLongditude' => 0.1276,
        ]);

        $json = $publisher->toJson();

        $expected = [
            ...createSchemaStructure(),
            'organisation' => [
                'name' => 'Test Organisation',
                'apiType' => 'Organisation',
                'apiVersion' => 1,
                'siteUniqueId' => null,
                'websiteUrl' => null,
                'steamGroupUrl' => null,
                'bannerImagePngUrl' => null,
                'description' => null,
                'venues' => [
                    [
                        'name' => 'Test Venue',
                        'apiType' => 'Venue',
                        'apiVersion' => 1,
                        'siteUniqueId' => null,
                        'gpsLatitude' => 51.5072,
                        'gpsLongditude' => 0.1276,
                        'events' => [],
                    ],
                ],
            ],
        ];

        expect(json_decode($json, true))->toBe($expected);
    });

    it('correctly outputs a `event` with custom properties', function () {
        $publisher = Publisher::make()
            ->createOrganisation('Test Organisation');

        $organisation = $publisher->getOrganisation();

        $venue = $organisation->createVenue('Test Venue');

        $venue->createEvent('Test Event', [
            'start' => DateTime::createFromFormat('Y-m-d H:i:s', '2021-01-01 00:00:00'),
            'finish' => DateTime::createFromFormat('Y-m-d H:i:s', '2021-01-02 00:00:00'),
            'seatsTotal' => 100,
            'seatsAvailable' => 50,
            'ticketsOnSale' => 'Yes',
            'ticketCurrencyIso4217' => 'GBP',
            'ticketPriceInAdvance' => 10.99,
            'ticketPriceOnDoor' => 15.99,
            'isTicketsOnSale' => true,
            'sleeping' => 1,
            'hasShowers' => true,
            'isAlcoholAllowed' => true,
            'hasSmokingArea' => true,
            'networkConnectionMbps' => 1000,
            'internetConnectionMbps' => 1000,
            'description' => 'Test Description',
        ]);

        $json = $publisher->toJson();

        $expected = [
            ...createSchemaStructure(),
            'organisation' => [
                'name' => 'Test Organisation',
                'apiType' => 'Organisation',
                'apiVersion' => 1,
                'siteUniqueId' => null,
                'websiteUrl' => null,
                'steamGroupUrl' => null,
                'bannerImagePngUrl' => null,
                'description' => null,
                'venues' => [
                    [
                        'name' => 'Test Venue',
                        'apiType' => 'Venue',
                        'apiVersion' => 1,
                        'siteUniqueId' => null,
                        'gpsLatitude' => null,
                        'gpsLongditude' => null,
                        'events' => [
                            [
                                'name' => 'Test Event',
                                'apiType' => 'Event',
                                'apiVersion' => 1,
                                'siteUniqueId' => null,
                                'start' => '2021-01-01 00:00:00',
                                'finish' => '2021-01-02 00:00:00',
                                'seatsTotal' => 100,
                                'seatsAvailable' => 50,
                                'ticketsOnSale' => 'Yes',
                                'ticketCurrencyIso4217' => 'GBP',
                                'ticketPriceInAdvance' => 10.99,
                                'ticketPriceOnDoor' => 15.99,
                                'isTicketsOnSale' => true,
                                'sleeping' => 1,
                                'hasShowers' => true,
                                'isAlcoholAllowed' => true,
                                'hasSmokingArea' => true,
                                'networkConnectionMbps' => 1000,
                                'internetConnectionMbps' => 1000,
                                'description' => 'Test Description',
                                'attendees' => [],
                            ],
                        ],
                    ],
                ],
            ],
        ];

        expect(json_decode($json, true))->toBe($expected);
    });
});

describe('Array Output', function () {
    it('correctly outputs the `Organisation`', function () {
        $publisher = Publisher::make()
            ->createOrganisation('Test Organisation');

        $array = $publisher->toArray();

        $expected = [
            ...createSchemaStructure(),
            'organisation' => $publisher->getOrganisation(),
        ];

        expect($array)->toBe($expected);
    });

    it('correctly outputs the `Organisation` and `Venue`', function () {
        $publisher = Publisher::make()
            ->createOrganisation('Test Organisation');

        $organisation = $publisher->getOrganisation();

        $venue = $organisation->createVenue('Test Venue');

        $array = $publisher->toArray();

        $expected = [
            ...createSchemaStructure(),
            'organisation' => $publisher->getOrganisation(),
        ];

        expect($array)->toBe($expected);
    });

    it('correctly outputs with the `Organisation`, `Venue` and `Event`', function () {
        $publisher = Publisher::make()
            ->createOrganisation('Test Organisation');

        $organisation = $publisher->getOrganisation();

        $venue = $organisation->createVenue('Test Venue');

        $event = $venue->createEvent('Test Event');

        $array = $publisher->toArray();

        $expected = [
            ...createSchemaStructure(),
            'organisation' => $publisher->getOrganisation(),
        ];

        expect($array)->toBe($expected);
    });

    it('correctly outputs `multiple venues`', function () {
        $publisher = Publisher::make()
            ->createOrganisation('Test Organisation');

        $organisation = $publisher->getOrganisation();

        $venues = [];

        for ($i = 0; $i < 3; $i++) {
            $venue = new Venue('Test Venue ' . $i);

            $venue->createEvent('Test Event ' . $i);

            $venues[] = $venue;

            $organisation->addVenue($venue);
        }

        $array = $publisher->toArray();

        $expected = [
            ...createSchemaStructure(),
            'organisation' => $publisher->getOrganisation(),
        ];

        expect($array)->toBe($expected);
    });

    it('correctly outputs `multiple events`', function () {
        $publisher = Publisher::make()
            ->createOrganisation('Test Organisation');

        $organisation = $publisher->getOrganisation();

        $venue = $organisation->createVenue('Test Venue');

        $events = [];

        for ($i = 0; $i < 3; $i++) {
            $event = $venue->createEvent('Test Event ' . $i);

            $events[] = $event;
        }

        $array = $publisher->toArray();

        $expected = [
            ...createSchemaStructure(),
            'organisation' => $publisher->getOrganisation(),
        ];

        expect($array)->toBe($expected);
    });

    it('correctly outputs a `venue` with custom properties', function () {
        $publisher = Publisher::make()
            ->createOrganisation('Test Organisation');

        $organisation = $publisher->getOrganisation();

        $organisation->createVenue('Test Venue', [
            'gpsLatitude' => 51.5072,
            'gpsLongditude' => 0.1276,
        ]);

        $array = $publisher->toArray();

        $expected = [
            ...createSchemaStructure(),
            'organisation' => $publisher->getOrganisation(),
        ];

        expect($array)->toBe($expected);
    });

    it('correctly outputs a `event` with custom properties', function () {
        $publisher = Publisher::make()
            ->createOrganisation('Test Organisation');

        $organisation = $publisher->getOrganisation();

        $venue = $organisation->createVenue('Test Venue');

        $venue->createEvent('Test Event', [
            'start' => DateTime::createFromFormat('Y-m-d H:i:s', '2021-01-01 00:00:00'),
            'finish' => DateTime::createFromFormat('Y-m-d H:i:s', '2021-01-02 00:00:00'),
            'seatsTotal' => 100,
            'seatsAvailable' => 50,
            'ticketsOnSale' => 'Yes',
            'ticketCurrencyIso4217' => 'GBP',
            'ticketPriceInAdvance' => 10.99,
            'ticketPriceOnDoor' => 15.99,
            'isTicketsOnSale' => true,
            'sleeping' => 1,
            'hasShowers' => true,
            'isAlcoholAllowed' => true,
            'hasSmokingArea' => true,
            'networkConnectionMbps' => 1000,
            'internetConnectionMbps' => 1000,
            'description' => 'Test Description',
        ]);

        $array = $publisher->toArray();

        $expected = [
            ...createSchemaStructure(),
            'organisation' => $publisher->getOrganisation(),
        ];

        expect($array)->toBe($expected);
    });
});
