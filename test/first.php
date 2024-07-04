<?php

require_once '../vendor/autoload.php';

use LanPartyPublisherPhp\Publisher;

$publisher = new Publisher();

$organizer = $publisher->createOrganisation('My Lan Party');

$venue = $organizer->createVenue('My Hall');

$event1 = $venue->createEvent('LAN 1');
$event2 = $venue->createEvent('LAN 2');

$publisher->outputJson($organizer);

?>
