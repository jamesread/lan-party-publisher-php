<?php

use LanPartyPublisherPhp\Venue;

it('correctly outputs JSON object with just the `Organisation`', function () {
    $publisher = LanPartyPublisherPhp\Publisher::make()
        ->createOrganisation('Test Organisation');

    $json = $publisher->toJson();

    $expected = [
        ...createSchemaStructure(),
        'organisation' => [
            'name' => 'Test Organisation',
            'apiType' => 'LanPartyPublisherPhp\Organisation',
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

it('correctly outputs JSON object with the `Oganisation` and `Venue`', function () {
    $publisher = LanPartyPublisherPhp\Publisher::make()
        ->createOrganisation('Test Organisation');

    $organisation = $publisher->getOrganisation();

    $venue = $organisation->createVenue('Test Venue');

    $json = $publisher->toJson();

    $expected = [
        ...createSchemaStructure(),
        'organisation' => [
            'name' => 'Test Organisation',
            'apiType' => 'LanPartyPublisherPhp\Organisation',
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

it('correctly outputs JSON object with the `Oganisation`, `Venue` and `Event`', function () {
    $publisher = LanPartyPublisherPhp\Publisher::make()
        ->createOrganisation('Test Organisation');

    $organisation = $publisher->getOrganisation();

    $venue = $organisation->createVenue('Test Venue');

    $event = $venue->createEvent('Test Event');

    $json = $publisher->toJson();

    $expected = [
        ...createSchemaStructure(),
        'organisation' => [
            'name' => 'Test Organisation',
            'apiType' => 'LanPartyPublisherPhp\Organisation',
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
    $publisher = LanPartyPublisherPhp\Publisher::make()
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
            'apiType' => 'LanPartyPublisherPhp\Organisation',
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
    $publisher = LanPartyPublisherPhp\Publisher::make()
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
            'apiType' => 'LanPartyPublisherPhp\Organisation',
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
