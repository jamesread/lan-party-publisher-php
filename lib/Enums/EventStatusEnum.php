<?php

namespace LanPartyPublisherPhp\Enums;

enum EventStatusEnum: string
{
    case SCHEDULED = 'https://schema.org/EventScheduled';
    case CANCELLED = 'https://schema.org/EventCancelled';
    case POSTPONED = 'https://schema.org/EventPostponed';
    case MOVED_ONLINE = 'https://schema.org/EventMovedOnline';
    case RESCHEDULED = 'https://schema.org/EventRescheduled';
}
