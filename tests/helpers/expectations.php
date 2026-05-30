<?php

use Composer\InstalledVersions;
use LanPartyPublisherPhp\Publisher;

function createSchemaStructure(): array
{
    return [
        '$schema' => Publisher::SCHEMA_URL,
        'generator' => 'lan-party-publisher-php ' . InstalledVersions::getVersion('jamesread/lan-party-publisher-php'),
    ];
}

function jsonSnapshot(object|array $value): array
{
    if (is_object($value)) {
        $value = json_decode(json_encode($value), true);
    }

    return Publisher::omitNulls($value);
}

function normalizedJsonArray(array $data): array
{
    ksort($data);

    foreach ($data as $key => $value) {
        if (is_array($value)) {
            $data[$key] = normalizedJsonArray($value);
        }
    }

    return $data;
}

function expectJsonDocument(array $actual, array $expected): void
{
    expect(normalizedJsonArray($actual))->toBe(normalizedJsonArray($expected));
}

function expectedOrganisation(array $overrides = []): array
{
    return array_merge([
        'name' => 'Test Organisation',
        'apiType' => 'Organisation',
        'apiVersion' => 2,
        'publisherUniqueId' => 'test-organisation',
        'venues' => [],
    ], $overrides);
}

function expectedVenue(array $overrides = []): array
{
    return array_merge([
        'name' => 'Test Venue',
        'apiType' => 'Venue',
        'apiVersion' => 2,
        'publisherUniqueId' => 'test-venue',
        'events' => [],
    ], $overrides);
}

function expectedEvent(array $overrides = []): array
{
    return array_merge([
        'name' => 'Test Event',
        'apiType' => 'Event',
        'apiVersion' => 2,
        'publisherUniqueId' => 'test-event',
        'eventAttendanceMode' => 0,
        'tickets' => [],
        'sleeping' => 0,
        'hasShowers' => false,
        'alcoholPolicy' => 0,
        'smokingPolicy' => 0,
        'agePolicy' => 0,
        'foodPolicy' => 0,
        'networkConnectionMbps' => 0,
        'internetConnectionMbps' => 0,
        'wifiConnectionMbps' => 0,
    ], $overrides);
}

