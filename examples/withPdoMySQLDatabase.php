<?php

error_reporting(E_ALL);

require_once 'vendor/autoload.php';

use LanPartyPublisherPhp\Publisher;

$conn = new PDO('mysql:dbname=myLanParty;host=localhost', 'username', 'password');

$publisher = new Publisher();

$organisation = $publisher->createOrganisation('My LAN');

$sql = 'SELECT * FROM venues';
$stmt = $conn->prepare($sql);
$stmt->execute();

foreach ($stmt->fetchAll() as $dbVenue) {
    $venue = $organisation->createVenue($dbVenue['name']);
    $venue->siteUniqueId = $dbVenue['id'];
    $venue->gpsLatitude = $dbVenue['lat'];
    $venue->gpsLongditude = $dbVenue['lng'];

    $sql = 'SELECT * FROM events e WHERE e.venue = :venueId';
    $stmt = $conn->prepare($sql);
    $stmt->bindValue(':venueId', $venue->siteUniqueId);
    $stmt->execute();

    foreach ($stmt->fetchAll() as $dbEvent) {
        $event = $venue->createEvent($dbEvent['name']);
        $event->siteUniqueId = $dbEvent['id'];
        $event->start = $dbEvent['dateStart'];

        $venue->addEvent($event);
    }
}

$publisher->outputJson();

?>
