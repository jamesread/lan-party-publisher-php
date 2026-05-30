<?php

require __DIR__ . '/helpers.php';

use DateTime;
use LanPartyPublisherPhp\Enums\EventAttendanceModeEnum;
use LanPartyPublisherPhp\Enums\EventStatusEnum;
use LanPartyPublisherPhp\Enums\TicketAvailabilityEnum;
use LanPartyPublisherPhp\Publisher;
use LanPartyPublisherPhp\Ticket;

$jsonOutput = Publisher::make()
    ->createOrganisation('Test Organisation', [
        'publisherUniqueId' => 'test-organisation',
        'websiteUrl' => 'https://example.com',
        'steamGroupUrl' => 'https://steamcommunity.com/groups/example',
        'image' => 'https://example.com/banner.png',
        'description' => 'Test Description',
    ])
    ->createVenue('Test Venue', [
        'publisherUniqueId' => 'test-venue',
        'countryCode' => 'GB',
    ])
    ->createEvent('Test Venue', 'Test Event', [
        'publisherUniqueId' => 'test-event',
        'url' => 'https://example.com/events/test-event',
        'eventStatus' => EventStatusEnum::SCHEDULED,
        'eventAttendanceMode' => EventAttendanceModeEnum::OFFLINE,
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
    ])
    ->toJson();

header('Content-Type: application/json');

echo $jsonOutput;
