<?php

use DateTime;
use LanPartyPublisherPhp\Event;
use LanPartyPublisherPhp\Publisher;

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

header("Content-Type: application/json");

echo $publisher->toJson();
