<?php

declare(strict_types=1);

require_once __DIR__ . '/../vendor/autoload.php';

use LanPartyPublisherPhp\Enums\EventAttendanceModeEnum;
use LanPartyPublisherPhp\Enums\EventStatusEnum;
use LanPartyPublisherPhp\Enums\TicketAvailabilityEnum;
use LanPartyPublisherPhp\Event;
use LanPartyPublisherPhp\Publisher;
use LanPartyPublisherPhp\Ticket;
use LanPartyPublisherPhp\Venue;

function sampleEventOptions(): array
{
    return [
        'startDate' => DateTime::createFromFormat('Y-m-d H:i:s', '2021-01-01 00:00:00'),
        'endDate' => DateTime::createFromFormat('Y-m-d H:i:s', '2021-01-02 00:00:00'),
        'maximumAttendeeCapacity' => 100,
        'remainingAttendeeCapacity' => 50,
        'tickets' => [
            Ticket::make('Early bird', [
                'priceCurrency' => 'GBP',
                'price' => 10.99,
                'availability' => TicketAvailabilityEnum::IN_STOCK,
            ]),
            Ticket::make('On the door', [
                'priceCurrency' => 'GBP',
                'price' => 15.99,
                'availability' => TicketAvailabilityEnum::IN_STOCK,
            ]),
        ],
        'sleeping' => 1,
        'hasShowers' => true,
        'alcoholPolicy' => 2,
        'smokingPolicy' => 2,
        'agePolicy' => 4,
        'foodPolicy' => 2,
        'networkConnectionMbps' => 1000,
        'internetConnectionMbps' => 1000,
        'description' => 'Test Description',
    ];
}

