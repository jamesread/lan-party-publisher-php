# lan-party-publisher-php

This is a PHP library that implements the LAN party publishing standard, making it easy to pull your own list of events from your own database, and publish those to the world, in a standard format that can be consumed by other sites (like http://lanlist.info).

## Using the PHP Library

Normally you should put your calling script and the library in the same subdirectory to keep things together. You should not need to edit the library yourself, as it makes upgrades a real pain in the future. If there are problems with the library, just raise an issue on GitHub.

**Create a new folder for your publisher**, and `cd` into it.

```shell
user@host: mkdir lan-party-publishing-standard/
user@host: composer require jamesread/lan-party-publisher-php
```

**Write a "calling script"** called "index.php" that that uses the library to build the list of JSON events. Look at the several [php examples](examples) to help get you started. The example below shows a simple `index.php` file using PDO to connect to a MySQL database.

**index.php** - Start with the example code; [withPdoMySQLDatabase.php](examples/withPdoMySQLDatabase.php)

Adapt the above code to your own database structure, and view the resulting JSON in your browser.

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