function expectedSampleEvent(array $overrides = []): array
{
    return expectedEvent(array_merge([
        'startDate' => '2021-01-01T00:00:00',
        'endDate' => '2021-01-02T00:00:00',
        'maximumAttendeeCapacity' => 100,
        'remainingAttendeeCapacity' => 50,
        'tickets' => [
            [
                'name' => 'Early bird',
                'availability' => 'https://schema.org/InStock',
                'priceCurrency' => 'GBP',
                'price' => 10.99,
            ],
            [
                'name' => 'On the door',
                'availability' => 'https://schema.org/InStock',
                'priceCurrency' => 'GBP',
                'price' => 15.99,
            ],
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
    ], $overrides));
}

function expectedPixelPitTicket(array $overrides = []): array
{
    return array_merge([
        'name' => 'Early bird',
        'availability' => 'https://schema.org/SoldOut',
        'priceCurrency' => 'GBP',
        'price' => 15,
    ], $overrides);
}

function expectedPixelPitOrganisation(): array
{
    return [
        'name' => 'Pixel Pit LAN',
        'apiType' => 'Organisation',
        'apiVersion' => 2,
        'publisherUniqueId' => 'pixel-pit-lan',
        'websiteUrl' => 'https://pixelpitlan.example.org',
        'steamGroupUrl' => 'https://steamcommunity.com/groups/pixelpitlan',
        'discordInviteUrl' => 'https://discord.gg/pixelpitlan',
        'image' => 'https://pixelpitlan.example.org/images/banner.png',
        'description' => 'Monthly BYOC LAN parties for PC gamers in the East Midlands.',
        'venues' => [
            [
                'name' => 'Beeston Community Centre',
                'apiType' => 'Venue',
                'apiVersion' => 2,
                'publisherUniqueId' => 'beeston-community-centre',
                'gpsLatitude' => 52.926,
                'gpsLongitude' => -1.2155,
                'countryCode' => 'GB',
                'events' => [
                    [
                        'name' => 'Pixel Pit LAN #42',
                        'apiType' => 'Event',
                        'apiVersion' => 2,
                        'publisherUniqueId' => 'pp-lan-42',
                        'url' => 'https://pixelpitlan.example.org/events/pp-lan-42',
                        'eventStatus' => 'https://schema.org/EventScheduled',
                        'eventAttendanceMode' => 1,
                        'startDate' => '2026-06-14T10:00:00',
                        'endDate' => '2026-06-15T18:00:00',
                        'maximumAttendeeCapacity' => 48,
                        'remainingAttendeeCapacity' => 12,
                        'tickets' => [
                            expectedPixelPitTicket([
                                'description' => 'Includes setup evening access',
                                'validFrom' => '2026-06-13T18:00:00',
                                'validThrough' => '2026-06-15T18:00:00',
                                'availabilityStarts' => '2026-05-01T09:00:00',
                                'availabilityEnds' => '2026-06-07T23:59:59',
                            ]),
                            expectedPixelPitTicket([
                                'name' => 'Standard',
                                'availability' => 'https://schema.org/InStock',
                                'description' => 'General admission for the event weekend',
                                'price' => 18,
                                'validFrom' => '2026-06-14T10:00:00',
                                'validThrough' => '2026-06-15T18:00:00',
                                'availabilityStarts' => '2026-05-01T09:00:00',
                                'availabilityEnds' => '2026-06-13T23:59:59',
                            ]),
                            expectedPixelPitTicket([
                                'name' => 'On the door',
                                'availability' => 'https://schema.org/InStock',
                                'description' => 'Cash only, subject to availability. Event day only.',
                                'price' => 20,
                                'validFrom' => '2026-06-14T10:00:00',
                                'validThrough' => '2026-06-14T23:59:59',
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
                    ],
                    [
                        'name' => 'Pixel Pit LAN #43',
                        'apiType' => 'Event',
                        'apiVersion' => 2,
                        'publisherUniqueId' => 'pp-lan-43',
                        'url' => 'https://pixelpitlan.example.org/events/pp-lan-43',
                        'eventStatus' => 'https://schema.org/EventScheduled',
                        'eventAttendanceMode' => 1,
                        'startDate' => '2026-08-09T10:00:00',
                        'endDate' => '2026-08-10T18:00:00',
                        'maximumAttendeeCapacity' => 48,
                        'remainingAttendeeCapacity' => 48,
                        'tickets' => [
                            expectedPixelPitTicket([
                                'description' => 'Sales open 1 July 2026',
                                'availability' => 'https://schema.org/PreSale',
                                'validFrom' => '2026-08-08T18:00:00',
                                'validThrough' => '2026-08-10T18:00:00',
                                'availabilityStarts' => '2026-07-01T09:00:00',
                                'availabilityEnds' => '2026-08-08T23:59:59',
                            ]),
                            expectedPixelPitTicket([
                                'name' => 'Standard',
                                'availability' => 'https://schema.org/PreSale',
                                'price' => 18,
                                'validFrom' => '2026-08-09T10:00:00',
                                'validThrough' => '2026-08-10T18:00:00',
                                'availabilityStarts' => '2026-07-01T09:00:00',
                                'availabilityEnds' => '2026-08-08T23:59:59',
                            ]),
                            expectedPixelPitTicket([
                                'name' => 'Spectator',
                                'description' => 'Day pass without a seat',
                                'availability' => 'https://schema.org/PreSale',
                                'price' => 5,
                                'validFrom' => '2026-08-09T10:00:00',
                                'validThrough' => '2026-08-09T23:59:59',
                                'availabilityStarts' => '2026-07-01T09:00:00',
                                'availabilityEnds' => '2026-08-09T23:59:59',
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
                    ],
                ],
            ],
        ],
    ];
}
