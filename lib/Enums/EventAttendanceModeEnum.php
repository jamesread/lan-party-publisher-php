<?php

namespace LanPartyPublisherPhp\Enums;

enum EventAttendanceModeEnum: int
{
    case NOT_ARRANGED = 0;
    case OFFLINE = 1;
    case ONLINE = 2;
    case MIXED = 4;
}