function buildPixelPitPublisher(): Publisher
{
    $publisher = Publisher::make()
        ->createOrganisation('Pixel Pit LAN', [
            'publisherUniqueId' => 'pixel-pit-lan',
            'websiteUrl' => 'https://pixelpitlan.example.org',
            'steamGroupUrl' => 'https://steamcommunity.com/groups/pixelpitlan',
            'discordInviteUrl' => 'https://discord.gg/pixelpitlan',
            'image' => 'https://pixelpitlan.example.org/images/banner.png',
            'description' => 'Monthly BYOC LAN parties for PC gamers in the East Midlands.',
        ]);

    $publisher->addVenues([
        Venue::make('Beeston Community Centre', [
            'publisherUniqueId' => 'beeston-community-centre',
            'gpsLatitude' => 52.926,
            'gpsLongitude' => -1.2155,
            'countryCode' => 'GB',
        ]),
    ]);

    $publisher->addEvents('Beeston Community Centre', [
        Event::make('Pixel Pit LAN #42', [
            'publisherUniqueId' => 'pp-lan-42',
            'url' => 'https://pixelpitlan.example.org/events/pp-lan-42',
            'eventStatus' => EventStatusEnum::SCHEDULED,
            'eventAttendanceMode' => EventAttendanceModeEnum::OFFLINE,
            'startDate' => DateTime::createFromFormat('Y-m-d H:i:s', '2026-06-14 10:00:00'),
            'endDate' => DateTime::createFromFormat('Y-m-d H:i:s', '2026-06-15 18:00:00'),
            'maximumAttendeeCapacity' => 48,
            'remainingAttendeeCapacity' => 12,
            'tickets' => [
                Ticket::make('Early bird', [
                    'description' => 'Includes setup evening access',
                    'priceCurrency' => 'GBP',
                    'price' => 15,
                    'availability' => TicketAvailabilityEnum::SOLD_OUT,
                    'validFrom' => DateTime::createFromFormat('Y-m-d H:i:s', '2026-06-13 18:00:00'),
                    'validThrough' => DateTime::createFromFormat('Y-m-d H:i:s', '2026-06-15 18:00:00'),
                    'availabilityStarts' => DateTime::createFromFormat('Y-m-d H:i:s', '2026-05-01 09:00:00'),
                    'availabilityEnds' => DateTime::createFromFormat('Y-m-d H:i:s', '2026-06-07 23:59:59'),
                ]),
                Ticket::make('Standard', [
                    'description' => 'General admission for the event weekend',
                    'priceCurrency' => 'GBP',
                    'price' => 18,
                    'availability' => TicketAvailabilityEnum::IN_STOCK,
                    'validFrom' => DateTime::createFromFormat('Y-m-d H:i:s', '2026-06-14 10:00:00'),
                    'validThrough' => DateTime::createFromFormat('Y-m-d H:i:s', '2026-06-15 18:00:00'),
                    'availabilityStarts' => DateTime::createFromFormat('Y-m-d H:i:s', '2026-05-01 09:00:00'),
                    'availabilityEnds' => DateTime::createFromFormat('Y-m-d H:i:s', '2026-06-13 23:59:59'),
                ]),
                Ticket::make('On the door', [
                    'description' => 'Cash only, subject to availability. Event day only.',
                    'priceCurrency' => 'GBP',
                    'price' => 20,
                    'availability' => TicketAvailabilityEnum::IN_STOCK,
                    'validFrom' => DateTime::createFromFormat('Y-m-d H:i:s', '2026-06-14 10:00:00'),
                    'validThrough' => DateTime::createFromFormat('Y-m-d H:i:s', '2026-06-14 23:59:59'),
                ]),
            ],
            'sleeping' => 4,
            'hasShowers' => true,
            'alcoholPolicy' => 1,
            'smokingPolicy' => 2,
            'agePolicy' => 4,
            'foodPolicy' => 10,
            'networkConnectionMbps' => 10000,
            'internetConnectionMbps' => 1000,
            'wifiConnectionMbps' => 300,
            'description' => '48-seat BYOC LAN with tournament brackets, pizza run, and overnight sleeping in the main hall.',
        ]),
        Event::make('Pixel Pit LAN #43', [
            'publisherUniqueId' => 'pp-lan-43',
            'url' => 'https://pixelpitlan.example.org/events/pp-lan-43',
            'eventStatus' => EventStatusEnum::SCHEDULED,
            'eventAttendanceMode' => EventAttendanceModeEnum::OFFLINE,
            'startDate' => DateTime::createFromFormat('Y-m-d H:i:s', '2026-08-09 10:00:00'),
            'endDate' => DateTime::createFromFormat('Y-m-d H:i:s', '2026-08-10 18:00:00'),
            'maximumAttendeeCapacity' => 48,
            'remainingAttendeeCapacity' => 48,
            'tickets' => [
                Ticket::make('Early bird', [
                    'description' => 'Sales open 1 July 2026',
                    'priceCurrency' => 'GBP',
                    'price' => 15,
                    'availability' => TicketAvailabilityEnum::PRE_SALE,
                    'validFrom' => DateTime::createFromFormat('Y-m-d H:i:s', '2026-08-08 18:00:00'),
                    'validThrough' => DateTime::createFromFormat('Y-m-d H:i:s', '2026-08-10 18:00:00'),
                    'availabilityStarts' => DateTime::createFromFormat('Y-m-d H:i:s', '2026-07-01 09:00:00'),
                    'availabilityEnds' => DateTime::createFromFormat('Y-m-d H:i:s', '2026-08-08 23:59:59'),
                ]),
                Ticket::make('Standard', [
                    'priceCurrency' => 'GBP',
                    'price' => 18,
                    'availability' => TicketAvailabilityEnum::PRE_SALE,
                    'validFrom' => DateTime::createFromFormat('Y-m-d H:i:s', '2026-08-09 10:00:00'),
                    'validThrough' => DateTime::createFromFormat('Y-m-d H:i:s', '2026-08-10 18:00:00'),
                    'availabilityStarts' => DateTime::createFromFormat('Y-m-d H:i:s', '2026-07-01 09:00:00'),
                    'availabilityEnds' => DateTime::createFromFormat('Y-m-d H:i:s', '2026-08-08 23:59:59'),
                ]),
                Ticket::make('Spectator', [
                    'description' => 'Day pass without a seat',
                    'priceCurrency' => 'GBP',
                    'price' => 5,
                    'availability' => TicketAvailabilityEnum::PRE_SALE,
                    'validFrom' => DateTime::createFromFormat('Y-m-d H:i:s', '2026-08-09 10:00:00'),
                    'validThrough' => DateTime::createFromFormat('Y-m-d H:i:s', '2026-08-09 23:59:59'),
                    'availabilityStarts' => DateTime::createFromFormat('Y-m-d H:i:s', '2026-07-01 09:00:00'),
                    'availabilityEnds' => DateTime::createFromFormat('Y-m-d H:i:s', '2026-08-09 23:59:59'),
                ]),
            ],
            'sleeping' => 4,
            'hasShowers' => true,
            'alcoholPolicy' => 1,
            'smokingPolicy' => 2,
            'agePolicy' => 4,
            'foodPolicy' => 2,
            'networkConnectionMbps' => 10000,
            'internetConnectionMbps' => 1000,
            'wifiConnectionMbps' => 300,
            'description' => 'Summer LAN with retro gaming corner and late-night Rocket League tournament.',
        ]),
    ]);

    return $publisher;
}
