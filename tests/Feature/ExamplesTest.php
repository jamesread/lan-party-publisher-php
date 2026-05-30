<?php

use LanPartyPublisherPhp\Event;
use LanPartyPublisherPhp\Publisher;
use LanPartyPublisherPhp\Venue;

it('produces the desired result for example `Basic Single Venue and Event`', function () {
    $jsonOutput = Publisher::make()
        ->createOrganisation('Test Organisation')
        ->createVenue('Test Venue')
        ->createEvent('Test Venue', 'Test Event', sampleEventOptions())
        ->toJson();

    expectJsonDocument(json_decode($jsonOutput, true), [
        ...createSchemaStructure(),
        'organisation' => expectedOrganisation([
            'venues' => [
                expectedVenue([
                    'events' => [expectedSampleEvent()],
                ]),
            ],
        ]),
    ]);
});

it('produces the desired result for example `Multiple Events`', function () {
    $publisher = Publisher::make()
        ->createOrganisation('Test Organisation')
        ->createVenue('Test Venue');

    $events = [
        Event::make('Test Event 1', sampleEventOptions()),
        Event::make('Test Event 2', array_merge(sampleEventOptions(), [
            'publisherUniqueId' => 'test-event-2',
        ])),
    ];

    $publisher->addEvents('Test Venue', $events);

    expectJsonDocument(json_decode($publisher->toJson(), true), [
        ...createSchemaStructure(),
        'organisation' => expectedOrganisation([
            'venues' => [
                expectedVenue([
                    'events' => [
                        expectedSampleEvent(['name' => 'Test Event 1', 'publisherUniqueId' => 'test-event-1']),
                        expectedSampleEvent(['name' => 'Test Event 2', 'publisherUniqueId' => 'test-event-2']),
                    ],
                ]),
            ],
        ]),
    ]);
});

it('produces the desired result for example `Multiple Venues with Events`', function () {
    $publisher = Publisher::make()
        ->createOrganisation('Test Organisation');

    $venueOne = Venue::make('Test Venue 1');
    $venueTwo = Venue::make('Test Venue 2');

    $publisher->addVenues([$venueOne, $venueTwo]);
    $publisher->addEvents('Test Venue 1', [
        Event::make('Test Event 1', sampleEventOptions()),
    ]);
    $publisher->addEvents('Test Venue 2', [
        Event::make('Test Event 2', array_merge(sampleEventOptions(), [
            'publisherUniqueId' => 'test-event-2',
        ])),
    ]);

    expectJsonDocument(json_decode($publisher->toJson(), true), [
        ...createSchemaStructure(),
        'organisation' => expectedOrganisation([
            'venues' => [
                expectedVenue([
                    'name' => 'Test Venue 1',
                    'publisherUniqueId' => 'test-venue-1',
                    'events' => [
                        expectedSampleEvent(['name' => 'Test Event 1', 'publisherUniqueId' => 'test-event-1']),
                    ],
                ]),
                expectedVenue([
                    'name' => 'Test Venue 2',
                    'publisherUniqueId' => 'test-venue-2',
                    'events' => [
                        expectedSampleEvent(['name' => 'Test Event 2', 'publisherUniqueId' => 'test-event-2']),
                    ],
                ]),
            ],
        ]),
    ]);
});

it('produces the desired result for example `Pixel Pit` from the standard', function () {
    expectJsonDocument(json_decode(buildPixelPitPublisher()->toJson(), true), [
        ...createSchemaStructure(),
        'organisation' => expectedPixelPitOrganisation(),
    ]);
});
