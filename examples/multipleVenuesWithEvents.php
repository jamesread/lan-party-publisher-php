<?php

require __DIR__ . '/helpers.php';

use LanPartyPublisherPhp\Event;
use LanPartyPublisherPhp\Publisher;
use LanPartyPublisherPhp\Venue;

$publisher = Publisher::make()
    ->createOrganisation('Test Organisation', [
        'websiteUrl' => 'https://example.com',
        'steamGroupUrl' => 'https://steamcommunity.com/groups/example',
        'image' => 'https://example.com/banner.png',
        'description' => 'Test Description',
    ]);

$venues = [
    Venue::make('Test Venue 1'),
    Venue::make('Test Venue 2'),
];

$publisher->addVenues($venues);
$publisher->addEvents('Test Venue 1', [
    Event::make('Test Event 1', sampleEventOptions()),
]);
$publisher->addEvents('Test Venue 2', [
    Event::make('Test Event 2', array_merge(sampleEventOptions(), [
        'publisherUniqueId' => 'test-event-2',
    ])),
]);

header('Content-Type: application/json');

echo $publisher->toJson();
