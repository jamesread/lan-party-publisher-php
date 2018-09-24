<?php

require_once '../main/LanPartyPublishingLibrary.php';

$conn = new PDO('mysql:dbname=myLanParty;host=localhost');


$organisation = new Organisation('My LAN');

$sql = 'SELECT * FROM venues WHERE';
$stmt = $conn->prepare($sql);
$stmt->execute();

foreach ($stmt->fetchAll() as $dbVenue) {
	$venue = new Venue($dbVenue['name']);
	$venue->gpsLatitude = $dbVenue['lat'];
	$venue->gpsLongditude = $dbVenue['lng'];

	$sql = 'SELECT * FROM events WHERE e.venue = :venueId';
	$stmt = $conn->prepare($sql);
	$stmt->bindValue(':venueId', $venue['id']);
	$stmt->execute();

	foreach ($stmt->fetchAll() as $dbEvent) {
		$event = new Event($dbEvent['name']);
		$event->start = $dbEvent['dateStart'];

		$venue->addEvent($event);
	}

	$organisation->addVenue($venue);
}

outputJson($organisation);

?>
