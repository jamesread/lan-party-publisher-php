<?php

use LanPartyPublisherPhp\Publisher;
use LanPartyPublisherPhp\Venue;

describe('JSON Output', function () {
    it('correctly outputs the `Organisation`', function () {
        $publisher = Publisher::make()
            ->createOrganisation('Test Organisation');

        expectJsonDocument(json_decode($publisher->toJson(), true), [
            ...createSchemaStructure(),
            'organisation' => expectedOrganisation(),
        ]);
    });

    it('correctly outputs the `Organisation` with additional data', function () {
        $publisher = Publisher::make()
            ->createOrganisation('Test Organisation', [
                'websiteUrl' => 'https://example.com',
                'steamGroupUrl' => 'https://steamcommunity.com/groups/example',
                'image' => 'https://example.com/banner.png',
                'description' => 'Test Description',
            ]);

        expectJsonDocument(json_decode($publisher->toJson(), true), [
            ...createSchemaStructure(),
            'organisation' => expectedOrganisation([
                'websiteUrl' => 'https://example.com',
                'steamGroupUrl' => 'https://steamcommunity.com/groups/example',
                'image' => 'https://example.com/banner.png',
                'description' => 'Test Description',
            ]),
        ]);
    });

    it('correctly outputs the `Organisation` and `Venue`', function () {
        $publisher = Publisher::make()
            ->createOrganisation('Test Organisation');

        $venue = $publisher->getOrganisation()->createVenue('Test Venue');

        expectJsonDocument(json_decode($publisher->toJson(), true), [
            ...createSchemaStructure(),
            'organisation' => expectedOrganisation([
                'venues' => [jsonSnapshot($venue)],
            ]),
        ]);
    });

    it('correctly outputs with the `Organisation`, `Venue` and `Event`', function () {
        $publisher = Publisher::make()
            ->createOrganisation('Test Organisation');

        $venue = $publisher->getOrganisation()->createVenue('Test Venue');
        $event = $venue->createEvent('Test Event');

        expectJsonDocument(json_decode($publisher->toJson(), true), [
            ...createSchemaStructure(),
            'organisation' => expectedOrganisation([
                'venues' => [
                    [...jsonSnapshot($venue), 'events' => [jsonSnapshot($event)]],
                ],
            ]),
        ]);
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

        expectJsonDocument(json_decode($publisher->toJson(), true), [
            ...createSchemaStructure(),
            'organisation' => expectedOrganisation([
                'venues' => array_map(
                    fn ($venue) => [...jsonSnapshot($venue), 'events' => array_map(fn ($event) => jsonSnapshot($event), $venue->events)],
                    $venues
                ),
            ]),
        ]);
    });

    it('correctly outputs `multiple events`', function () {
        $publisher = Publisher::make()
            ->createOrganisation('Test Organisation');

        $venue = $publisher->getOrganisation()->createVenue('Test Venue');
        $events = [];

        for ($i = 0; $i < 3; $i++) {
            $events[] = $venue->createEvent('Test Event ' . $i);
        }

        expectJsonDocument(json_decode($publisher->toJson(), true), [
            ...createSchemaStructure(),
            'organisation' => expectedOrganisation([
                'venues' => [
                    [...jsonSnapshot($venue), 'events' => array_map(fn ($event) => jsonSnapshot($event), $events)],
                ],
            ]),
        ]);
    });

    it('correctly outputs a `venue` with custom properties', function () {
        $publisher = Publisher::make()
            ->createOrganisation('Test Organisation')
            ->createVenue('Test Venue', [
                'gpsLatitude' => 51.5072,
                'gpsLongitude' => 0.1276,
                'countryCode' => 'GB',
            ]);

        expectJsonDocument(json_decode($publisher->toJson(), true), [
            ...createSchemaStructure(),
            'organisation' => expectedOrganisation([
                'venues' => [
                    expectedVenue([
                        'gpsLatitude' => 51.5072,
                        'gpsLongitude' => 0.1276,
                        'countryCode' => 'GB',
                    ]),
                ],
            ]),
        ]);
    });

    it('correctly outputs a `event` with custom properties', function () {
        $publisher = Publisher::make()
            ->createOrganisation('Test Organisation')
            ->createVenue('Test Venue')
            ->createEvent('Test Venue', 'Test Event', sampleEventOptions());

        expectJsonDocument(json_decode($publisher->toJson(), true), [
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
});

describe('Array Output', function () {
    it('correctly outputs the `Organisation`', function () {
        $publisher = Publisher::make()
            ->createOrganisation('Test Organisation');

        expect($publisher->toArray())->toBe([
            ...createSchemaStructure(),
            'organisation' => $publisher->getOrganisation(),
        ]);
    });

    it('correctly outputs the `Organisation` with additional data', function () {
        $publisher = Publisher::make()
            ->createOrganisation('Test Organisation', [
                'websiteUrl' => 'https://example.com',
                'steamGroupUrl' => 'https://steamcommunity.com/groups/example',
                'image' => 'https://example.com/banner.png',
                'description' => 'Test Description',
            ]);

        expect($publisher->toArray())->toBe([
            ...createSchemaStructure(),
            'organisation' => $publisher->getOrganisation(),
        ]);
    });

    it('correctly outputs the `Organisation` and `Venue`', function () {
        $publisher = Publisher::make()
            ->createOrganisation('Test Organisation');

        $publisher->getOrganisation()->createVenue('Test Venue');

        expect($publisher->toArray())->toBe([
            ...createSchemaStructure(),
            'organisation' => $publisher->getOrganisation(),
        ]);
    });

    it('correctly outputs with the `Organisation`, `Venue` and `Event`', function () {
        $publisher = Publisher::make()
            ->createOrganisation('Test Organisation');

        $publisher->getOrganisation()->createVenue('Test Venue')->createEvent('Test Event');

        expect($publisher->toArray())->toBe([
            ...createSchemaStructure(),
            'organisation' => $publisher->getOrganisation(),
        ]);
    });

    it('correctly outputs `multiple venues`', function () {
        $publisher = Publisher::make()
            ->createOrganisation('Test Organisation');

        $organisation = $publisher->getOrganisation();

        for ($i = 0; $i < 3; $i++) {
            $venue = new Venue('Test Venue ' . $i);
            $venue->createEvent('Test Event ' . $i);
            $organisation->addVenue($venue);
        }

        expect($publisher->toArray())->toBe([
            ...createSchemaStructure(),
            'organisation' => $publisher->getOrganisation(),
        ]);
    });

    it('correctly outputs `multiple events`', function () {
        $publisher = Publisher::make()
            ->createOrganisation('Test Organisation');

        $venue = $publisher->getOrganisation()->createVenue('Test Venue');

        for ($i = 0; $i < 3; $i++) {
            $venue->createEvent('Test Event ' . $i);
        }

        expect($publisher->toArray())->toBe([
            ...createSchemaStructure(),
            'organisation' => $publisher->getOrganisation(),
        ]);
    });

    it('correctly outputs a `venue` with custom properties', function () {
        $publisher = Publisher::make()
            ->createOrganisation('Test Organisation')
            ->createVenue('Test Venue', [
                'gpsLatitude' => 51.5072,
                'gpsLongitude' => 0.1276,
            ]);

        expect($publisher->toArray())->toBe([
            ...createSchemaStructure(),
            'organisation' => $publisher->getOrganisation(),
        ]);
    });

    it('correctly outputs a `event` with custom properties', function () {
        $publisher = Publisher::make()
            ->createOrganisation('Test Organisation')
            ->createVenue('Test Venue')
            ->createEvent('Test Venue', 'Test Event', sampleEventOptions());

        expect($publisher->toArray())->toBe([
            ...createSchemaStructure(),
            'organisation' => $publisher->getOrganisation(),
        ]);
    });
});
