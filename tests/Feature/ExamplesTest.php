<?php

use LanPartyPublisherPhp\Event;
use LanPartyPublisherPhp\Publisher;
use LanPartyPublisherPhp\Venue;

it('produces the desired result for example `Basic Single Venue and Event`', function () {
    $jsonOutput = Publisher::make()
        ->createOrganisation('Test Organisation')
        ->createVenue('Test Venue', [
            'gpsLatitude' => null,
            'gpsLongditude' => null,
        ])
        ->createEvent('Test Venue', 'Test Event', [
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
        ])
        ->toJson();

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

    expect(json_decode($jsonOutput, true))->toBe($expected);
});

it('produces the desired result for example `Multiple Events`', function () {
    $publisher = Publisher::make()
        ->createOrganisation('Test Organisation')
        ->createVenue('Test Venue', [
            'gpsLatitude' => null,
            'gpsLongditude' => null,
        ]);

    $events = [
        [
            'name' => 'Test Event 1',
            'opts' => [
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
            ],
        ],
        [
            'name' => 'Test Event 2',
            'opts' => [
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
            ],
        ]
    ];

    $events = array_map(function (array $value) {
        return Event::make($value['name'], $value['opts']);
    }, $events);

    $publisher->addEvents('Test Venue', $events);

    $jsonOutput = $publisher->toJson();

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
                            'name' => 'Test Event 1',
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
                        [
                            'name' => 'Test Event 2',
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

    expect(json_decode($jsonOutput, true))->toBe($expected);
});

it('produces the desired result for example `Multiple Venues with Events`', function () {
    $publisher = Publisher::make()
        ->createOrganisation('Test Organisation');

    $venues = [
        [
            'name' => 'Test Venue 1',
            'opts' => [
                'gpsLatitude' => null,
                'gpsLongditude' => null,
            ],
            'events' => [
                [
                    'name' => 'Test Event 1',
                    'opts' => [
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
                    ],
                ],
            ],
        ],
        [
            'name' => 'Test Venue 2',
            'opts' => [
                'gpsLatitude' => null,
                'gpsLongditude' => null,
            ],
            'events' => [
                [
                    'name' => 'Test Event 2',
                    'opts' => [
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
                    ],
                ],
            ],
        ],
    ];

    $events = [];

    $venues = array_map(function (array $value) use (&$events) {
        $venue = Venue::make($value['name'], $value['opts']);

        $events[$value['name']] = array_map(function (array $value) {
            return Event::make($value['name'], $value['opts']);
        }, $value['events']);

        return $venue;
    }, $venues);

    $publisher->addVenues($venues);

    foreach ($events as $venue => $events) {
        $publisher->addEvents($venue, $events);
    }

    $jsonOutput = $publisher->toJson();

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
                    'name' => 'Test Venue 1',
                    'apiType' => 'Venue',
                    'apiVersion' => 1,
                    'siteUniqueId' => null,
                    'gpsLatitude' => null,
                    'gpsLongditude' => null,
                    'events' => [
                        [
                            'name' => 'Test Event 1',
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
                [
                    'name' => 'Test Venue 2',
                    'apiType' => 'Venue',
                    'apiVersion' => 1,
                    'siteUniqueId' => null,
                    'gpsLatitude' => null,
                    'gpsLongditude' => null,
                    'events' => [
                        [
                            'name' => 'Test Event 2',
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

    expect(json_decode($jsonOutput, true))->toBe($expected);
});
