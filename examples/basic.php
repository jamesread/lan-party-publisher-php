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
