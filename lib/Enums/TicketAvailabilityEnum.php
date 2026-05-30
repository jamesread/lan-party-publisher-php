<?php

namespace LanPartyPublisherPhp\Enums;

enum TicketAvailabilityEnum: string
{
    case DISCONTINUED = 'https://schema.org/Discontinued';
    case IN_STOCK = 'https://schema.org/InStock';
    case IN_STORE_ONLY = 'https://schema.org/InStoreOnly';
    case LIMITED_AVAILABILITY = 'https://schema.org/LimitedAvailability';
    case ONLINE_ONLY = 'https://schema.org/OnlineOnly';
    case OUT_OF_STOCK = 'https://schema.org/OutOfStock';
    case PRE_ORDER = 'https://schema.org/PreOrder';
    case PRE_SALE = 'https://schema.org/PreSale';
    case SOLD_OUT = 'https://schema.org/SoldOut';
}
