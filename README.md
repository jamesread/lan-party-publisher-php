# lan-party-publisher-php

This is a PHP library that implements the LAN party publishing standard, making it easy to pull your own list of events from your own database, and publish those to the world, in a standard format that can be consumed by other sites (like http://lanlist.info).

# Using the PHP Library

Normally you should put your calling script and the library in the same subdirectory to keep things together. You should not need to edit the library yourself, as it makes upgrades a real pain in the future. If there are problems with the library, just raise an issue on GitHub.

* Create a new folder for your publisher, and `cd` into it.

```shell
user@host: mkdir lan-party-publishing-standard/
user@host: composer require jamesread/lan-party-publisher-php
```

*. Write a "calling script" that uses the library to build the list of JSON events. Look at the several [php examples](examples) to help get you started. The example below shows a simple `index.php` file using PDO to connect to a MySQL database.

```php
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
?>
```

Adapt the above code to your own database structure, and view the resulting JSON in your browser.
