<?php

error_reporting(E_ALL);

class ModelBase {
	public $apiVersion = 1;
	public $siteUniqueId = null;
	public $name = null;

	public function __construct($name = null) {
		$this->apiType = get_class($this);
		$this->name = $name;
	}
}

class Organisation extends ModelBase {
	public $websiteUrl;
	public $steamGroupUrl;
	public $bannerImagePngUrl;
	public $description;

	public $venues;

	public function addVenue(Venue $venue) {
		$this->venues[] = $venue;
	}
}

class Event extends ModelBase {
	public $start;
	public $finishes;
	public $seatsTotal;
	public $seatsAvailable;
	public $ticketsOnSale;
	public $ticketCurrencyIso4217;
	public $ticketPriceInAdvance;
	public $ticketPriceOnDoor;
	public $isTicketsOnSale = false;
	public $hasShowers;
	public $sleeping = 0; // NOT_ARRANGED. NOT_OVERNIGHT. PRIVATE_ROOMS. SHARED_ROOM. SHARED_ROOM_AND_CAMPING.
	public $isAlcoholAllowed = 0;
	public $hasSmokingArea = 0;
	public $networkConnectionMbps;
	public $internetConnectionMbps;
	public $description;

	public $attendees;

	public function setStart(DateTime $start) {
		$this->start = $start;
	}

	public function setFinish(DateTime $finish) {
		$this->finish = $finish;
	}

	public function addAttendee(Attendee $attendee) {
		$this->attendees[] = $attendee;
	}
}

class Venue extends ModelBase {
	public $gpsLatitude;
	public $gpsLongditude;

	public $events; 

	public function addEvent(Event $event) {
		$this->events[] = $event;
	}
}

class Attendee extends ModelBase {
}

function outputJson(Organisation $organisation) {
	$root = array();
	$root['$schema'] = 'https://raw.githubusercontent.com/jamesread/lan-party-publishing-api/master/schema.json';
	$root['libraryVersion'] = 1;
	$root['organisation'] = $organisation;

	header("Content-Type: application/json"); 
	echo json_encode($root, JSON_PRETTY_PRINT);
	exit;
}


?>
