<?php

require __DIR__ . '/helpers.php';

use LanPartyPublisherPhp\Event;
use LanPartyPublisherPhp\Publisher;

$publisher = Publisher::make()
    ->createOrganisation('Test Organisation', [
        'websiteUrl' => 'https://example.com',
        'steamGroupUrl' => 'https://steamcommunity.com/groups/example',
        'image' => 'https://example.com/banner.png',
        'description' => 'Test Description',
    ])
    ->createVenue('Test Venue');

$events = [
    Event::make('Test Event 1', sampleEventOptions()),
    Event::make('Test Event 2', array_merge(sampleEventOptions(), [
        'publisherUniqueId' => 'test-event-2',
    ])),
];

$publisher->addEvents('Test Venue', $events);

header('Content-Type: application/json');

echo $publisher->toJson();
