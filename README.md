# lan-party-publisher-php

This package enables the creation of the LAN party publishing standard, making it easy to pull your own list of events and publish those to the world in a standard format that can be consumed by other sites (like [LANList](http://lanlist.info/)).

## Using the PHP Library

```shell
composer require jamesread/lan-party-publisher-php
```

## Example Usage

Single Venue and Event example:

```php
<?php

use DateTime;
use LanPartyPublisherPhp\Publisher;

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

header("Content-Type: application/json"); 

echo $jsonOutput;
```

Single Venue with multiple Events example:

```php
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

```

Multiple Venues with Events example:

```php
use DateTime;
use LanPartyPublisherPhp\Event;
use LanPartyPublisherPhp\Publisher;
use LanPartyPublisherPhp\Venue;

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

    header("Content-Type: application/json"); 

    echo $publisher->toJson();
```
