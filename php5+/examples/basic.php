<?php

require_once '../main/LanPartyPublishingLibrary.php';

$organisation = new Organisation('My LAN');

$venue = new Venue('Our lovely hall');

$organisation->addVenue($venue);

$event1 = new Event('Event #1');
$venue->addEvent($event1);

$event2 = new Event('Event #2');
$venue->addEvent($event2);

outputJson($organisation);

?>
