<?php

require_once '../vendor/autoload.php';

use LanPartyPublisherPhp\Publisher;

$conn = new PDO('mysql:dbname=myLanParty;host=localhost');

$publisher = new Publisher();

$organisation = $publisher->createOrganisation('My LAN');

$sql = 'SELECT * FROM venues';
$stmt = $conn->prepare($sql);
$stmt->execute();

foreach ($stmt->fetchAll() as $dbVenue) {
    $venue = $organizer->createVenue($dbVenue['name']);
    $venue->gpsLatitude = $dbVenue['lat'];
    $venue->gpsLongditude = $dbVenue['lng'];

    $sql = 'SELECT * FROM events WHERE e.venue = :venueId';
    $stmt = $conn->prepare($sql);
    $stmt->bindValue(':venueId', $venue['id']);
    $stmt->execute();

    foreach ($stmt->fetchAll() as $dbEvent) {
        $event = $venue->createEvent($dbEvent['name']);
        $event->start = $dbEvent['dateStart'];

        $venue->addEvent($event);
    }
}

$publisher->outputJson();

?>
